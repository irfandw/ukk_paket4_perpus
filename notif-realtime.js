/**
 * Notifikasi realtime — diselaraskan dengan proyek PHP native
 * (after_id + items → showBrowserNotif) agar popup laptop sama.
 */
(function () {
  if (!document.body || document.body.dataset.auth !== '1') return;

  var isStaf = document.body.dataset.staf === '1';
  var pollUrl = isStaf ? '/api/notifikasi-staf/poll' : '/api/notifikasi/poll';
  var pageUrl = isStaf ? '/notifikasi-staf' : '/notifikasi';
  var storageKey = isStaf ? 'perpus_staff_last_notif_id' : 'perpus_personal_last_notif_id';
  var afterId = parseInt(localStorage.getItem(storageKey) || '0', 10) || 0;
  var intervalMs = 5000;
  var pushMessageRecentlyHandled = 0;
  var firstPollDone = afterId > 0;

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js?v=20260921-20', { scope: '/' }).catch(function () {});
  }

  function updateBadges(count) {
    var sel = isStaf ? '.notif-staf-badge' : '.notif-badge';
    document.querySelectorAll(sel).forEach(function (badge) {
      if (count > 0) {
        badge.textContent = count > 99 ? '99+' : String(count);
        badge.classList.remove('d-none');
        badge.classList.add('notif-pulse');
      } else {
        badge.classList.add('d-none');
        badge.classList.remove('notif-pulse');
      }
    });
  }

  function playBeep() {
    try {
      var ctx = new (window.AudioContext || window.webkitAudioContext)();
      var o = ctx.createOscillator();
      var g = ctx.createGain();
      o.connect(g); g.connect(ctx.destination);
      o.frequency.value = 880; g.gain.value = 0.06;
      o.start();
      setTimeout(function () { try { o.stop(); ctx.close(); } catch (e) {} }, 200);
    } catch (e) {}
  }

  function showToast(title, message) {
    var el = document.getElementById('perpus-toast');
    if (!el) {
      el = document.createElement('div');
      el.id = 'perpus-toast';
      el.style.cssText = 'position:fixed;right:16px;bottom:16px;z-index:99999;width:min(390px,calc(100vw - 32px));';
      document.body.appendChild(el);
    }
    var card = document.createElement('div');
    card.style.cssText = 'background:#0f172a;color:#fff;padding:14px 16px;border-radius:16px;margin-top:10px;box-shadow:0 12px 32px rgba(0,0,0,.28);font-size:14px;cursor:pointer;';
    card.innerHTML = '<div style="font-weight:700;margin-bottom:4px;">' + escapeHtml(title) + '</div><div style="opacity:.9;">' + escapeHtml(message) + '</div>';
    card.onclick = function () { window.location.href = pageUrl; };
    el.appendChild(card);
    setTimeout(function () { try { card.remove(); } catch (e) {} }, 10000);
  }

  function escapeHtml(v) {
    return String(v || '').replace(/[&<>"']/g, function (c) {
      return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[c];
    });
  }

  /** Tampilkan notifikasi desktop secara konsisten.
   *  Prioritas: Service Worker -> Notification API. Jika izin belum diberikan,
   *  popup browser hanya bisa diaktifkan setelah user menekan tombol "Aktifkan Notif".
   */
  function showBrowserNotif(item) {
    if (typeof Notification === 'undefined') return;
    var title = item.judul || item.title || 'Perpustakaan Digital';
    var body = item.pesan || item.message || 'Ada notifikasi baru';
    var tag = 'perpus-notif-' + (item.id || Date.now());

    function showViaServiceWorker() {
      if (!('serviceWorker' in navigator)) return Promise.resolve(false);
      return navigator.serviceWorker.getRegistration('/').then(function (reg) {
        if (!reg || !reg.showNotification) return false;
        return reg.showNotification(title, {
          body: body,
          icon: '/assets/icons/icon-192.png',
          badge: '/assets/icons/icon-192.png',
          tag: tag,
          requireInteraction: true,
          renotify: true,
          data: { url: pageUrl }
        }).then(function () { return true; }).catch(function () { return false; });
      }).catch(function () { return false; });
    }

    function showDirect() {
      try {
        var n = new Notification(title, {
          body: body,
          icon: '/assets/icons/icon-192.png',
          tag: tag,
          requireInteraction: true,
          renotify: true,
          silent: false
        });
        n.onclick = function () {
          try { n.close(); } catch (e) {}
          try { window.focus(); } catch (e) {}
          window.location.href = pageUrl;
        };
        return true;
      } catch (e) { return false; }
    }

    if (Notification.permission !== 'granted') return;

    // Service Worker lebih stabil untuk popup desktop, termasuk saat tab tidak aktif.
    showViaServiceWorker().then(function (shown) {
      if (!shown) showDirect();
    });
  }

  function onNewItems(items) {
    (items || []).forEach(function (it) {
      var id = parseInt(it.id, 10);
      if (!id || id <= afterId) return;
      showToast(it.judul || it.title || 'Notifikasi', it.pesan || it.message || '');
      showBrowserNotif(it);
      playBeep();
    });
  }

  function poll() {
    var url = pollUrl + (pollUrl.indexOf('?') >= 0 ? '&' : '?') + 'after_id=' + encodeURIComponent(afterId) + '&t=' + Date.now();
    fetch(url, { credentials: 'same-origin', headers: { Accept: 'application/json' }, cache: 'no-store' })
      .then(function (r) {
        if (r.status === 401 || r.status === 403) return null;
        return r.json();
      })
      .then(function (data) {
        if (!data || !data.ok) return;
        updateBadges(data.unread || data.count || 0);
        var items = data.items || [];
        // Seperti PHP: hanya tampilkan popup untuk item BARU (setelah first poll)
        if (firstPollDone && afterId > 0 && items.length) {
          onNewItems(items);
        }
        if (data.max_id && data.max_id > afterId) {
          afterId = data.max_id;
        } else if (items.length) {
          items.forEach(function (it) {
            var id = parseInt(it.id, 10);
            if (id > afterId) afterId = id;
          });
        }
        if (afterId > 0) {
          try { localStorage.setItem(storageKey, String(afterId)); } catch (e) {}
        }
        firstPollDone = true;
      })
      .catch(function () {});
  }

  document.addEventListener('visibilitychange', function () {
    if (document.visibilityState === 'visible') poll();
  });

  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.addEventListener('message', function (event) {
      if (!event.data || event.data.type !== 'PERPUS_PUSH') return;
      showToast(event.data.title || 'Perpustakaan Digital', event.data.body || 'Ada notifikasi baru');
      pushMessageRecentlyHandled = Date.now();
      playBeep();
      poll();
    });
  }

  poll();
  setInterval(poll, intervalMs);
})();
