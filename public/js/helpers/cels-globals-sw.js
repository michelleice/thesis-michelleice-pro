/**
 * cels-globals-sw.js
 * Global functions for communication with service worker helpers
 * 
 * (c) Cels Technology Solutions, 2020
 */

(() => {
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/cels-sw.js').then(registration => {
                
            }).catch(err => {
                console.error(`Failed to register service worker: ${err}`);
            });
        });
    }
    else {
        console.error('Failed to register service worker.');
    }

    if (Notification.permission !== 'granted' && Notification.permission !== 'denied') {
        if (localStorage) {
            if (!(localStorage.getItem('notification-permission-requested'))) {
                let el = document.getElementById('notification-permission-request');
                document.getElementById('notification-request-later-button').addEventListener('click', e => {
                    localStorage.setItem('notification-permission-requested', true);
                });
                document.getElementById('notification-request-allow-button').addEventListener('click', e => {
                    localStorage.setItem('notification-permission-requested', true);
                    Notification.requestPermission().then(res => {
                        if (res === 'denied') {
                            toastr.warning('We\'re sorry to know that we\'re disallowed for notifications permission. To re-enable it at a later time you might want to consult your browser documentations.', 'Notification disabled');
                        }
                    });
                });

                el.classList.remove('d-none');
                el.classList.add('animate__animated', 'animate__slideInDown');
            }
        }
    }
    
    let notify = (title, options) => {
        if (Notification.permission === 'granted') {
            navigator.serviceWorker.ready.then(registration => {
                registration.showNotification(title, {
                    'icon': '/images/favicon.png',
                    ...options
                });
            });
        }
    }

    let Globals = {
        'notify': notify,
    }

    if (window.Cels) {
        if (window.Cels.Globals) {
            window.Cels['Globals'] = {...window.Cels['Globals'], ...Globals, };
        }
        else {
            window.Cels['Globals'] = Globals;
        }
    }
    else {
        window.Cels = {
            'Globals': Globals
        };
    }
})();