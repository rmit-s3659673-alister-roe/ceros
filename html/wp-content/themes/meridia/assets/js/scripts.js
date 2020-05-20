(function ($) {
  "use strict";

  var $window = $(window);
  var meridia = meridia || {};

  $window.load(function () {
    // Preloader
    $('.loader').fadeOut();
    $('.loader-mask').delay(350).fadeOut('slow');

    $window.trigger("resize");
    initOwlCarousel();
  });

  // Init
  initResponsiveTables();


  /* Detect Browser Size
  -------------------------------------------------------*/
  var minWidth;
  if (Modernizr.mq('(min-width: 0px)')) {
    // Browsers that support media queries
    minWidth = function (width) {
      return Modernizr.mq('(min-width: ' + width + 'px)');
    };
  }
  else {
    // Fallback for browsers that does not support media queries
    minWidth = function (width) {
      return $window.width() >= width;
    };
  }

  /* Mobile Detect
  -------------------------------------------------------*/
  if (/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent || navigator.vendor || window.opera)) {
    $('html').addClass('mobile');
  }
  else {
    $('html').removeClass('mobile');
  }

  /* IE Detect
  -------------------------------------------------------*/
  if (Function('/*@cc_on return document.documentMode===10@*/')()) { $("html").addClass("ie"); }



  /* Sticky Navigation
  -------------------------------------------------------*/
  $window.scroll(function () {
    scrollToTop();
    var $navTransparent = $('.nav--transparent');

    if ($(window).scrollTop() > 10 & minWidth(992)) {
      $navTransparent.addClass('sticky');
    } else {
      $navTransparent.removeClass('sticky');
    }

  });


  /*	-----------------------------------------------------------------------------------------------
    Primary Menu
  --------------------------------------------------------------------------------------------------- */
  meridia.primaryMenu = {

    init: function() {
      this.focusMenuWithChildren();
    },

    // The focusMenuWithChildren() function implements Keyboard Navigation in the Primary Menu
    // by adding the '.focus' class to all 'li.menu-item-has-children' when the focus is on the 'a' element.
    focusMenuWithChildren: function() {
      // Get all the link elements within the primary menu.
      var links, i, len,
        menu = document.querySelector( '.nav__wrap' );

      if ( ! menu ) {
        return false;
      }

      links = menu.getElementsByTagName( 'a' );

      // Each time a menu link is focused or blurred, toggle focus.
      for ( i = 0, len = links.length; i < len; i++ ) {
        links[i].addEventListener( 'focus', toggleFocus, true );
        links[i].addEventListener( 'blur', toggleFocus, true );
      }

      //Sets or removes the .focus class on an element.
      function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav__menu.
        while (-1 === self.className.indexOf( 'nav__menu' ) ) {
          // On li elements toggle the class .focus.
          if ( 'li' === self.tagName.toLowerCase() ) {
            if ( -1 !== self.className.indexOf( 'focus' ) ) {
              self.className = self.className.replace( ' focus', '' );
            } else {
              self.className += ' focus';
            }
          }
          self = self.parentElement;
        }
      }
    }
  }; // meridia.primaryMenu


  /* Mobile Navigation
  -------------------------------------------------------*/
  (function() {
    var $dropdownTrigger = $('.nav__dropdown-trigger');
    $dropdownTrigger.on('click', function() {
      var $this = $(this);
      $this.attr('aria-expanded', function(index, attr){
        return attr == 'true' ? 'false' : 'true';
      });

      if ($this.hasClass("active")) {
        $this.removeClass("active");
      }
      else {
        $this.addClass("active");
      }
    });

    if ( $('html').hasClass('mobile') ) {
      $('body').on('click',function() {
        $('.nav__dropdown-menu').addClass('hide-dropdown');
      });

      $('.nav__dropdown').on('click',function(e) {
        e.stopPropagation();
        $('.nav__dropdown-menu').removeClass('hide-dropdown');
      });
    }
  })();


  /* Search
  -------------------------------------------------------*/
  (function() {
    var $searchClose = $('#search-close'),
      $searchWrap = $('.search-wrap'),
      $searchTrigger = $('.nav__search-trigger'),
      $navSearch = $('.nav-search');

    $searchTrigger.on('click', function (e) {
      e.preventDefault();
      $searchWrap.animate({ opacity: 'toggle' }, 500);
      $navSearch.add($searchClose).addClass("open");
      $('.search-wrap .search-input').focus();
    });

    $searchClose.on('click', function (e) {
      e.preventDefault();
      $searchWrap.animate({ opacity: 'toggle' }, 500);
      $navSearch.add($searchClose).removeClass("open");

    });

    function closeSearch() {
      $searchWrap.fadeOut(200);
      $navSearch.add($searchClose).removeClass("open");
    }

    $(document.body).on('click', function (e) {
      closeSearch();
    });

    $searchWrap.add($searchTrigger).on('click', function (e) {
      e.stopPropagation();
    });
  })(); 


  /* Owl Carousel
  -------------------------------------------------------*/
  function initOwlCarousel() {

    /* Hero Carousel
    -------------------------------------------------------*/
    $("#owl-hero-carousel").owlCarousel({
      nav: true,
      dots: false,
      loop: true,
      margin: 4,
      navText: ['<i class="ui-arrow-left">', '<i class="ui-arrow-right">'],
      responsive:{
          0:{
            items:1
          },
          600:{
            items:3
          },
          1000:{
            items:4
          }
      }
    })

    /* Single Image
    -------------------------------------------------------*/
    $(".owl-single").owlCarousel({
      nav: true,
      dots: false,
      loop: false,
      items: 1,
      navSpeed: 300,
      animateIn: 'fadeIn',
      animateOut: 'fadeOut',
      navText: ['<i class="ui-arrow-left">', '<i class="ui-arrow-right">']
    })

  };


  /* Responsive Tables
  -------------------------------------------------------*/
  function initResponsiveTables() {
    var $table = $('.wp-block-table');
    if ( $table.length > 0 ) {
      $table.wrap('<div class="table-responsive"></div>');
    }
  }


  /* Accordion
  -------------------------------------------------------*/
  function toggleChevron(e) {
    $(e.target)
      .prev('.panel-heading')
      .find("a")
      .toggleClass('plus minus');
  }
  $('#accordion').on('hide.bs.collapse', toggleChevron);
  $('#accordion').on('show.bs.collapse', toggleChevron);


  /* Toggle
  -------------------------------------------------------*/
  $(".toggle > .panel-content").hide();
  $(".toggle > .acc-panel > a").on('click', function () {

    if ($(this).hasClass("active")) {
      $(this).parent().next().slideUp("easeOutExpo");
      $(this).removeClass("active");
    }

    else {
      $(this).parent().next(".panel-content");
      $(this).addClass("active");
      $(this).parent().next().slideDown("easeOutExpo");
    }

    return false;
  });


  /* Scroll to Top
  -------------------------------------------------------*/
  function scrollToTop() {
    var scroll = $window.scrollTop();
    var $backToTop = $("#back-to-top");
    if (scroll >= 50) {
      $backToTop.addClass("show");
    } else {
      $backToTop.removeClass("show");
    }
  }

  $('a[href="#top"]').on('click',function(){
    $('html, body').animate({scrollTop: 0}, 750 );
    return false;
  });

  /* Document Ready
  -------------------------------------------------------*/
  $(document).ready( function() {
    meridia.primaryMenu.init();
  });


})(jQuery);