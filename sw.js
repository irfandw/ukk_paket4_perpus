/* Service Worker v20 - Perpustakaan Digital */
self.addEventListener('install', function (e) { self.skipWaiting(); });
self.addEventListener('activate', function (e) { e.waitUntil(self.clients.claim()); });
self.addEventListener('message', function (event) {
  if (event.data && event.data.type === 'SKIP_WAITING') self.skipWaiting();
});

function parsePushData(event) {
  var data = {
    title: 'Perpustakaan Digital',
    body: 'Ada notifikasi baru. Buka situs untuk detail.',
    url: '/notifikasi-staf',
    tag: 'perpus-' + Date.now(),
  };
  if (!event.data) return data;
  try {
    var parsed = event.data.json();
    if (parsed && typeof parsed === 'object') {
      data.title = parsed.title || parsed.judul || data.title;
      data.body = parsed.body || parsed.pesan || parsed.message || data.body;
      data.url = parsed.url || parsed.link || data.url;
      data.tag = parsed.tag || data.tag;
      return data;
    }
  } catch (e1) {}
  try {
    var txt = event.data.text();
    if (txt && txt.charAt(0) === '{') {
      var p = JSON.parse(txt);
      data.title = p.title || p.judul || data.title;
      data.body = p.body || p.pesan || p.message || data.body;
      data.url = p.url || data.url;
    } else if (txt && txt.length > 2) {
      data.body = txt;
    }
  } catch (e2) {}
  return data;
}

self.addEventListener('push', function (event) {
  var data = parsePushData(event);

  // Beri tahu tab yang terbuka agar polling/toast ikut refresh
  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (list) {
      list.forEach(function (c) {
        try {
          c.postMessage({ type: 'PERPUS_PUSH', title: data.title, body: data.body, url: data.url });
        } catch (e) {}
      });
      return self.registration.showNotification(data.title, {
        body: data.body,
        icon: '/assets/icons/icon-192.png',
        badge: '/assets/icons/icon-192.png',
        data: { url: data.url },
        requireInteraction: true,
        renotify: true,
        silent: false,
        tag: data.tag,
        vibrate: [160, 80, 160],
        actions: [
          { action: 'open', title: 'Buka' },
          { action: 'close', title: 'Tutup' }
        ]
      });
    })
  );
});

self.addEventListener('notificationclick', function (event) {
  event.notification.close();
  if (event.action === 'close') return;
  var url = (event.notification.data && event.notification.data.url) || '/';
  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (list) {
      for (var i = 0; i < list.length; i++) {
        if (list[i].url && 'focus' in list[i]) {
          try { list[i].navigate(url); } catch (e) {}
          return list[i].focus();
        }
      }
      if (clients.openWindow) return clients.openWindow(url);
    })
  );
});
