import './bootstrap.js';
//================= Themes ===========================//
import './components/scrollbar/simplebar.js'
import './components/scrollbar/custom'
import './components/config.js';
import './components/script.js';
import './components/prism/prism.min.js'
//=================== Blueprints =====================//

//================== partials ======================//
import './partials/ajax-form.js'
import './partials/dzone.js'
import './partials/ajax-modal';
import './partials/select2'
import './partials/datatable.js'
import './partials/tinymce.js'
import './partials/pricing-breaks.js'
import './partials/slider.js'
//================== Components ====================//
import './partials/component/component-selector.js'
import './partials/course/course.js'
import './partials/course/permission.js'
import './partials/lessions/lession.js'
import './partials/orders/order.js'
import './partials/sortable/sort.js'

import './partials/users/users.js'

$(function () {
    "use strict";

    /**
     * Ajax Setup
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.ajax-append').each(function () {
        $(this).append(`<input type='hidden' name='_token' value='${$('meta[name=csrf-token]').attr('content')}' />`);
    })



    // Loader
    $(".loader-wrapper").fadeOut("slow", function () {
        setTimeout(function () {
            $(this).remove();
        }, 100);
    });

    // Tap To Top Button
    $(".tap-top").on("click", function () {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            600
        );
        return false;
    });

    // Scroll Function
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 600) {
            $(".tap-top").fadeIn();
        } else {
            $(".tap-top").fadeOut();
        }
    });

    // active link

    $(".chat-menu-icons .toogle-bar").on("click", function () {
        $(".chat-menu").toggleClass("show");
    });

    $(".mobile-title svg").on("click", function () {
        $(".header-mega").toggleClass("d-block");
    });

    $(".onhover-dropdown").on("click", function () {
        $(this).children(".onhover-show-div").toggleClass("active");
    });

    $("#flip-btn").on("click", function () {
        $(".flip-card-inner").addClass("flipped");
    });

    $("#flip-back").on("click", function () {
        $(".flip-card-inner").removeClass("flipped");
    });

    //landing header
    $(".toggle-menu").on("click", function () {
        $(".landing-menu").toggleClass("open");
    });
    $(".menu-back").on("click", function () {
        $(".landing-menu").toggleClass("open");
    });

    $(".md-sidebar-toggle").on("click", function () {
        $(".md-sidebar-aside").toggleClass("open");
    });

    // color selector
    $(".color-selector ul li ").on("click", function (e) {
        $(".color-selector ul li").removeClass("active");
        $(this).addClass("active");
    });

    $(document).on("click", function (e) {
        var outside_space = $(".outside");
        if (
            !outside_space.is(e.target) &&
            outside_space.has(e.target).length === 0
        ) {
            $(".menu-to-be-close").removeClass("d-block");
            $(".menu-to-be-close").css("display", "none");
        }
    });

    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
        $(".sidebar-list").hover(
            function () {
                $(this).addClass("hoverd");
            },
            function () {
                $(this).removeClass("hoverd");
            }
        );
        $(window).on("scroll", function () {
            if ($(this).scrollTop() < 600) {
                $(".sidebar-list").removeClass("hoverd");
            }
        });
    }

    /* ----------- passward show hide
    ----------------------------------------*/
    $(".show-hide").show();
    $(".show-hide span").addClass("show");

    $(".show-hide span").on("click", function () {
        if ($(this).hasClass("show")) {
            $('.show-password').attr("type", "text");
            $(this).removeClass("show");
        } else {
            $('.show-password').attr("type", "password");
            $(this).addClass("show");
        }
    });
    $('form button[type="submit"]').on("click", function () {
        $(".show-hide span").addClass("show");
        $(".show-hide")
            .parent()
            .find('input[name="login[password]"]')
            .attr("type", "password");
    });

    /*=====================
        02. Background Image js
        ==========================*/
    $(".bg-center").parent().addClass("b-center");
    $(".bg-img-cover").parent().addClass("bg-size");
    $(".bg-img-cover").each(function () {
        var el = $(this),
            src = el.attr("src"),
            parent = el.parent();
        parent.css({
            "background-image": "url(" + src + ")",
            "background-size": "cover",
            "background-position": "center",
            display: "block",
        });
        el.hide();
    });

    $(".mega-menu-container").css("display", "none");
    $(".header-search").on("click", function () {
        $(".search-full").addClass("open");
    });
    $(".close-search").on("click", function () {
        $(".search-full").removeClass("open");
        $("body").removeClass("offcanvas");
    });
    $(".mobile-toggle").on("click", function () {
        $(".nav-menus").toggleClass("open");
    });
    $(".bookmark-search").on("click", function () {
        $(".form-control-search").toggleClass("open");
    });
    $(".filter-toggle").on("click", function () {
        $(".product-sidebar").toggleClass("open");
    });
    $(".toggle-data").on("click", function () {
        $(".product-wrapper").toggleClass("sidebaron");
    });

    $(".mobile-search").on("click", function () {
        $(".form-control").toggleClass("open");
    });

    $(".form-control-search input").keyup(function (e) {
        if (e.target.value) {
            $(".page-wrapper").addClass("offcanvas-bookmark");
        } else {
            $(".page-wrapper").removeClass("offcanvas-bookmark");
        }
    });
    $(".search-full input").keyup(function (e) {
        console.log(e.target.value);
        if (e.target.value) {
            $("body").addClass("offcanvas");
        } else {
            $("body").removeClass("offcanvas");
        }
    });


    $(document).on('keydown', function (event) {
        if (event.ctrlKey === true); {
            // $(".system-search").focus();
        }
    });


    /**
     * Navigation
     */

    $(".toggle-nav").on('click', function () {
        $("#sidebar-links .nav-menu").css("left", "0px");
    });
    $(".mobile-back").on('click', function () {
        $("#sidebar-links .nav-menu").css("left", "-410px");
    });

    $(".page-wrapper").attr("class", "page-wrapper " + localStorage.getItem('page-wrapper'));
    if (localStorage.getItem("page-wrapper") === null) {
        $(".page-wrapper").addClass("compact-wrapper");
    }

    // left sidebar and vertical menu
    if ($("#pageWrapper").hasClass("compact-wrapper")) {
        $(".sidebar-title").append(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
        $(".sidebar-title").on('click', function () {
            $(".sidebar-title")
                .removeClass("active")
                .find("div")
                .replaceWith(
                    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                );
            $(".sidebar-submenu, .menu-content").slideUp("normal");
            $(".menu-content").slideUp("normal");
            if ($(this).next().is(":hidden") == true) {
                $(this).addClass("active");
                $(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                    );
                $(this).next().slideDown("normal");
            } else {
                $(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );
            }
        });
        $(".sidebar-submenu, .menu-content").hide();
        $(".submenu-title").append(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
        $(".submenu-title").on('click', function () {
            $(".submenu-title")
                .removeClass("active")
                .find("div")
                .replaceWith(
                    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                );
            $(".submenu-content").slideUp("normal");
            if ($(this).next().is(":hidden") == true) {
                $(this).addClass("active");
                $(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                    );
                $(this).next().slideDown("normal");
            } else {
                $(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );
            }
        });
        $(".submenu-content").hide();
    } else if ($("#pageWrapper").hasClass("horizontal-wrapper")) {
        $(window).on("load", function () {
            $(document).load($(window).bind("resize", checkPosition));
            function checkPosition() {
                if (window.matchMedia("(max-width: 991px)").matches) {
                    $("#pageWrapper")
                        .removeClass("horizontal-wrapper")
                        .addClass("compact-wrapper");
                    $(".page-body-wrapper")
                        .removeClass("horizontal-menu")
                        .addClass("sidebar-icon");
                    $(".submenu-title").append(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );
                    $(".submenu-title").on('click', function () {
                        $(".submenu-title").removeClass("active");
                        $(".submenu-title")
                            .find("div")
                            .replaceWith(
                                '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                            );
                        $(".submenu-content").slideUp("normal");
                        if ($(this).next().is(":hidden") == true) {
                            $(this).addClass("active");
                            $(this)
                                .find("div")
                                .replaceWith(
                                    '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                                );
                            $(this).next().slideDown("normal");
                        } else {
                            $(this)
                                .find("div")
                                .replaceWith(
                                    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                                );
                        }
                    });
                    $(".submenu-content").hide();

                    $(".sidebar-title").append(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );
                    $(".sidebar-title").on('click', function () {
                        $(".sidebar-title").removeClass("active");
                        $(".sidebar-title")
                            .find("div")
                            .replaceWith(
                                '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                            );
                        $(".sidebar-submenu, .menu-content").slideUp("normal");
                        if ($(this).next().is(":hidden") == true) {
                            $(this).addClass("active");
                            $(this)
                                .find("div")
                                .replaceWith(
                                    '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                                );
                            $(this).next().slideDown("normal");
                        } else {
                            $(this)
                                .find("div")
                                .replaceWith(
                                    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                                );
                        }
                    });
                    $(".sidebar-submenu, .menu-content").hide();
                }
            }
        });
    } else if ($("#pageWrapper").hasClass("compact-sidebar")) {
        var contentwidth = $(window).width();
        if (contentwidth > 992) {
            $('<div class="bg-overlay1"></div>').appendTo($("body"));
        }

        $(".sidebar-title").on('click', function () {
            $(".sidebar-title").removeClass("active");
            $(".bg-overlay1").removeClass("active");
            $(".sidebar-submenu").removeClass("close-submenu").slideUp("normal");
            $(".sidebar-submenu, .menu-content").slideUp("normal");
            $(".menu-content").slideUp("normal");

            if ($(this).next().is(":hidden") == true) {
                $(this).addClass("active");
                $(this).next().slideDown("normal");
                $(".bg-overlay1").addClass("active");

                $(".bg-overlay1").on('click', function () {
                    $(".sidebar-submenu, .menu-content").slideUp("normal");
                    $(this).removeClass("active");
                });
            }
            if (contentwidth < "992") {
                $(".bg-overlay").addClass("active");
            }
        });
        $(".sidebar-submenu, .menu-content").hide();
        $(".submenu-title").append(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
        $(".submenu-title").on('click', function () {
            $(".submenu-title")
                .removeClass("active")
                .find("div")
                .replaceWith(
                    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                );
            $(".submenu-content").slideUp("normal");
            if ($(this).next().is(":hidden") == true) {
                $(this).addClass("active");
                $(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                    );
                $(this).next().slideDown("normal");
            } else {
                $(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );
            }
        });
        $(".submenu-content").hide();

        $(".sidebar-wrapper nav").find("a").removeClass("active");
        $(".sidebar-wrapper nav").find("li").removeClass("active");

        var current = window.location.pathname;
        $(".sidebar-wrapper nav ul>li a").filter(function () {
            var link = $(this).attr("href");
            if (link) {
                if (current.indexOf(link) != -1) {
                    $(this).parents().children("a").addClass("active");
                    $(this)
                        .parents()
                        .parents()
                        .children(".nav-sub-childmenu")
                        .css("display", "block");
                    $(this).addClass("active");
                    $(this)
                        .parent()
                        .parent()
                        .parent()
                        .children("a")
                        .find("div")
                        .replaceWith(
                            '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                        );
                    return false;
                }
            }
        });
    }

    // toggle sidebar
    var $nav = $(".sidebar-wrapper");
    var $header = $(".page-header");
    var $toggle_nav_top = $(".toggle-sidebar");
    $toggle_nav_top.on('click', function () {
        $nav.toggleClass("close_icon");
        $header.toggleClass("close_icon");
        $(window).trigger("overlay");
    });

    $(window).on("overlay", function () {
        var $bgOverlay = $(".bg-overlay");
        var $isHidden = $nav.hasClass("close_icon");
        if ($(window).width() <= 991 && !$isHidden && $bgOverlay.length === 0) {
            $('<div class="bg-overlay active"></div>').appendTo($("body"));
        }

        if ($isHidden && $bgOverlay.length > 0) {
            $bgOverlay.remove();
        }
    });

    $(".sidebar-wrapper .back-btn").on('click', function (e) {
        $(".page-header").toggleClass("close_icon");
        $(".sidebar-wrapper").toggleClass("close_icon");
        $(window).trigger("overlay");
    });

    $("body").on("click", ".bg-overlay", function () {
        $header.addClass("close_icon");
        $nav.addClass("close_icon");
        $(this).remove();
    });

    var $body_part_side = $(".body-part");
    $body_part_side.on('click', function () {
        $toggle_nav_top.attr("checked", false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    });

    //    responsive sidebar
    var $window = $(window);
    var widthwindow = $window.width();
    (function ($) {
        "use strict";
        if (widthwindow <= 1385) {
            $toggle_nav_top.attr("checked", false);
            $nav.addClass("close_icon");
            $header.addClass("close_icon");
        }
    })(jQuery);

    // horizontal arrows
    var view = $("#sidebar-menu");
    var move = "500px";
    var leftsideLimit = -500;

    // get wrapper width
    var getMenuWrapperSize = function () {
        return $(".sidebar-wrapper").innerWidth();
    };
    var menuWrapperSize = getMenuWrapperSize();

    if (menuWrapperSize >= "1660") {
        var sliderLimit = -3000;
    } else if (menuWrapperSize >= "1440") {
        var sliderLimit = -3600;
    } else {
        var sliderLimit = -4200;
    }

    $("#left-arrow").addClass("disabled");
    $("#right-arrow").on('click', function () {
        var currentPosition = parseInt(view.css("marginLeft"));
        if (currentPosition >= sliderLimit) {
            $("#left-arrow").removeClass("disabled");
            view.stop(false, true).animate(
                {
                    marginLeft: "-=" + move,
                },
                {
                    duration: 400,
                }
            );
            if (currentPosition == sliderLimit) {
                $(this).addClass("disabled");
            }
        }
    });

    $("#left-arrow").on('click', function () {
        var currentPosition = parseInt(view.css("marginLeft"));
        if (currentPosition < 0) {
            view.stop(false, true).animate(
                {
                    marginLeft: "+=" + move,
                },
                {
                    duration: 400,
                }
            );
            $("#right-arrow").removeClass("disabled");
            $("#left-arrow").removeClass("disabled");
            if (currentPosition >= leftsideLimit) {
                $(this).addClass("disabled");
            }
        }
    });

    // page active
    if ($('#pageWrapper').hasClass('compact-wrapper')) {
        $(".sidebar-wrapper nav #sidebar-menu .simplebar-wrapper .simplebar-content-wrapper .simplebar-content").find("a").removeClass("active");
        $(".sidebar-wrapper nav #sidebar-menu .simplebar-wrapper .simplebar-content-wrapper .simplebar-content").find("li").removeClass("active");

        var current = window.location.pathname
        $(".sidebar-wrapper nav #sidebar-menu ul .simplebar-mask li a").filter(function () {

            var link = $(this).attr("href");
            if (link) {
                if (current.indexOf(link) != -1) {
                    $(this).parents().children('a').addClass('active');
                    $(this).parents().parents().children('ul').css('display', 'block');
                    $(this).addClass('active');
                    $(this).parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                    $(this).parent().parent().parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                    return false;
                }
            }
        });
    }

    $(".left-header .mega-menu .nav-link").on("click", function (event) {
        event.stopPropagation();
        $(this).parent().children(".mega-menu-container").toggleClass("show");
    });

    $(".left-header .level-menu .nav-link").on("click", function (event) {
        event.stopPropagation();
        $(this).parent().children(".header-level-menu").toggleClass("show");
    });

    $(document).on('click', function () {
        $(".mega-menu-container").removeClass("show");
        $(".header-level-menu").removeClass("show");
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            $(".mega-menu-container").removeClass("show");
            $(".header-level-menu").removeClass("show");
        }
    });

    $(".left-header .level-menu .nav-link").on('click', function () {
        if ($(".mega-menu-container").hasClass("show")) {
            $(".mega-menu-container").removeClass("show");
        }
    });

    $(".left-header .mega-menu .nav-link").on('click', function () {
        if ($(".header-level-menu").hasClass("show")) {
            $(".header-level-menu").removeClass("show");
        }
    });

    $(document).ready(function () {
        $(".outside").on('click', function () {
            $(this).find(".menu-to-be-close").slideToggle("fast");
        });
    });
    $(document).on("click", function (event) {
        var $trigger = $(".outside");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".menu-to-be-close").slideUp("fast");
        }
    });

    $(".left-header .link-section > div").on("click", function (e) {
        if ($(window).width() <= 1199) {
            $(".left-header .link-section > div").removeClass("active");
            $(this).toggleClass("active");
            $(this).parent().children("ul").toggleClass("d-block").slideToggle();
        }
    });

    if ($(window).width() <= 1199) {
        $(".left-header .link-section").children("ul").css("display", "none");
        $(this).parent().children("ul").toggleClass("d-block").slideToggle();
    }
    // active link
    if ($('.simplebar-wrapper .simplebar-content-wrapper').length) {
        if ($('.simplebar-wrapper .simplebar-content-wrapper') && $('#pageWrapper').hasClass('compact-wrapper')) {
            $('.simplebar-wrapper .simplebar-content-wrapper').animate({
                scrollTop: $('.simplebar-wrapper .simplebar-content-wrapper a.active').offset().top - 400
            }, 1000);
        }
    }


    $(window).resize(function () {
        var widthwindaw = $window.width();
        if (widthwindaw <= 1400) {
            $toggle_nav_top.attr("checked", false);
            $nav.addClass("close_icon");
            $header.addClass("close_icon");
            // alert("1");
        }
        else if (widthwindaw => 1400) {
            $toggle_nav_top.attr("checked", true);
            $nav.removeClass("close_icon");
            $header.removeClass("close_icon");
            // alert(" else if ");
        }
    });



    /**
     * End Navigation
     */

    $("body").keydown(function (e) {
        if (e.keyCode == 27) {
            $(".search-full input").val("");
            $(".form-control-search input").val("");
            $(".page-wrapper").removeClass("offcanvas-bookmark");
            $(".search-full").removeClass("open");
            $(".search-form .form-control-search").removeClass("open");
            $("body").removeClass("offcanvas");
        }
    });
    $(".mode").on("click", function () {
        $(".mode i").toggleClass("fa-moon-o").toggleClass("fa-lightbulb-o");
        $("body").toggleClass("dark-only");
        var color = $(this).attr("data-attr");
        localStorage.setItem("body", "dark-only");
    });

    // Language

    var tnum = "en";

    $(document).on('click', '.button-click', function (event) {
        event.preventDefault();
        window.location.href = $(this).data('href');
    });

});

$(document).on('click', '.data-confirm', function (event) {
    event.preventDefault()
    let confirmTitle = $(this).data('confirm')
    let ele = this;
    Swal.fire({
        title: 'Are You Sure ?',
        text: confirmTitle ?? "Once deleted, you will not be able to recover !",
        showConfirmButton: true,
        showCloseButton: true,
        showCancelButton: true
    }).then((action) => {
        if (action.isConfirmed === true) {
            // perform ajax query.
            if ($(ele).data('action')) {
                $.ajax({
                    method: $(ele).data('method'),
                    url: $(ele).data('action'),
                    data: $(ele).data('values'),
                    success: function (response) {
                        handleOKResponse(response)
                    },
                    error: function (response) {
                        handleBadResponse(response);
                    }
                })
            }

            if ($(ele).attr('href') && !$(ele).attr('href') != '') {

                let param = { location: $(ele).attr('href') }
                redirect(param);
            }
        }
    })
})

window.handleOKResponse = function (response) {
    if (response.status == 200) {
        messageBox(response.state, response.msg);

        if ((response.callback !== null || response.callback !== '')) {
            let fn = window[response.callback];

            if (typeof (fn) === 'function') {
                fn(response.params);
            }
        }
    }
}


window.handleBadResponse = function (response) {
    clearAllErrors();
    if (response.status == 422) {
        handle422Case(response.responseJSON);
    }
}

window.handle422Case = function (data) {
    messageBox(false, data.msg ? data.msg : data.message);
    $.each(data.errors, function (index, error) {
        let inputElement = $(`input[name="${index}"]`);
        let parentDiv = $(inputElement).closest('div.form-group');

        if (parentDiv.length) {
            let element = `<div class='text-danger ajax-response-error'>${error}</div>`
            parentDiv.append(element);
        }
    });
}

window.redirect = function (param) {
    if (typeof param.location !== 'undefined' || param.location !== null) {
        window.location.href = param.location
    }
}

window.reload = function () {
    window.location.reload();
}


window.clearAllErrors = function () {
    $('.ajax-response-error').remove();
}

window.messageBox = function (status, message, icon = null) {
    if (!icon && status == false) {
        icon = "<i class='fa fa-warning'></i>";
    } else if (!icon && status == true) {
        icon = "<i class='fa fa-check-square'></i>";
    }
    $.notify(`${icon}<strong>${message}</strong>`, {
        type: (status) ? 'success' : 'danger',
        allow_dismiss: true,
        showProgressbar: true,
        timer: 100,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });
}
