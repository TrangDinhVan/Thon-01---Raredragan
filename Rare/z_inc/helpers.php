<?php
function thon_project_portfolio( $cf ){
    ob_start();
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'showposts' => -1,
        'cat' => (int)$cf['id']
    );
    $ps = get_posts( $args );
    if( !empty($ps) ): ?>
        <div class="container">
            <div class="row gy-6 grid-of-portfolio text-uppercase font-medium text-white grid-of-cat-<?php echo $cf['id']; ?>">
                <?php
                foreach ($ps as $p) {
                    $img_url = get_the_post_thumbnail_url( $p, 'full' ); ?>
                    <div class="col-sm-6 <?php echo $cf['id'] == 8 ? 'col-lg-4' : 'col-lg-3'; ?>">
                        <article class="entry position-relative cursor-pointer">
                            <div class="thumb d-flex">
                                <img src="<?php echo $img_url; ?>" alt="...">
                            </div>
                            <h2><a data-elementor-open-lightbox="yes" data-elementor-lightbox-title="<?php echo $p->post_title ; ?>" data-elementor-lightbox-slideshow="g-portfolio" class="flex-center" href="<?php echo $img_url; ?>"><?php echo $p->post_title; ?></a></h2>
                        </article>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    <?php
    endif;
    return ob_get_clean();
}
add_shortcode('project_portfolio', 'thon_project_portfolio'); ?>
