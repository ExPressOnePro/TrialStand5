<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('{{ asset("js/sw.js") }}').then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }).catch(function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
    let deferredPrompt;

    window.addEventListener('beforeinstallprompt', (e) => {
        // Stash the event so it can be triggered later.
        deferredPrompt = e;

        // Update UI notify the user they can install the PWA
        const addBtn = document.createElement('button');
        addBtn.style.display = 'block';
        addBtn.style.margin = '10px 0';
        addBtn.style.border = 'none';
        addBtn.style.backgroundColor = '#4CAF50';
        addBtn.style.color = '#fff';
        addBtn.style.padding = '10px';
        addBtn.style.borderRadius = '5px';
        addBtn.textContent = 'Install app';
        addBtn.addEventListener('click', (e) => {
            // Show the install prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('PWA installed');
                } else {
                    console.log('PWA not installed');
                }
                deferredPrompt = null;
            });
        });

        document.getElementById('install-app').appendChild(addBtn);
        document.getElementById('install-app').style.display = 'block';
    });
</script>
