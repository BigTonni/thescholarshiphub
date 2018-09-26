/*
 * Frontend
 */

jQuery(document).ready(function ($) {
    $('.searchicon .fa').click(function () {
        $('header .search-form').toggle();
    });

    //owlCarousel
    $('.slide-one').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        navText: false,
        dots: false,
        navSpeed: 700,
        responsive: {
            0: {
                items: 1
            },
        }
    });
});