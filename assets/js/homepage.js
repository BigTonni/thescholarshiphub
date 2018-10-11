jQuery(document).ready(function ($) {
    //owlCarousel
    $('.slide-one').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        navText: false,
        dots: true,
        navSpeed: 700,
        responsive: {
            0: {
                items: 1
            },
        }
    });
});