(function ($) {
    'use strict';

    //Open submenu on hover in compact sidebar mode and horizontal menu mode
    $(document).on('mouseenter mouseleave', '.sidebar .nav-item', function (ev) {
        var body = $('body');
        var sidebarIconOnly = body.hasClass("sidebar-icon-only");
        var sidebarFixed = body.hasClass("sidebar-fixed");
        if (!('ontouchstart' in document.documentElement)) {
            if (sidebarIconOnly) {
                if (sidebarFixed) {
                    if (ev.type === 'mouseenter') {
                        body.removeClass('sidebar-icon-only');
                    }
                } else {
                    var $menuItem = $(this);
                    if (ev.type === 'mouseenter') {
                        $menuItem.addClass('hover-open')
                    } else {
                        $menuItem.removeClass('hover-open')
                    }
                }
            }
        }
    });

    $('.aside-toggler').click(function () {
        $('.chat-list-wrapper').toggleClass('slide')
    });

    $('.sidebar .nav-item').on('click', function() {
        $('.sidebar .nav-item .collapse').removeClass('show');
        $(this).find('.collapse ').addClass('show');
    });

    $(document).on('click', '[data-toggler]', function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $($(this).attr('data-toggler')).toggleClass('show');
    });

    $(document).mousedown(function (e) {
        var container = $(".navbar-menu-wrapper");

        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.navbar-menu-wrapper .dropdown-menu').removeClass('show').hide();
        }
    });

})(jQuery);
