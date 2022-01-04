//== ## SLIDER BANNER HEADER TOP ## ==//
$(function() {
    carousel('.banner_main_item_top .owl-carousel');

    function carousel(carouselName) {
        let carousel = $(carouselName)
        $(carousel).owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })
    }
});


//== ## SLIDER PRODUCT ## ==//
$(function() {
    carousel('.flash_sale_products_slider .owl-carousel');

    function carousel(carouselName) {
        let carousel = $(carouselName)
        $(carousel).owlCarousel({
            loop: false,
            margin: 5,
            nav: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                768: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        })
    }
});

//== ## RECOMMENT LIST ## ==//
$(function() {
    carousel('.recomment_list .owl-carousel');

    function carousel(carouselName) {
        let carousel = $(carouselName)
        $(carousel).owlCarousel({
            loop: false,
            margin: 20,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                },
                1200: {
                    items: 6
                }
            }
        })
    }
});


//== ## VIDEO LIST ## ==//
$(function() {
    carousel('.newsVideo .owl-carousel');

    function carousel(carouselName) {
        let carousel = $(carouselName)
        $(carousel).owlCarousel({
            loop: false,
            margin: 20,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                },
                1200: {
                    items: 2
                }
            }
        })
    }
});
//== ## PRODUCT CHARACTERISTICS LIST ## ==//
$(function() {
    carousel('.characteristics_body .owl-carousel');

    function carousel(carouselName) {
        let carousel = $(carouselName)
        $(carousel).owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })
    }
});

//== ## SLIDE BANNER CATEGORY LIST ## ==//
$(function() {
    carousel('.cate_slideshow_wrap .owl-carousel');

    function carousel(carouselName) {
        let carousel = $(carouselName)
        $(carousel).owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })
    }
});
// recomment category product
$(function() {
    $('.recomment_list').flickity({
        cellAlign: 'left',
        contain: true,
        lazyLoad: 6,
    });
});
// banner slider home
$(function() {
    $('.banner_main_item_top').flickity({
        cellAlign: 'left',
        contain: true,
        lazyLoad: 1,
    });
});
// banner slider cateProd
$(function() {
    $('.cate_slideshow_wrap').flickity({
        cellAlign: 'left',
        contain: true,
        lazyLoad: 1,
    });
});
// product slider
$(function() {
    $('.flash_sale_products_slider').flickity({
        cellAlign: 'left',
        contain: true,
        lazyLoad: 5,
    });
});
// detail product slider
$(function() {
    $('.view_detail_product .view_images .carousel_slider').flickity({
        cellAlign: 'left',
        contain: true,
        lazyLoad: 1,
    });
});

// characteristics product slider
$(function() {
    $('.characteristics_body').flickity({
        cellAlign: 'left',
        contain: true,
        lazyLoad: 1,
    });
});

// news video category blog
$(function() {
    $('.newsVideo_slide_wrap_slider').flickity({
        cellAlign: 'left',
        contain: true,
        lazyLoad: 1,
    });
});