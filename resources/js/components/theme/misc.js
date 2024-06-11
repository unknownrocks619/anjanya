var ChartColor = ["#5D62B4", "#54C3BE", "#EF726F", "#F9C446", "rgb(93.0, 98.0, 180.0)", "#21B7EC", "#04BCCC"];
var primaryColor = getComputedStyle(document.body).getPropertyValue('--primary');
var secondaryColor = getComputedStyle(document.body).getPropertyValue('--secondary');
var successColor = getComputedStyle(document.body).getPropertyValue('--success');
var warningColor = getComputedStyle(document.body).getPropertyValue('--warning');
var dangerColor = getComputedStyle(document.body).getPropertyValue('--danger');
var infoColor = getComputedStyle(document.body).getPropertyValue('--info');
var darkColor = getComputedStyle(document.body).getPropertyValue('--dark');
var lightColor = getComputedStyle(document.body).getPropertyValue('--light');

(function($) {
  'use strict';
  $(function() {
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('.sidebar');

    //Add active class to nav-link based on url dynamically
    //Active class can be hard coded directly in html file also as required

    function addActiveClass(element) {
      if (current === "") {
        //for root url
        if (element.attr('href').indexOf("index.html") !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
        }
      } else {
        //for other url
        if (element.attr('href').indexOf(current) !== -1) {
          element.parents('.nav-item').last().addClass('active');
          if (element.parents('.sub-menu').length) {
            element.closest('.collapse').addClass('show');
            element.addClass('active');
          }
          if (element.parents('.submenu-item').length) {
            element.addClass('active');
          }
        }
      }
    }

    // var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
    // $('.nav li a', sidebar).each(function() {
    //   var $this = $(this);
    //   //addActiveClass($this);
    // })
    //
    // $('.horizontal-menu .nav li a').each(function() {
    //   var $this = $(this);
    //   //addActiveClass($this);
    // })

    //Close other submenu in sidebar on opening any

    sidebar.on('show.bs.collapse', '.collapse', function() {
      sidebar.find('.collapse.show').collapse('hide');
    });


    //Change sidebar and content-wrapper height
    applyStyles();

      function applyStyles() {
          //Applying perfect scrollbar
          if (!body.hasClass("rtl")) {
              if (body.hasClass("sidebar-fixed")) {
                  var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
              }
          }
      }

      window.onscroll = function () {
          stickyNavButtons()
      }

      function stickyNavButtons() {
          let nav = document.getElementById('stickyNav')
          if (typeof nav !== 'undefined' && nav !== null) {
              let sticky = (nav.offsetTop + 70);
              let width = $(nav).parent('.row').width()

              if (window.pageYOffset >= sticky) {
                  nav.style.position = 'fixed'
                  nav.style.width = ((width / 100) * 17).toString() + 'px'
                  nav.style.top = '100px'
                  nav.style.right = '20px'
              } else {
                  nav.style.position = 'unset'
                  nav.style.top = 'unset'
                  nav.style.right = 'unset'
                  nav.style.width = '100%'
              }
          }
      }

      $('[data-toggle="minimize"]').on("click", function () {
          if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
              body.toggleClass('sidebar-hidden');
          } else {
              body.toggleClass('sidebar-icon-only');
          }
      });

      //checkbox and radios
      $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

    //fullscreen
    $("#fullscreen-button").on("click", function toggleFullScreen() {
      if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
          document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
          document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (document.documentElement.msRequestFullscreen) {
          document.documentElement.msRequestFullscreen();
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      }
    })

    $('#showNewTag').click(function () {
        $('#customTagForm').toggleClass('hidden');
    });
    $(document).on('click','.customise_button', function(){
        let itemid = this.getAttribute('itemid')

        $('#confirm_customise_button'+itemid).toggleClass('hidden');
        $('#customise_form'+itemid).toggleClass('hidden');
        $('#customise_section'+itemid).toggleClass('hidden');
        $(this).closest('.lister-item').toggleClass('customizing');

        if ($(this).closest('.lister-item').hasClass('customizing')) {
            $('#customise_button'+itemid).text('Cancel');
            $('#customise_button'+itemid)
                .removeClass('btn-info')
                .addClass('btn-secondary');
            $('.tag-action-column-'+itemid)
                .removeClass('col-4')
                .addClass('col-9');
        } else {
            $('#customise_button'+itemid).text('Customise');
            $('#customise_button'+itemid)
                .removeClass('btn-secondary')
                .addClass('btn-info');
            $('.tag-action-column-'+itemid)
                .removeClass('col-9')
                .addClass('col-4');
        }
    });

    $('#product_tag_selection').change( function () {
        const el = document.getElementById('product_tag_selection');
        if (el.value !== ''){
            $('form#selectedTagForm').submit();
        }
    });
  });
})(jQuery);
