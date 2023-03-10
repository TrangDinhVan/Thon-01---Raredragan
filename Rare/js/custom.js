jQuery(function($){
    if ($('.insta-slider').length) {
        var t = $('.insta-slider');
        new Swiper(t, {
            loop: true,
            breakpoints: {
                200: {
                    slidesPerView: 1.3,
                    spaceBetween: 10
                },
                600: {
                    slidesPerView: 2.6,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 3.2,
                    spaceBetween: 10
                },
                1200: {
                    slidesPerView: 3.8,
                    spaceBetween: 20
                }
            },
            navigation: {
                nextEl: $('.next', t),
                prevEl: $('.prev', t),
            }
        });
    }
    if ($('.room_slider').length) {
        var t = $('.room_slider');
        new Swiper(t, {
            // loop: true,
            breakpoints: {
                200: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                600: {
                    slidesPerView: 1.1,
                    spaceBetween: 10
                },
                992: {
                    slidesPerView: 1.3,
                    spaceBetween: 20
                },
                1200: {
                    slidesPerView: 1.4,
                    spaceBetween: 30
                }
            },
            navigation: {
                nextEl: $('.next', t),
                prevEl: $('.prev', t),
            },
            pagination: {
                el: $(".room_slider_zpagination"),
                dynamicBullets: false
            },
            on: {
                snapIndexChange: function(){
                    let activeIndex = this.snapIndex + 1;
                    $('.indi-carousel .start').text('0' + activeIndex);
                }
            }
        });
    }
    if ($('.gallery').length) {
        $('.gallery').each(function (index, element) {
            var t = $(this);
            new Swiper(t, {
                loop: true,
                slidesPerView: 1,
                pagination: {
                    el: $(".swiper-pagination", t),
                    dynamicBullets: false
                }
            });
        });
    }
    if ($('.facilities').length) {
        var t = $('.facilities');
        new Swiper(t, {
            loop: true,
            // slideToClickedSlide: true,
            breakpoints: {
                200: {
                    slidesPerView: 1.2,
                    spaceBetween: 10
                },
                600: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 0,
                    centeredSlides: true
                },
                1200: {
                    centeredSlides: true,
                    slidesPerView: 3,
                    spaceBetween: 10
                }
            },
            navigation: {
                nextEl: $('.next', t),
                prevEl: $('.prev', t),
            }
        });
    }

    $('.elementor-swiper-button-next, .elementor-swiper-button-prev').html("<img width='20' src='"+zing.img+"/icon-next.svg'>");

    /* Expand Room Description in Detail Page */
    $(document).on('click', '.go-open-room-desc', function (e) {
        e.preventDefault();
        var t = $(this);
        t.closest('.read-more-wrap').toggle();
        t.closest('.need-readmore').toggleClass('active');
    });

    /* Readmore for the blocks need-readmore */
    $('.need-readmore').append('<div class="text-center read-more-wrap position-absolute w-100"><a href="#" class="go-open-room-desc text-underline" >Read More</a></div>');

});