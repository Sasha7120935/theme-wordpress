<?php

/**
 * Template part for displaying page content in page2.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Test_Theme
 */


get_header();
?>
    <!-- END TITLEBAR -->

    <!-- BEGIN TOP -->
    <section id="top">
        <div class="wrapper">
            <div id="top_slide" class="flexslider">
                <ul class="slides">
                    <?php
                    $id = get_the_ID();
                    $posts = get_field('home_1', $id);
                    if ( $posts ):
                        while ( the_repeater_field('slides', $id ) ):
                            ?>
                            <li>
                                <img src="<?php echo $sub_field_slider = get_sub_field('slider'); ?>"/>
                                <p class="flex-caption">
                                    <strong><?php echo $sub_field_slider_title = get_sub_field('slider_title'); ?></strong>
                                    <span><?php echo $sub_field_slider_text = get_sub_field('slider_text'); ?></span>
                                </p>
                            </li>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- END TOP -->

    <!-- BEGIN CONTENT -->
    <section id="content">
        <div class="wrapper page_text page_home">
            <?php
            $args = [
                'post_type' => 'post',
                'posts_per_page' => 1
            ];
            $blog_query = new WP_Query($args);
            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) : $blog_query->the_post();
                    ?>
                    <div class="introduction">
                        <h1><?php the_title() ?><p><?php the_content() ?></p></h1>
                        <a class="button button_big button_orange float_left" href="<?php the_permalink(); ?>"><span
                                    class="inside">Read more</span></a>
                    </div>
                <?php
                endwhile;
            endif;
                $args = [
                    'post_type' => 'post',
                    'posts_per_page' => 6
                ];
                $blog_query = new WP_Query($args);
                if ($blog_query->have_posts()) :
                    ?>
            <ul class="columns dropcap">
                <?php
                    while ( $blog_query->have_posts() ) : $blog_query->the_post();
                        ?>
                        <li class="column column33">
                            <div>
                                <div>
                                    <img class="img-icon" style="float: left" src="<?php echo get_field('icon'); ?>"/>
                                </div>
                                <div class="inside">
                                    <h1><?php echo get_field('icon_title'); ?></h1>
                                    <p><?php the_content() ?></p>
                                    <p class="read_more"><a href="<?php the_permalink(); ?>">Read more</a></p>
                                </div>
                            </div>
                        </li>
                    <?php
                    endwhile;
                endif;
                ?>
            </ul>
            <div class="underline"></div>
            <div class="portfolio">
            <?php
            $categories = get_categories();
                foreach ( $categories as $category ) {
                    ?>
                    <p class="all_projects"><a href="<?php get_category_link($category->name) ?>">View all projects</a></p>
                    <?php
                    break;
                }
                ?>
                <h1>Portfolio</h1>
                <div class="columns">
                    <?php
                    $args = [
                        'post_type' => 'portfolio',
                        'posts_per_page' => 4
                    ];
                    $portfolio_query = new WP_Query($args);
                    if ($portfolio_query->have_posts()) :
                        while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                            ?>
                            <div class="column column25">
                                <a href="<?php echo get_field('image_test_big', get_the_ID() ) ?>" class="image lightbox" data-rel="prettyPhoto[gallery]">
								<span class="inside">
                                    <img src="<?php echo get_field('image_test_small', get_the_ID() ) ?>" alt="" />
									<span class="caption"><?php echo get_the_content() ?></span>
								</span>
                                    <span class="image_shadow"></span>
                                </a>
                            </div>
                        <?php
                        endwhile;
                    else:
                        return '<p><strong>' . _e('not found', '') . '</strong></p>';
                    endif;
                    ?>
                    <?php
                    wp_reset_query();
                    ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTENT -->

    </div>
    </div>

    <div id="page_bottom">
<?php
get_sidebar('lower');
get_footer();