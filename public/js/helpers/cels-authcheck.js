/**
 * cels-authcheck.js
 * Authentication check
 * 
 * (c) Cels Technology Solutions, 2019
 */

(($) => {
    let request = (new Cels.Request()).auth().csrf();
    let api = Cels.Globals.api;
    let _debounce = false;
    let _every = 5 * 60 * 1000;
    let _last = 0;

    let check_user = () => {
        if (_debounce) return;
        if ((new Date() - _last) < _every) return;
        _last = new Date();
        _debounce = true;

        request.request('GET', '/auth/csrf').then(res => {
            request.refreshCSRF(res.CSRF_TOKEN).request('GET', api('user')).then(res => {
                _debounce = false;
            }).catch(e => {
                toastr.info('It seems your session has been renewed. Please refresh the page.', 'Information');
            });
        }).catch(e => {
            // toastr.info('It seems your session has been renewed. Please refresh the page.', 'Information');
            window.location.reload();
        });
    }
    check_user();

    $(window).on('focus', e => {
        check_user();
    });
})(jQuery);