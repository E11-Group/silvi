document.addEventListener('DOMContentLoaded', function () {
  const fullpageContainer = document.querySelector('.has-section-scroll');
  if (fullpageContainer) {
    const header = document.querySelector('.js-header');

    new fullpage('.has-section-scroll', {
      credits: false,
      licenseKey: 'SJND8-4EIV8-KZP5H-1QJ98-YLGJL',
      normalScrollElements: '.footer',
      sectionSelector: '.scroll-section', // Any "slide" will need to have this class
      onLeave: function (origin, destination, direction) {
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
