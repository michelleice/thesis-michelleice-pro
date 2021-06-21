/**
 * cels-animatecss.js
 * An asynchronous AnimateCSS Helper
 * 
 * (c) Cels Technology Solutions, 2020
 */

(($) => {
    let animate = async ($el, type='bounce', prefix='animate__') => {
        return new Promise((resolve, reject) => {
            try {
                let on_end = function(e) {
                    $(this).removeClass(`${prefix}animated ${prefix}${type}`);
                    $el.off('animationend', on_end);
                    resolve();
                }
                $el.on('animationend', on_end);
                $el.addClass(`${prefix}animated ${prefix}${type}`);
            }
            catch (err) {
                reject(err);
            }
        });
    };

    if (window.Cels) {
        window.Cels['animate'] = animate;
    }
    else {
        window.Cels = {
            'animate': animate
        };
    }
})(jQuery);