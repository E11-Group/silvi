document.addEventListener('DOMContentLoaded', function () {
  const fullpageContainer = document.querySelector('.has-section-scroll');
  if (fullpageContainer) {
    console.log('Initializing full page scroll');
    let count = 0;
    const header = document.querySelector('.js-header');
    const sections = document.querySelectorAll('.scroll-section');
    const anchors = Array.from(sections).map(
      (section) => section.getAttribute('data-id') ?? 'block-' + count++
    );

    let isScrolling = false;
    const isMobile = window.innerWidth <= 768;

    new fullpage('.has-section-scroll', {
      credits: false,
      licenseKey: 'SJND8-4EIV8-KZP5H-1QJ98-YLGJL',
      // normalScrollElements: '.footer',
      scrollingSpeed: 1000,
      sectionSelector: '.scroll-section', // Any "slide" will need to have this class
      anchors: anchors,
      css3: true,
      responsiveHeight: 330,
      scrollOverflow: false,
      scrollBar: !isMobile,
      onLeave: function (origin, destination, direction) {
        if (isScrolling) return false; // Ignore scroll events if already scrolling

        isScrolling = true;
        setTimeout(() => {
          isScrolling = false;
        }, 1500); // Ignore scroll events for a small time to avoid double-scroll

        // Add header--fixed class once we leave the top
        if (destination.index > 0) {
          header.classList.add('header--fixed');
        } else {
          header.classList.remove('header--fixed');
        }
      },
    });
  }
});
