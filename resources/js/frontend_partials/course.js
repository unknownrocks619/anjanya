$(document).on('click', '.course-enroll', function (event) {
    event.preventDefault();
    let _currentURL = $(this).attr('data-action');
    let _currentMethod = $(this).attr('data-method');
    let _this = this;
    $(this).removeAttr('data-action');
    $(this).addClass('disabled').attr('disabled', true);
    console.log('hellwo');
    $.ajax({
        method: _currentMethod,
        url: _currentURL,
        success: function (response) {
            handleOKResponse(response);
            $(_this).attr('data-action', _currentURL);
            $(_this).attr('data-method', _currentMethod);
            $(_this).removeClass('disabled').removeAttr('disabled');
        },
        error: function (response) {
            handleBadResponse(response);
            $(_this).attr('data-action', _currentURL);
            $(_this).attr('data-method', _currentMethod);
            $(_this).removeClass('disabled').removeAttr('disabled');

        }
    });
})

if ($('.lms-toggle').length && $('.lms-toggle').length == 1) {

    $(document).on('click', '.lms-action-toggle', function (event) {
        event.preventDefault();
        let _body = $('body');

        if ($(_body).hasClass('close')) {

            $(_body).removeClass('close').addClass('open');
        } else {
            $(_body).removeClass('open').addClass('close');
        }
    });
}

if ($('.swiper').length) {

    // image slider content
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}

if ($('.complete-lession-marker').length) {
    $(document).on('click', '.complete-lession-marker', function (event) {
        let _this = this;
        $(_this).prop('disabled', true);
        $.ajax({
            method: $(this).attr('data-method'),
            url: $(this).attr('data-action'),
            success: function (response) {
                handleOKResponse(response);
                $(_this).prop('disabled', false);
            },
            error: function (response) {
                handleBadResponse(response)
                $(_this).prop('disabled', false);
            }
        })

    });
}


if ($('[data-theme-course]').length) {

    let _courseTheme = $("[data-theme-course]");

    let _themeColour = $('[data-theme-course]').attr('data-theme-course');

    if ($('tagline').length) {

        let _tagLineElement = $('tagline');
        $.each(_tagLineElement, function (tagIndex, tagElement) {
            let _tagLineValue = $(tagElement).text();
            let _svg = `<span class="" style="color: ${_themeColour} !important">${_tagLineValue}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                    <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7" style="stroke:${_themeColour} !important"></path>
                </svg></span>
            `
            $(tagElement).replaceWith(_svg);
        });

    }

    if ($('themecolor').length) {

        let _tagThemeText = $('themecolor');

        $.each(_tagThemeText, function (themeIndex, ThemeElement) {
            let _themeText = $(ThemeElement).text();
            let _themeClasses = $(ThemeElement).attr('class');
            let _style = $(ThemeElement).attr('style')
            let _replaceText = `<span class='${_themeClasses}' style='color:${_themeColour} !important; ${_style}'>${_themeText}</span>`;

            $(ThemeElement).replaceWith(_replaceText)
        });

    }

    if ($('.implement-theme-color').length) {
        $(".implement-theme-color").attr('style', "color: " + _themeColour + " !important")
    }
    // search for tagline code to implement svg item.
}


if ($("registration").length) {
    let _text = 'Register Now'
    let _defaultTheme = "#242254";

    if ($('[data-theme-course]').length) {
        let _themeElement = $('[data-theme-course]')[0];
        _defaultTheme = $(_themeElement).attr('data-theme-course');
    }

    $.each($('registration'), function (registrationIndex, registrationElement) {

        let _elementText = $(registrationElement).text();

        if (_elementText != '') {
            _text = _elementText;
        }

        let _button = `<a href='/register' class='detail-btn mx-1' >${_text}</a>`
        $(registrationElement).replaceWith(_button);
    })
}


if ($("login").length) {
    let _text = 'Login'
    let _defaultTheme = "#242254";

    if ($('[data-theme-course]').length) {
        let _themeElement = $('[data-theme-course]')[0];
        _defaultTheme = $(_themeElement).attr('data-theme-course');
    }

    $.each($('login'), function (loginIndex, loginElement) {

        let _elementText = $(loginElement).text();

        if (_elementText != '') {
            _text = _elementText;
        }

        let _button = `<a href='/login' class='detail-btn mx-1' style='background:${_defaultTheme} !important'>${_text}</a>`
        $(loginElement).replaceWith(_button);
    })
}



if ($("enroll").length) {
    let _text = 'Enroll'
    let _defaultTheme = "#242254";

    if ($('[data-theme-course]').length) {
        let _themeElement = $('[data-theme-course]')[0];
        _defaultTheme = $(_themeElement).attr('data-theme-course');
    }

    $.each($('enroll'), function (enrollIndex, enrollElement) {

        let _elementText = $(enrollElement).text();
        let _link = $(enrollElement).attr('click');

        if (_elementText != '') {
            _text = _elementText;
        }

        let _button = `<a href='${_link}'  style='background:${_defaultTheme} !important'>${_text}</a>`
        $(enrollElement).replaceWith(_button);
    })
}


if ($('.bg-theme-background').length) {

    let _defaultTheme = "#242254";
    if ($('[data-theme-course]').length) {
        let _themeElement = $('[data-theme-course]')[0];
        _defaultTheme = $(_themeElement).attr('data-theme-course');
    }

    $('.bg-theme-background').css({ "background-color": _defaultTheme });
}

if ($(".enroll-course").length && $('body.course-enroll-page').length) {
    // $(document).on('click', '.enroll-course', function (event) {
    //     event.preventDefault();
    //     $(this).attr('disabled', true);

    // })
}
