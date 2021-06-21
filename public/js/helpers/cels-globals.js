/**
 * cels-globals.js
 * Global function library helpers
 * 
 * (c) Cels Technology Solutions, 2020
 */

(($) => {
    let meta = name => $(`meta[name=${name}]`).attr('content');
    let api = route => `${meta('api-path')}/${route || ''}`;
    let preferences = id => {
        if (indexedDB) {
            let database = async () => {
                return new Promise((resolve, reject) => {
                    let db = indexedDB.open(`CelsPreferences-${id}`);
                    db.addEventListener('error', ev => reject('Failed to open database!'));
                    db.addEventListener('upgradeneeded', ev => {
                        ev.target.result.createObjectStore('keyvalues', {keyPath: 'key'});
                    });
                    db.addEventListener('success', (ev) => resolve(ev.target.result));
                });
            }

            return {
                'get': async (key, def = undefined) => {
                    let db = await database();
                    return new Promise((resolve, reject) => {
                        let request = db.transaction(['keyvalues']).objectStore('keyvalues').get(key);
                        request.addEventListener('error', ev2 => reject(`Failed to fetch key '${key}' within scope '${id}'!`));
                        request.addEventListener('success', ev2 => resolve(request.result ? request.result.value : def));
                        db.close();
                    });
                },
                'set': async (key, value) => {
                    let db = await database();
                    return new Promise((resolve, reject) => {
                        let request = db.transaction(['keyvalues'], 'readwrite').objectStore('keyvalues').put({'key': key, 'value': value});
                        request.addEventListener('error', ev2 => reject(`Failed to set key '${key}' to value '${value}' within scope '${id}'!`));
                        request.addEventListener('success', ev2 => resolve(true));
                    });
                },
            };
        }
        else if (localStorage) {
            let prefs = {};

            prefs = JSON.parse(localStorage.getItem(`cels-prefs-${id}`));
            if (!prefs) {
                prefs = {};
                localStorage.setItem(`cels-prefs-${id}`, JSON.stringify(prefs));
            }

            return {
                'get': async (key, def = undefined) => {
                    return new Promise((resolve, reject) => {
                        resolve(key in prefs ? prefs[key] : def);
                    });
                },
                'set': async (key, value) => {
                    return new Promise((resolve, reject) => {
                        prefs[key] = value;
                        localStorage.setItem(`cels-prefs-${id}`, JSON.stringify(prefs));
                        resolve(true);
                    });
                },
            };
        }
    };

    let Globals = {
        'api': api,
        'meta': meta,
        'preferences': preferences,
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
})(jQuery);