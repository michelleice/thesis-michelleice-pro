/**
 * cels-request.js
 * An asynchronous JQuery's AJAX Request Helper
 * 
 * (c) Cels Technology Solutions, 2019
 */

(($) => {
    class Request {
        constructor(auth = false, csrf = false) {
            this._auth = auth;
            this._csrf = csrf;
            this.api_key = $('meta[name=api-key]').attr('content');
            this.csrf_token = $('meta[name=csrf-token]').attr('content');
        }
        static init(auth = false, csrf = false) {
            return (new Request(auth, csrf));
        }

        auth(auth = true) {
            this._auth = auth;
            return this;
        }
        csrf(csrf = true) {
            this._csrf = csrf;
            return this;
        }
        refreshCSRF(csrf_token = null) {
            if (csrf_token) {
                this.csrf_token = csrf_token;
                $('meta[name=csrf-token]').attr('content', csrf_token);
            }
            else {
                this.csrf_token = $('meta[name=csrf-token]').attr('content');
            }
            return this;
        }
        async request(method, url, data = {}, headers = {}, settings = {}) {
            this.refreshCSRF();

            if (this._auth) headers['Authorization'] = `Bearer ${this.api_key}`;
            if (this._csrf) headers['X-CSRF-TOKEN'] = this.csrf_token;

            return new Promise((resolve, reject) => {
                $.ajax({
                    url: url,
                    method: method,
                    cache: false,
                    data: data,
                    headers: {
                        'Accept': 'application/json,*/*;q=0.9',
                        ...headers
                    },
                    success: result => resolve(result),
                    error: err => {
                        if (!window.Cels.Request.error_shown) {
                            window.Cels.Request.error_shown = true;
                            toastr.error('Failed to fetch data. Please refresh the page or try again later.', 'Error');
                        }
                        reject(err);
                    },
                    ...settings
                });
            });
        }
    }

    if (window.Cels) {
        window.Cels['Request'] = Request;
    }
    else {
        window.Cels = {
            'Request': Request
        };
    }
})(jQuery);