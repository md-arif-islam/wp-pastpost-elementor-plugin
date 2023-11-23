(function ($) {
    $(document).ready(function () {
<<<<<<< HEAD
        $(".featured__hslider").owlCarousel({
            loop: true,
            margin: 50,
            loop: true,
=======

        $(document).ready(function () {
            $(".featured__hslider").owlCarousel({
                loop: true,
                margin: 50,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa-solid fa-arrow-left-long'></i>",
                    "<i class='fa-solid fa-arrow-right-long'></i>",
                ],
                center: true,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                },
            });
        });

        $('.post__slider').owlCarousel({
            loop: true,
            margin: 20,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            dots: false,
            nav: true,
            navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"],
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2,
                },
                1400: {
                    items: 3,
                },
            }
        });

        $('.blog__slider').owlCarousel({
            margin: 20,
            loop: false,
>>>>>>> 9a2101edf2e7d9060c7cfc61a9ff9a0f50bfa837
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            dots: false,
            nav: true,
            navText: [
                "<i class='fa-solid fa-arrow-left-long'></i>",
                "<i class='fa-solid fa-arrow-right-long'></i>",
            ],
            center: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1,
                },
            },
        });

        $('.featured__slider').owlCarousel({
            loop: true,
            margin: 50,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            dots: false,
            nav: true,
            navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"],
            center: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
            }
        });
    });

<<<<<<< HEAD
=======

>>>>>>> 9a2101edf2e7d9060c7cfc61a9ff9a0f50bfa837
})(jQuery);