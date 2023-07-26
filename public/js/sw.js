self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open('v1').then(function (cache) {
            return cache.addAll([
                '/',
                '/css/app.css',
                '/js/app.js',
                '/js/register-sw.js',
            ]);
        })
    );
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request).then(function (r) {
                return caches.open('v1').then(function (cache) {
                    cache.put(event.request, r.clone());
                    return r;
                });
            });
        })
    );
});


