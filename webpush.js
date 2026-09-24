(function () {
  var cfg = window.PERPUS_WEBPUSH || {};
  var vapidUrl = cfg.vapidUrl || '/api/push/vapid';
  var subscribeUrl = cfg.subscribeUrl || '/api/push/subscribe';
  var swUrl = cfg.swUrl || '/sw.js';
  var SW_VERSION = '20260921-19';
  var csrf = cfg.csrf || (document.querySelector('meta[name="csrf-token"]') || {}).content || '';

  function isWebView() {
    var ua = navigator.userAgent || '';
    return /; wv\)|FBAN|FBAV|Instagram|Line\/|WhatsApp|MicroMessenger/i.test(ua);
  }

  function supported() {
    return 'serviceWorker' in navigator && 'PushManager' in window && 'Notification' in window;
  }

  function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - (base64String.length % 4)) % 4);
    var base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
    var raw = atob(base64);
    var out = new Uint8Array(raw.length);
    for (var i = 0; i < raw.length; i++) out[i] = raw.charCodeAt(i);
    return out;
  }

  function setStatus(text, ok) {
    document.querySelectorAll('#webpush-status,[data-push-status]').forEach(function (el) {
      el.textContent = text;
      el.style.color = ok === true ? '#15803d' : (ok === false ? '#b45309' : '#64748b');
    });
  }

  async function enablePush(showAlert) {
    if (isWebView()) {
      var m = 'Buka situs di Chrome (bukan dari dalam WhatsApp/Instagram). Ketuk menu ⋮ → Buka di browser.';
      setStatus(m, false);
      if (showAlert) alert(m);
      return false;
    }
    if (!supported()) {
      if (showAlert) alert('Browser tidak mendukung Web Push. Pakai Chrome terbaru.');
      return false;
    }
    try {
      setStatus('Menyiapkan…', null);
      if (location.protocol !== 'https:' && location.hostname !== 'localhost') {
        throw new Error('Wajib buka lewat HTTPS');
      }
      if (Notification.permission === 'denied') {
        throw new Error('Notifikasi diblokir. Chrome → ikon gembok → Notifikasi → Izinkan, lalu refresh.');
      }
      if (Notification.permission !== 'granted') {
        var perm = await Notification.requestPermission();
        if (perm !== 'granted') throw new Error('Izin notifikasi ditolak');
      }

      var vr = await fetch(vapidUrl + '?t=' + Date.now(), { credentials: 'same-origin', cache: 'no-store' });
      var vd = await vr.json();
      if (!vd.ok || !vd.publicKey || vd.publicKey.length < 80) {
        throw new Error('VAPID key tidak valid. Jalankan FIX_VAPID.sql di phpMyAdmin.');
      }
      var appKey = urlBase64ToUint8Array(vd.publicKey);
      if (appKey.length !== 65 || appKey[0] !== 4) {
        throw new Error('Format VAPID key salah (bukan P-256)');
      }

      // Gunakan Service Worker situs yang sama. Jangan unregister semua SW
      // karena perangkat lain/fitur PWA dapat memakai registration tersebut.
      var reg = await navigator.serviceWorker.register(swUrl + '?v=' + SW_VERSION, { scope: '/' });
      await navigator.serviceWorker.ready;

      var old = await reg.pushManager.getSubscription();
      if (old) {
        try { await old.unsubscribe(); } catch (e) {}
      }

      var sub;
      try {
        sub = await reg.pushManager.subscribe({
          userVisibleOnly: true,
          applicationServerKey: appKey,
        });
      } catch (e1) {
        // Error tipikal InfinityFree / FCM di beberapa HP
        var detail = (e1 && e1.message) ? e1.message : String(e1);
        throw new Error(detail + '\n\nTips: gunakan Chrome stabil, matikan data saver, coba WiFi lain, atau aktifkan push di laptop dulu.');
      }

      var res = await fetch(subscribeUrl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf,
        },
        body: JSON.stringify(sub.toJSON()),
      });
      var j = await res.json();
      if (!j.ok) throw new Error(j.error || 'Gagal simpan subscription');

      setStatus('Push aktif di perangkat ini.', true);
      document.querySelectorAll('[data-push-btn]').forEach(function (b) { b.classList.add('d-none'); });
      document.querySelectorAll('[data-push-ok]').forEach(function (b) { b.classList.remove('d-none'); });
      try {
        await reg.showNotification('Perpustakaan Digital', {
          body: 'Notifikasi aktif!',
          icon: '/assets/icons/icon-192.png',
          tag: 'perpus-ok',
        });
      } catch (e) {}
      if (showAlert) alert('Notifikasi aktif!');
      return true;
    } catch (err) {
      var msg = (err && err.message) ? err.message : String(err);
      setStatus('Gagal: ' + msg.split('\n')[0], false);
      console.error('[Push]', err);
      if (showAlert) {
        alert(
          'Gagal aktifkan push di HP\n\n' +
          msg +
          '\n\n---\n' +
          'Yang tetap jalan tanpa push:\n' +
          '• Lonceng notifikasi di website\n' +
          '• WhatsApp (jika diaktifkan admin)\n\n' +
          'Coba di laptop Chrome (biasanya lebih stabil di InfinityFree).'
        );
      }
      return false;
    }
  }

  window.enableWebPush = function () { return enablePush(true); };

  document.addEventListener('click', function (e) {
    if (e.target.closest('[data-push-btn], #webpush-enable-btn')) {
      e.preventDefault();
      enablePush(true);
    }
  });

  function buildPanel() {
    var host = document.getElementById('webpush-panel');
    if (!host || host.dataset.built) return;
    host.dataset.built = '1';
    host.innerHTML =
      '<div class="card-soft p-3 mb-3" style="border-left:4px solid #f59e0b;">' +
      '<div class="fw-bold mb-1">Notifikasi browser (Web Push)</div>' +
      '<p id="webpush-status" style="margin:0 0 10px;font-size:13px;color:#64748b">Klik tombol untuk mengaktifkan di perangkat ini.</p>' +
      '<button type="button" id="webpush-enable-btn" class="btn btn-warning btn-sm rounded-pill px-3">Aktifkan push di perangkat ini</button>' +
      '<div class="form-text mt-2">Aktivasi berlaku untuk <b>perangkat ini</b>. Anda boleh mengaktifkan di HP dan laptop sekaligus. Di HP buka lewat <b>Chrome</b> (bukan dari WhatsApp).</div>' +
      '</div>';
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', buildPanel);
  else buildPanel();

  // Cek status saat halaman dibuka, supaya user langsung tahu kenapa
  // tombol "Aktifkan Notif" tidak bisa di-ON-kan (bukan hanya setelah klik).
  async function checkInitialStatus() {
    if (isWebView()) {
      setStatus('Buka lewat Chrome (bukan dari WhatsApp/Instagram) agar notifikasi bisa diaktifkan.', false);
      return;
    }
    if (!supported()) {
      setStatus('Browser ini tidak mendukung Web Push. Pakai Chrome terbaru.', false);
      return;
    }
    if (location.protocol !== 'https:' && location.hostname !== 'localhost') {
      setStatus('Situs belum HTTPS — notifikasi HP hanya bisa aktif lewat HTTPS.', false);
      return;
    }
    if (Notification.permission === 'denied') {
      setStatus('Notifikasi diblokir di pengaturan browser. Ketuk ikon gembok di address bar → Notifikasi → Izinkan.', false);
      return;
    }
    if (Notification.permission === 'granted' && 'serviceWorker' in navigator) {
      try {
        var reg = await navigator.serviceWorker.getRegistration();
        var sub = reg ? await reg.pushManager.getSubscription() : null;
        if (sub) {
          setStatus('Push aktif di perangkat ini.', true);
          document.querySelectorAll('[data-push-btn]').forEach(function (b) { b.classList.add('d-none'); });
          document.querySelectorAll('[data-push-ok]').forEach(function (b) { b.classList.remove('d-none'); });
          return;
        }
      } catch (e) {}
      setStatus('Izin sudah diberikan. Ketuk tombol untuk menyelesaikan aktivasi.', null);
      return;
    }
    setStatus('Klik tombol untuk mengaktifkan di perangkat ini.', null);
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', checkInitialStatus);
  else checkInitialStatus();
})();
