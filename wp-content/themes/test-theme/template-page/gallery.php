<?php
/**
 * Template name: Gallery
 */
get_header();
?>
    <section id="content">
        <h1 class="page_title"><?php echo get_the_title(); ?></h1>
        <div class="wrapper page_text">
            <div class="page_gallery">
                <div class="columns">
                    <div class="column column50">
                        <?php
                        $posts = get_field('gallery', get_the_ID());
                        if ( $posts ) :
                            while ( the_repeater_field ('gallery_image_setting', get_the_ID() ) ) :
                                ?>
                                <div class="column column50">
                                    <div class="image">
                                        <img src="<?php echo get_sub_field('gallery__image_small', get_the_ID()) ?>"
                                             alt=""/>
                                        <p class="caption">
                                            <strong><?php echo get_sub_field('gallery__image_title', get_the_ID()) ?></strong>
                                            <span><?php echo get_sub_field('gallery__image_text', get_the_ID()) ?></span>
                                            <a href="<?php echo get_sub_field('gallery__image_big', get_the_ID()) ?>"
                                               data-rel="prettyPhoto[gallery]"
                                               class="button button_small button_orange float_right lightbox"><span
                                                        class="inside">zoom</span></a>
                                        </p>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <ul class="pagenav">
                <?php
//                $current_page = !empty($_GET['home']) ? $_GET['home'] : 1;
                $query = new WP_Query(array(
                    'posts_per_page' => 1,
//                    'paged' => $current_page,
                ));
                ?>
                <li class="arrow arrow_left"><a href="<?php echo paginate_links(array(
                        'base' => site_url() . '%_%',
                        'format' => '?home=%#%',
                        'total' => $query->max_num_pages
                    )); ?>"<span></span></a></li>
                <?php
                wp_reset_postdata();
                ?>

            </ul>
        </div>
    </section>
    <!-- END CONTENT -->

<?php
get_footer();
?>