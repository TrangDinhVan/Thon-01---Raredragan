<?php
add_shortcode( 'instagram', 'zinstagram' );
function zinstagram(){
    $ps = get_posts(array(
        'post_type' => 'inavii_account',
        'post_status' => 'any',
        'showposts' => 2
    ));
    if( empty( $ps ) ) return  current_user_can( 'administrator' ) ? '<p class="text-center"><a class="text-underline" target="_blank" href="'.admin_url('?page=inavii-instagram-settings').'">Connect Account First Please!</a></p>' : '';
    $p = $ps[0];
    $as = get_field( 'inavii_social_feed_media', $p );
    $gs = array_slice( $as, 0, 12 );
    ob_start();
    if( !empty($gs) )   :
        shuffle($gs); ?>
        <div class="insta-slider overflow-hidden zslide">
            <div class="swiper-wrapper">
                <?php
                foreach ($gs as $g) {
                    $img_url = $g['mediaUrl']['small'];
                    $img_url_full = $g['mediaUrl']['full']; ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $g['permalink']; ?>" target="_blank" class="thumb d-flex">
                            <img class="w-100" src="<?php echo $img_url; ?>" alt="...">
                        </a>
                    </div>
                <?php
                } ?>
            </div>
            <div class="prev"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
            <div class="next"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
        </div>
    <?php
    endif;
    return ob_get_clean();
}

add_shortcode( 'rooms_slider', 'zroomslider' );
function zroomslider(){
    ob_start();
    $ps = get_posts(array(
        'post_type' => 'room',
        'showposts' => 60,
        'post_status' => 'publish'
    ));
    if( !empty($ps) ): ?>
        <div class="room_slider zslide overflow-hidden text-white position-relative">
            <div class="swiper-wrapper">
                <?php
                foreach ($ps as $p) {
                    $gs = get_field( 'gallery', $p );
                    $img_url = $gs[0]['sizes']['zmedium']; ?>
                    <div class="swiper-slide">
                        <div class="entry">
                            <div class="row g-0">
                                <div class="col-sm">
                                    <a href="<?php echo home_url('the-bedrooms'); ?>" class="thumb d-flex">
                                        <img class="w-100" src="<?php echo $img_url; ?>" alt="...">
                                    </a>
                                </div>
                                <div class="col-sm">
                                    <div class="flex-center p-6 content h-100 has-scroll">
                                        <div class="inner">
                                            <h2><a class="text-white" href="<?php echo home_url('the-bedrooms'); ?>"><?php echo $p->post_title; ?></a></h2>
                                            <hr class="my-3">
                                            <div class="flex-centerr d-none font-9x mb-3">
                                                <div class="item"><?php the_field( 'square', $p ); ?> sqm</div>
                                                <div class="sep mx-2"></div>
                                                <div class="item"><?php the_field( 'guest_number', $p ); ?> guest(s)</div>
                                                <div class="sep mx-2"></div>
                                                <div class="item"><?php the_field( 'view', $p ); ?></div>
                                            </div>
                                            <p class="desc mb-6 font-9x"><?php echo $p->post_content; ?></p>
                                            <a class=" d-none" href="<?php echo home_url('the-bedrooms'); ?>">Discover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
            <div class="prev"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
            <div class="next"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
        </div>
        <div class="d-flex justify-content-center align-items-end text-italic gap-1 my-4 indi-carousel text-white lh-10">
            <span class="start">01</span>
            <span class="between font-9x">/</span>
            <span class="end font-9x"><?php printf("%02d", count($ps)); ?></span>
        </div>
        <div class="room_slider_zpagination zpagination text-center"></div>
        <?php
    endif;
    return ob_get_clean();
}

add_shortcode( 'testimonials', 'ztestimonials' );
function ztestimonials(){
    ob_start(); ?>
    <div class="testimonials-group" id="testimonials">
        <div class="row g-2 g-sm-0">
            <div class="col-sm-5 col-md-4" v-cloak>
                <div class="flex-center has-scroll test-expand overflow-hidden position-relative">
                    <div v-if="!active" class="inner p-6">
                        <h3>Just a few happy customers</h3>
                    </div>
                    <Transition name="bounce">
                        <div class="detail text-justifyy px-8 px-sm-3 px-lg-8 py-3 text-white d-flex flex-column align-items-center justify-content-center gap-4" v-if="active">
                            <img width="100" height="100" class="rounded-circle" :src="s.sizes.thumbnail" alt="...">
                            <div class="d-flex d-sm-none align-items-center justify-content-center gap-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="desc font-9x pe-2">{{s.description}}</div>
                            <p class="name font-light">--- {{s.caption}}</p>
                            <div class="d-flex justify-content-center align-items-center d-sm-none gap-6">
                                <div @click="prev" class="prev"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
                                <div @click="next" class="next"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
            <div :class="'d-none d-sm-block col '+ first_clicked">
                <div class="testimonials zslide overflow-hidden">
                    <div class="swiper-wrapper">
                        <template v-for="n in collection">
                            <div class="swiper-slide">
                                <div class="entry p-2 p-sm-4 d-flex align-items-center" title="Click to view detail">
                                    <div class="inner">
                                        <img width="160" src="<?php echo IMG; ?>/five-stars.png" class="mb-3" alt="...">
                                        <h4>{{n.title}}</h4>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        jQuery(function($){
            $.ajax({
                type: "POST",
                url: zing.ajax_url,
                data: {
                    action: 'z_do_ajax',
                    _action: 'initTestimonials',
                },
                dataType: "json",
                success: function (res) {
                    var app = new Vue({
                        el: '#testimonials',
                        data: {
                            active: $(window).width() < 768,
                            show: false,
                            current_index: 0,
                            time: 0,
                            first_clicked: '',
                            collection: res.collection
                        },
                        mounted: function(){
                            var self = this;
                            var t = $('.testimonials');
                            new Swiper(t, {
                                loop: true,
                                slideToClickedSlide: true,
                                speed: 400,
                                autoplay: {
                                    delay: 9000,
                                },
                                breakpoints: {
                                    200: {
                                        slidesPerView: 1.3,
                                        direction: 'horizontal',
                                        spaceBetween: 10
                                    },
                                    768: {
                                        slidesPerView: 3,
                                        centeredSlides: true,
                                        spaceBetween: 0,
                                        direction: 'vertical'
                                    }
                                },
                                on: {
                                    click: function(){
                                        if( self.first_clicked == '' ){
                                            self.active = false;
                                            setTimeout(() => {
                                                self.current_index = this.realIndex;
                                                self.active = true;
                                                self.first_clicked = 'first_clicked';
                                            }, 400);
                                        }
                                    },
                                    realIndexChange: function(){
                                        if( self.current_index != this.realIndex && self.first_clicked != '' ){
                                            self.active = false;
                                            setTimeout(() => {
                                                self.current_index = this.realIndex;
                                                self.active = true;
                                                self.first_clicked = 'first_clicked';
                                            }, 400);
                                        }
                                    }
                                }
                            });
                            if( $(window).width() > 767 ){
                                setTimeout(() => {
                                    self.first_clicked = 'first_clicked';
                                }, 10000);
                            }
                        },
                        methods: {
                            next: function(){
                                this.current_index++;
                                if( this.current_index >= this.collection.length  ){
                                    this.current_index = 0;
                                }
                            },
                            prev: function(){
                                this.current_index--;
                                if( this.current_index < 0  ){
                                    this.current_index = this.collection.length - 1;
                                }
                            }
                        },
                        computed: {
                            s: function(){
                                return this.collection[this.current_index];
                            }
                        }
                    });
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode( 'rooms', 'zrooms' );
function zrooms(){
    ob_start();
    global $post;
    $ps = get_posts(array(
        'post_type' => 'room',
        'showposts' => 60,
        'post_status' => 'publish'
    ));
    if( !empty($ps) ): ?>
        <div class="rooms-list vstack gap-10">
            <?php
            $i = 0;
            foreach ($ps as $p) {
                $i++; ?>
                <div class="entry my-sm-6" id="room-<?php echo $p->ID; ?>">
                    <div class="container">
                        <div class="inner">
                            <div class="row align-items-center">
                                <div class="col-sm-6 <?php echo $i%2 == 0 ? 'reversed' : ''; ?>">
                                    <div class="gallery-wrap">
                                        <div class="gallery overflow-hidden">
                                            <div class="swiper-wrapper">
                                                <?php
                                                $gs = get_field( 'gallery', $p );
                                                if( !empty($gs) ):
                                                    foreach ($gs as $g) {
                                                        $img_full_url = $g['url'];
                                                        $img_url = $g['sizes']['zmedium']; ?>
                                                        <div class="swiper-slide">
                                                            <a data-elementor-open-lightbox="yes" data-elementor-lightbox-title="<?php echo $p->post_title; ?>" data-elementor-lightbox-description="<?php echo $g['caption']; ?>" data-elementor-lightbox-slideshow="g-<?php echo $p->ID; ?>" class="thumb d-flex" href="<?php echo $img_full_url; ?>">
                                                                <img src="<?php echo $img_url; ?>" alt="..." class="w-100">
                                                            </a>
                                                        </div>
                                                    <?php
                                                    }
                                                endif; ?>
                                            </div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="sub_container mx-auto p-3 <?php echo str_word_count( $p->post_content ) > 40 ? 'need-readmore' : ''; ?>" style="max-width: 520px;">
                                        <h2 class="name lh-13 mb-3"><?php echo $p->post_title; ?></h2>
                                        <div class=" font-9x con-readmore">
                                            <?php
                                            echo apply_filters( 'the_content', $p->post_content ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    <?php
    endif;
    return ob_get_clean();
}

add_shortcode( 'facilities_slider', 'zfacilitieslider' );
function zfacilitieslider(){
    ob_start();
    $as = get_field( 'facilities', 'option' );
    if( !empty($as) ): ?>
        <div class="px-lg-10 text-center text-white position-relative">
            <div class="facilities zslide overflow-hidden">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($as as $a) {
                        $img_url = $a['img']['sizes']['zmedium']; ?>
                        <div class="swiper-slide">
                            <div class="entry">
                                <a href="<?php echo home_url( 'explore-the-chapel' ); ?>" class="thumb d-flex">
                                    <img class="w-100" src="<?php echo $img_url; ?>" alt="...">
                                </a>
                                <div class="content p-2 font-9x">
                                    <p class="name font-11x mb-2"><?php echo $a['title']; ?></p>
                                    <p class="desc"><?php echo $a['content']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
                <div class="prev"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
                <div class="next"><img width="20" src="<?php echo IMG; ?>/icon-next.svg" alt="Prev"></div>
            </div>
        </div>
        <?php
    endif;
    return ob_get_clean();
}

add_shortcode( 'facilities', 'zfacilities' );
function zfacilities(){
    ob_start();
    $as = get_field( 'facilities', 'option' );
    if( !empty($as) ): ?>
        <div class="facilities-list vstack gap-10">
            <?php
            $i = 0;
            foreach ($as as $a) {
                $i++;
                $img_url = $a['img']['sizes']['zmedium'];
                $img_full_url = $a['img']['url']; ?>
                <div class="entry my-lg-4" id="item-<?php echo $a['ID']; ?>">
                    <div class="container">
                        <div class="inner">
                            <div class="row align-items-center">
                                <div class="col-sm-6 <?php echo $i%2 == 0 ? 'reversed' : ''; ?>">
                                    <a data-elementor-open-lightbox="yes" data-elementor-lightbox-title="<?php echo $a['title']; ?>" data-elementor-lightbox-description="<?php echo $a['caption']; ?>" data-elementor-lightbox-slideshow="facilities" href="<?php echo $img_full_url; ?>" class="thumb d-flex">
                                        <img src="<?php echo $img_full_url; ?>" alt="...">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="sub_container mx-auto p-3" style="max-width: 520px;">
                                        <h2 class="name lh-13 mb-3"><?php echo $a['title']; ?></h2>
                                        <div class="desc lh-16 mb-3">
                                            <?php
                                            echo $a['content']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    <?php
    endif;
    return ob_get_clean();
}

add_shortcode( 'pet', 'zpet' );
function zpet(){
    ob_start();
    $as = get_field( 'pet', 'option' );
    if( !empty($as) ): ?>
        <div class="pet-list text-center vstack gap-10">
            <?php
            $i = 0;
            foreach ($as as $a) {
                $i++;
                $img_url = $a['sizes']['zmedium'];
                $img_full_url = $a['url']; ?>
                <div class="entry my-lg-4" id="item-<?php echo $a['ID']; ?>">
                    <div class="container">
                        <div class="inner">
                            <div class="row align-items-center">
                                <div class="col-sm-6 col-md-7 <?php echo $i%2 == 0 ? 'reversed' : ''; ?>">
                                    <a data-elementor-open-lightbox="yes" data-elementor-lightbox-title="<?php echo $a['title']; ?>" data-elementor-lightbox-description="<?php echo $a['caption']; ?>" data-elementor-lightbox-slideshow="facilities" href="<?php echo $img_full_url; ?>" class="thumb d-flex">
                                        <img class="w-100" src="<?php echo $img_url; ?>" alt="...">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="sub_container mx-auto p-3" style="max-width: 420px;">
                                        <h2 class="name lh-13 mb-3"><?php echo $a['title']; ?></h2>
                                        <div class="desc lh-16 mb-3">
                                            <?php
                                            echo $a['description']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    <?php
    endif;
    return ob_get_clean();
} ?>