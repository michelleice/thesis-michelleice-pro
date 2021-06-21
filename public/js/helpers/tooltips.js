(($) => {
    $('[data-toggle="tooltip"]').tooltip();

    let tooltip_autoshowed = {};
    if (localStorage) {
        tooltip_autoshowed = JSON.parse(localStorage.getItem('bs4-tooltip-autoshowed'));
        if (!tooltip_autoshowed) {
            tooltip_autoshowed = {};
        }
    }

    let $autoshows = $('[tooltip-autoshow]');
    for (let autoshow of $autoshows) {
        let $autoshow = $(autoshow);
        if ($autoshow.is('[tooltip-autoshow-once]') && $autoshow.attr('id').trim() !== '') {
            let key = `${window.location.pathname}#${$autoshow.attr('id')}`;
            if (!tooltip_autoshowed || !(key in tooltip_autoshowed)) {
                $autoshow.tooltip('show');
                tooltip_autoshowed[key] = true;
                localStorage.setItem('bs4-tooltip-autoshowed', JSON.stringify(tooltip_autoshowed));
            }
        }
        else {
            $autoshow.tooltip('show');
        }
    }
})(jQuery);