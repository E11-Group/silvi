$(function () {
  $(document).ready(function () {
    function animateActive(elm) {
      $(elm).each(function () {
        var self = $(this),
          windowScrollTop = $(window).scrollTop(),
          selfTopPosition = self.offset().top,
          selfHeight = $(window).height(),
          totalWindowOffset = windowScrollTop + selfHeight;
        if (totalWindowOffset > selfTopPosition) {
          self.addClass('animate-active');
        } else {
          self.removeClass('animate-active');
        }
      });
    }

    setTimeout(function () {
      animateActive('[data-animate]');
    }, 300);

    $(window).on('scroll resize', function () {
      animateActive('[data-animate]');
    });
  });

  $(window).scroll(function () {
    if ($(window).scrollTop() >= 120) {
      $('.js-header').addClass('header--fixed');
    } else {
      $('.js-header').removeClass('header--fixed');
    }
  });

  $('.mobileNavDropdownToggle').on('click', function (e) {
    e.preventDefault();
    var self = $(this),
      hasActive = self.hasClass('is-active');
    if (hasActive) {
      self.removeClass('is-active');
      self.siblings('.sub-menu').removeClass('is-active');
    } else {
      self.toggleClass('is-active');
      self.siblings('.sub-menu').toggleClass('is-active');
    }
  });

  var productSettings = {
    infinite: true,
    speed: 500,
    autoplay: false,
    autoplaySpeed: 6000,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    variableWidth: false,
    cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',
    prevArrow:
      "<button type='button' class='slick-prev'><span class='screen-reader-text'>Arrow Prev</span><svg class='icon'><use xlink:href='#icon-arrow-right'></use></svg></button>",
    nextArrow:
      "<button type='button' class='slick-next'><span class='screen-reader-text'>Arrow Next</span><svg class='icon'><use xlink:href='#icon-arrow-right'></use></svg></button>",

    responsive: [
      {
        breakpoint: 1440,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
          arrows: false,
        },
      },
    ],
  };
  $('.js-products-showcase-slider').slick(productSettings);

  var $heroSlider = $('.js-hero-slider');
  $heroSlider
    .slick({
      infinite: false,
      speed: 500,
      autoplay: false,
      autoplaySpeed: 6000,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',
    })
    .on('swipe', function (event, slick, direction) {
      if (direction === 'right') {
        $('.js-hero-thumbnail .hero__menu-item.current')
          .prev()
          .addClass('current')
          .siblings()
          .removeClass('current');
      } else {
        $('.js-hero-thumbnail .hero__menu-item.current')
          .next()
          .addClass('current')
          .siblings()
          .removeClass('current');
      }
    });
  $heroSlider.on('afterChange', function () {
    var activeSlide = $(
      '.js-hero-thumbnail .hero__menu-item.slick-slide.slick-active'
    );
    $(activeSlide)
      .first()
      .addClass('first-slide')
      .siblings()
      .removeClass('first-slide');
    $(activeSlide)
      .last()
      .addClass('last-slide')
      .siblings()
      .removeClass('last-slide');
    if (!$(activeSlide).hasClass('slick-active')) {
      $(activeSlide).removeClass('first-slide last-slide');
    }
    if (!$(activeSlide).hasClass('slick-current')) {
      $(activeSlide).addClass('current');
    }

    var mainActive = $(
      '.js-hero-thumbnail .hero__menu-item.slick-slide.slick-active.current'
    );
    if ($(mainActive).hasClass('first-slide')) {
      $('.js-hero-thumbnail').slick('slickPrev');
    } else if ($(mainActive).hasClass('last-slide')) {
      $('.js-hero-thumbnail').slick('slickNext');
    }
  });

  $('.js-hero-thumbnail')
    .slick({
      infinite: false,
      speed: 500,
      autoplay: false,
      autoplaySpeed: 2000,
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      arrows: false,
      cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',

      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: false,
          },
        },
      ],
    })
    .on('afterChange', function (event, slick, currentSlide, nextSlide) {
      var activeSlide = $(
        '.js-hero-thumbnail .hero__menu-item.slick-slide.slick-active'
      );
      $(activeSlide)
        .first()
        .addClass('first-slide')
        .siblings()
        .removeClass('first-slide');
      $(activeSlide)
        .last()
        .addClass('last-slide')
        .siblings()
        .removeClass('last-slide');
      if (!$(activeSlide).hasClass('slick-active')) {
        $(activeSlide).removeClass('first-slide last-slide');
      }
      if (!$(activeSlide).hasClass('slick-current')) {
        $(activeSlide).addClass('current');
      }
    });

  $('.js-hero-links')
    .slick({
      infinite: false,
      speed: 500,
      autoplay: false,
      autoplaySpeed: 2000,
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      arrows: false,
      cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',

      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: false,
          },
        },
      ],
    })
    .on('afterChange', function (event, slick, currentSlide, nextSlide) {
      var activeSlide = $(
        '.js-hero-thumbnail .hero__menu-item.slick-slide.slick-active'
      );
      $(activeSlide)
        .first()
        .addClass('first-slide')
        .siblings()
        .removeClass('first-slide');
      $(activeSlide)
        .last()
        .addClass('last-slide')
        .siblings()
        .removeClass('last-slide');
      if (!$(activeSlide).hasClass('slick-active')) {
        $(activeSlide).removeClass('first-slide last-slide');
      }
      if (!$(activeSlide).hasClass('slick-current')) {
        $(activeSlide).addClass('current');
      }
    });

  $('.js-hero-thumbnail .hero__menu-item').eq(0).addClass('current');
  var activeSlide = $(
    '.js-hero-thumbnail .hero__menu-item.slick-slide.slick-active'
  );
  $(activeSlide)
    .first()
    .addClass('first-slide')
    .siblings()
    .removeClass('first-slide');
  $(activeSlide)
    .last()
    .addClass('last-slide')
    .siblings()
    .removeClass('last-slide');

  $('.js-hero-thumbnail .hero__menu-item').on('click', function (event) {
    $heroSlider.slick('slickGoTo', $(this).data('slick-index'));
    $(this).addClass('current').siblings().removeClass('current');
    if ($(this).hasClass('first-slide')) {
      $('.js-hero-thumbnail').slick('slickPrev');
    } else if ($(this).hasClass('last-slide')) {
      $('.js-hero-thumbnail').slick('slickNext');
    }
  });

  var newsSettings = {
    infinite: false,
    speed: 500,
    autoplay: true,
    autoplaySpeed: 6000,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',

    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
          arrows: false,
        },
      },
    ],
  };
  $('.js-news-slider').slick(newsSettings);

  var teamSettings = {
    infinite: false,
    speed: 500,
    autoplay: true,
    autoplaySpeed: 6000,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',

    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: false,
          dots: false,
          arrows: false,
        },
      },
    ],
  };
  $('.js-team-slider').slick(teamSettings);

  var $columnSlider = $('.columns__column--image');
  $columnSlider.slick({
    infinite: false,
    speed: 500,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',
  });

  $('.footer-nav')
    .find('.footer-btn')
    .each(function () {
      $(this)
        .children('a')
        .append(
          `
            <svg class="icon icon-pointed-arrow-right">
                <use xlink:href="#icon-pointed-arrow-right"></use>
            </svg>
        `
        );
    });
  $('[data-fancybox]').fancybox({
    touch: false,
    btnTpl: {
      smallBtn:
        '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}">' +
        '<svg viewBox="0 0 34 34" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><circle fill="#212121" cx="17" cy="17" r="17"/><g stroke="#FFF" stroke-linecap="square" stroke-width="4"><path d="m9.5 9.5 15 15M24.5 9.5l-15 15"/></g></g></svg>' +
        '</button>',
    },
  });

  var $timeline = $('.js-timeline-slider');

  $timeline.on(
    'afterChange init',
    function (event, slick, currentSlide, nextSlide) {
      $timeline
        .find('.slick-current')
        .addClass('animate-slide')
        .next()
        .addClass('animate-slide');
    }
  );

  $timeline.slick({
    infinite: false,
    speed: 500,
    autoplay: false,
    autoplaySpeed: 6000,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    cssEase: 'cubic-bezier(0.215, 0.610, 0.355, 1.000)',
    prevArrow: $('.timeline__arrow--prev'),
    nextArrow: $('.timeline__arrow--next'),
  });

  var $progressBar = $('.timeline__progress');
  var $progressBarLabel = $('.timeline__progress-label');
  var calc = (1 / parseInt($timeline.find('.slick-slide').length)) * 100;
  $progressBar
    .css('background-size', calc + '% 100%')
    .attr('aria-valuenow', calc);

  $progressBarLabel.text(calc + '% completed');

  $timeline.on(
    'init beforeChange',
    function (event, slick, currentSlide, nextSlide) {
      var calc = ((nextSlide + 1) / slick.slideCount) * 100;

      $progressBar
        .css('background-size', calc + '% 100%')
        .attr('aria-valuenow', calc);

      $progressBarLabel.text(calc + '% completed');
    }
  );

  //video play on viewport
  function activateVideoOnViewport() {
    let windowScrollTop = $(window).scrollTop();
    let windowHeight = $(window).height();
    $('.video-frame-container').each(function (i) {
      let _this = $(this),
        videoFrame = _this.find('.vimeo-video-frame');
      if (!videoFrame) return;

      let videoOffsetTop = _this.offset().top,
        videoOffsetBottom = videoOffsetTop + _this.outerHeight();

      if (
        videoOffsetTop >= windowScrollTop &&
        videoOffsetBottom <= windowScrollTop + windowHeight
      ) {
        videoFrame[0].contentWindow.postMessage('{"method":"play"}', '*');
      }
    });
  }
  setTimeout(function () {
    activateVideoOnViewport();
  }, 1000);

  $(window).on('scroll resize', function () {
    activateVideoOnViewport();
  });
});

// Smooth scrolling when clicking an internal link
$('a[href*="#"]')
  .not('[href="#"]')
  .not('[href="#0"]')
  .not('a[data-fancybox]')
  .click(function (e) {
    var target = $(this.hash);
    if (target.length) {
      $('html, body').animate(
        {
          scrollTop: target.offset().top - 120,
        },
        1000
      );
      window.location.hash = this.hash;
    }
  });

$(window).on('load', function () {
  if (window.location.hash) {
    var target = $(window.location.hash);
    if (target.length) {
      $('html, body').animate(
        {
          scrollTop: target.offset().top - 120,
        },
        0
      );
    }
  }
});

//mega menu

document.addEventListener('DOMContentLoaded', function () {
  const currentUrl = window.location.href;
  const megaMenuItems = document.querySelectorAll('.megamenu__item');

  // Handle active class for each megamenu__item individually
  megaMenuItems.forEach(function (menuItem) {
    const menuLinks = menuItem.querySelectorAll(
      '.mega-menu__primary-link-item'
    );
    let isActive = false;

    menuLinks.forEach(function (link) {
      if (link.href === currentUrl) {
        link.closest('.mega-menu__primary-link').classList.add('active');
        isActive = true;
      }
    });
    if (!isActive) {
      const firstPrimaryLink = menuItem.querySelector(
        '.mega-menu__primary-link'
      );
      if (firstPrimaryLink) {
        firstPrimaryLink.classList.add('active');
      }
    }
    menuLinks.forEach(function (link) {
      const parentLink = link.closest('.mega-menu__primary-link');

      link.addEventListener('mouseenter', function () {
        menuItem
          .querySelectorAll('.mega-menu__primary-link.active')
          .forEach(function (activeLink) {
            activeLink.classList.remove('active');
          });
        parentLink.classList.add('active');
      });
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const megaMenuItems = document.querySelectorAll('.megamenu__item');

  megaMenuItems.forEach(function (menuItem) {
    const innerMenu = menuItem.querySelector('.megamenu__inner');
    const secondaryLists = menuItem.querySelectorAll(
      '.mega-menu__secondary-list'
    );

    let maxHeight = 0;

    secondaryLists.forEach(function (list) {
      maxHeight = Math.max(maxHeight, list.offsetHeight);
    });
    if (maxHeight > 0) {
      innerMenu.style.height = `${maxHeight + 100}px`;
    }
  });
});

//Mega Menu
var $navDropdownLink = $('.main-navigation .has-megamenu > a');
$navDropdownLink.each(function () {
  var $this = $(this),
    $parentLi = $this.parent('li'),
    $parentLiID = $parentLi.attr('id'),
    $megaMenu = $('.' + $parentLiID),
    activeClass = 'is-active';

  if (!$megaMenu.length) return; // Ensure $megaMenu exists

  // Hover actions for the main link
  $this.on('mouseenter', function (event) {
    event.preventDefault();
    $parentLi.addClass(activeClass);
    $megaMenu.addClass(activeClass);
    dynamicMegaMenuPosition($megaMenu, $parentLi);
  });

  // Hover actions for the mega menu
  $megaMenu
    .on('mouseenter', function (event) {
      event.preventDefault();
      $parentLi.addClass(activeClass);
      $megaMenu.addClass(activeClass);
    })
    .on('mouseleave', function (event) {
      event.preventDefault();
      $parentLi.removeClass(activeClass);
      $megaMenu.removeClass(activeClass);
    });

  // Mouse leave for parent li
  $parentLi.on('mouseleave', function (event) {
    event.preventDefault();
    $parentLi.removeClass(activeClass);
    $megaMenu.removeClass(activeClass);
  });

  // Click event to close the mega menu
  $('.megamenu a').on('click', function (e) {
    $parentLi.removeClass(activeClass);
    $megaMenu.removeClass(activeClass);
  });
});

function dynamicMegaMenuPosition($megaMenu, $parentLi) {
  if (!$megaMenu || !$megaMenu.length || !$megaMenu.is(':visible')) return; // Avoid errors

  if ($('.header').length > 0) {
    var container = $('.header .container'),
      containerWidth = container.innerWidth(),
      windowWidth = $(window).width(),
      containerOffsetLeft = container.offset().left;

    if ($megaMenu.hasClass('has-links')) {
      // Calculate the center alignment
      var parentLiWidth = $parentLi.outerWidth(),
        megaMenuWidth = $megaMenu.outerWidth(),
        parentLiOffset = $parentLi.offset().left,
        leftPosition = parentLiOffset + parentLiWidth / 2 - megaMenuWidth / 2;

      // Ensure the mega menu doesn't overflow the screen width
      if (leftPosition + megaMenuWidth > windowWidth) {
        leftPosition = windowWidth - megaMenuWidth - 16;
      }

      if (leftPosition < 0) {
        leftPosition = 16;
      }

      $megaMenu.css({ left: leftPosition, right: 'auto' });
    } else {
      // Default to right alignment
      var totalOffset = windowWidth - (containerWidth + containerOffsetLeft);
      if ($megaMenu.hasClass('has-image')) {
        totalOffset += 182;
      }
      $megaMenu.css('right', totalOffset);
    }
  }
}

// Handle dynamic positioning on resize and scroll
$(window).on('resize scroll', function () {
  var $activeMegaMenu = $('.megamenu__item.is-active'),
    $activeParentLi = $('.main-navigation .has-megamenu > li.is-active');

  if ($activeMegaMenu.length && $activeParentLi.length) {
    dynamicMegaMenuPosition($activeMegaMenu, $activeParentLi);
  }
});

// Close functionality for the mega menu
$('.mega-menu__close').on('click', function () {
  $('.main-navigation .has-megamenu > a, .megamenu__item').removeClass(
    'is-active'
  );
});

$(window).scroll(function () {
  doAnimateCss();
});

doAnimateCss();

function doAnimateCss() {
  $('[data-animate-css]').each(function () {
    if ($(this).is(':in-viewport')) {
      animateCss($(this));
    }
  });
}

function animateCss(elements) {
  elements.each(function () {
    $(this).css('animation-delay', $(this).attr('data-animate-css-delay'));
    $(this).addClass('animated ' + $(this).attr('data-animate-css'));
    $(this).css('visibility', 'visible');
  });
}

$(document).ready(function () {
  //Script added to wrap all elements of form in a single div for banner form on silvi page
  function heroFormWrapper() {
    if ($('.hero__popup-form .gfield').length) {
      var $fieldsToWrap = $('.hero__popup-form .gfield').not(
        '.popup-form-header'
      );
      $fieldsToWrap.wrapAll(
        '<div class="popup-form__body"><div class="popup-form__body-inner"></div></div>'
      );

      var $gformFooter = $('.hero__popup-form .gform_footer');
      $gformFooter.find('*').wrapAll('<div class="gform_footer__inner"></div>');
    }
  }
  heroFormWrapper();
  jQuery(document).on(
    'gform_page_loaded',
    function (event, form_id, current_page) {
      heroFormWrapper();
    }
  );

  //Script added for the project past gallery fancybox
  $('.grid-popup__item [data-fancybox]').fancybox({
    beforeLoad: function (instance, current) {
      $('.fancybox-inner').addClass('gallery-image-holder');
    },
    afterClose: function (instance, current) {
      $('.fancybox-inner').removeClass('gallery-image-holder');
    },
  });
});

// Select the wrapper and sections within it
const wrapper = document.querySelector('.has-section-scroll');
let sections = null;

if (wrapper !== null) {
  sections = wrapper.querySelectorAll('.has-section-scroll > section');

  let currentSectionIndex = 0;
  let isScrolling = false;
  let isInWrapper = true;

  function isFeatureEnabled() {
    return window.innerWidth >= 561;
  }

  function scrollToSection(index) {
    const targetSection = sections[index];
    const targetPosition = Math.max(0, targetSection.offsetTop - 30);

    window.scrollTo({
      top: targetPosition,
      behavior: 'smooth',
    });

    currentSectionIndex = index;
  }

  function handleWrapperScroll(event) {
    if (isScrolling || !isFeatureEnabled()) return;

    // Check if the footer is visible
    const footer = document.querySelector('.footer');
    if (footer) {
      const footerRect = footer.getBoundingClientRect();
      if (footerRect.top < window.innerHeight && footerRect.bottom > 0) {
        // Footer is visible, so skip snapping
        return;
      }
    }

    const direction = event.deltaY > 0 ? 1 : -1;
    const nextIndex = currentSectionIndex + direction;

    if (nextIndex >= 0 && nextIndex < sections.length) {
      isScrolling = true;
      scrollToSection(nextIndex);
      setTimeout(() => {
        isScrolling = false;
      }, 1500);
    } else {
      isInWrapper = false;
    }
  }

  function handleManualScroll() {
    if (isScrolling || !isFeatureEnabled()) return;

    // Check if the footer is visible
    const footer = document.querySelector('.footer');
    if (footer) {
      const footerRect = footer.getBoundingClientRect();
      if (footerRect.top < window.innerHeight && footerRect.bottom > 0) {
        // Footer is visible, so skip snapping
        return;
      }
    }

    const wrapperStart = wrapper.offsetTop;
    const wrapperEnd = wrapperStart + wrapper.offsetHeight;
    const scrollPosition = window.scrollY + window.innerHeight / 2;

    // Check if within the wrapper bounds
    if (scrollPosition >= wrapperStart && scrollPosition <= wrapperEnd) {
      isInWrapper = true;

      // Calculate the closest section
      const closestSectionIndex = Array.from(sections).reduce(
        (closestIndex, section, index) => {
          const sectionMid = section.offsetTop + section.offsetHeight / 2;
          const distanceToMid = Math.abs(scrollPosition - sectionMid);

          return distanceToMid <
            Math.abs(
              scrollPosition -
                (sections[closestIndex]?.offsetTop +
                  sections[closestIndex]?.offsetHeight / 2)
            )
            ? index
            : closestIndex;
        },
        currentSectionIndex
      );

      isScrolling = true;
      scrollToSection(closestSectionIndex);
      setTimeout(() => {
        isScrolling = false;
      }, 1500);
    }
  }

  // Attach events
  window.addEventListener(
    'wheel',
    (event) => {
      if (isFeatureEnabled()) {
        handleWrapperScroll(event);
      }
    },
    { passive: false }
  );

  let startY;
  window.addEventListener('touchstart', (e) => {
    if (!isFeatureEnabled()) return;
    startY = e.touches[0].clientY;
  });

  window.addEventListener('touchmove', (e) => {
    if (!isFeatureEnabled()) return;

    const wrapperEnd = wrapper.offsetTop + wrapper.offsetHeight;
    const windowScrollTop = window.scrollY + window.innerHeight;

    if (windowScrollTop <= wrapperEnd && isInWrapper) {
      e.preventDefault();
      if (isScrolling) return;

      const deltaY = startY - e.touches[0].clientY;
      if (Math.abs(deltaY) > 50) {
        handleWrapperScroll({ deltaY });
        startY = e.touches[0].clientY;
      }
    }
  });

  // Add scroll event for scrollbar dragging
  let debounceTimeout;
  window.addEventListener('scroll', () => {
    if (!isFeatureEnabled() || isScrolling) return;

    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(handleManualScroll, 200);
  });
}
