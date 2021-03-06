jQuery(function($) {
    "use strict";
    //dashboard active link on click
    $('.dash-navbar-left .dnl-nav li').on('click', function(e){
        $('.dash-navbar-left .dnl-nav li').removeClass('active');
        $(this).addClass('active');
    })

    // Navbar left
    // -------------------------------------------------

    // Variables
    var dnl = $(".dash-navbar-left"),
        dnlBtnToggle = $(".dnl-btn-toggle"),
        dnlBtnCollapse = $(".dnl-btn-collapse"),
        contentWrap = $(".content-wrap"),
        contentWrapEffect = contentWrap.data("effect"),
        windowHeight = $(window).height() - 61,
        windowWidth = $(window).width() < 767;

    // Functions
    function cwShowOverflow() {
        if (windowWidth) {
            contentWrap.css({
                height: windowHeight,
                overflow: 'hidden'
            });
            $('html, body').css('overflow', 'hidden').css({'position': 'fixed','top': 0,'left':0,'right': 0});            
        }
    }

    function cwHideOverflow() {
        if (windowWidth) {
            contentWrap.css({
                height: 'auto',
                overflow: 'auto'
            });
            $('html, body').css('overflow', 'auto').css({'position': 'initial'});
        }
    }
    // Collapse dash nabnar left on link click

    $('.dnl-nav a').click(function(e) {

        dnlHide();
    });
    if (dnl.hasClass('dnl-show')) {
        console.log('sidebar open');
    }


    function dnlShow() {
        dnl.addClass("dnl-show").removeClass("dnl-hide");
        contentWrap.addClass(contentWrapEffect);
        cwShowOverflow();
        dnlBtnToggle.find("span").removeClass("fa-bars").addClass("fa-arrow-left");
    }

    function dnlHide() {
        dnl.removeClass("dnl-show").addClass("dnl-hide");
        contentWrap.removeClass(contentWrapEffect);
        cwHideOverflow();
        dnlBtnToggle.find("span").removeClass("fa-arrow-left").addClass("fa-bars");
    }

    // Toggle the edge navbar left
    dnl.addClass("dnl-hide");
    dnlBtnToggle.click(function() {
        if (dnl.hasClass("dnl-hide")) {
            dnlShow();
        } else {
            dnlHide();
        }
    });

    // Collapse the dash navbar left subnav
    dnlBtnCollapse.click(function(e) {
        e.preventDefault();
        if (dnl.hasClass("dnl-collapsed")) {
            dnl.removeClass("dnl-collapsed");
            contentWrap.removeClass("dnl-collapsed");
            $(this).find(".dnl-link-icon").removeClass("fa-arrow-right").addClass("fa-arrow-left");
        } else {
            dnl.addClass("dnl-collapsed");
            contentWrap.addClass("dnl-collapsed");
            $(this).find(".dnl-link-icon").removeClass("fa-arrow-left").addClass("fa-arrow-right");
        }
    });

    // Close left navbar when top navbar opens
    $('.navbar-toggle').click(function() {
        if ($(this).hasClass('collapsed')) {
            dnlHide();
        }
    });

    // Close top navbar when left navbar opens
    dnlBtnToggle.click(function() {
        $('.navbar-toggle').addClass('collapsed');
        $('.navbar-collapse').removeClass('in');
    });

    // Code credit: https://tr.im/CZzf4
    function isMobile() {
        try {
            document.createEvent("TouchEvent");
            return true;
        } catch (e) {
            return false;
        }
    }

    // Swipe the navbar
    if (isMobile() == true) {
        $(window).swipe({
            swipeRight: function() {
                dnlShow();
                $('.navbar-collapse').removeClass('in');
            },
            swipeLeft: function() {
                dnlHide();
            },
            threshold: 75
        });
    }

    // Collapse navbar on content click
    $('.content-wrap').click(function() {
        dnlHide();
    });

    // Auto collapse other opens subnavs
    /*$(".dnl-nav > li > a").click( function() {
        $( document ).find( 'ul .in' ).collapse( 'hide' );
    });*/

});
