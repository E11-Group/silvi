$(function () {

    $('.js-header').e11_MobileNav();

});

(function ($, window, document, undefined) {

    var name = 'MobileNav';

    function MobileNav(element, index, options) {
        this.$el = $(element);
        this.options = $.extend({}, $.e11.fn[name].defaults, options);
        this.init();
    }

    MobileNav.prototype = {

        name: name,

        init: function () {

            var self = this;

            this.$toggle = this.$el.find('.js-nav-toggle');
            this.activeClass = 'nav__visible';

            this.$toggle.on('click', function (e) {
                e.preventDefault();

                self.$el.toggleClass(self.activeClass);
                var findClass = self.$el.hasClass(self.activeClass),
                    getPositionTop = $('.header-primary').innerHeight()

                if (findClass) {
                    $('.mobileNav__toggle svg').attr('class', 'icon icon-close-alt')
                    $('.mobileNav__toggle svg use').attr('xlink:href', '#icon-close-alt')
                    $('.mobileNav__text').text('Close')
                    $('.mobile-nav').css('top', getPositionTop)
                } else {
                    $('.mobileNav__toggle svg').attr('class', 'icon icon-menu-bar')
                    $('.mobileNav__toggle svg use').attr('xlink:href', '#icon-menu-bar')
                    $('.mobileNav__text').text('Menu')
                    $('.mobile-nav').css('top', 0)
                }
            });
        }
    };

    $.e11.fn.pluginGenerator(MobileNav);

})
(jQuery, window, document);