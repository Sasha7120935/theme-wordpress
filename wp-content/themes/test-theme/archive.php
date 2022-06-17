<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Test_Theme
 */

get_header();
?>

    <section id="content">
        <div class="wrapper page_text">
            <header class="page-header">
                <?php
                the_title();
                ?>
            </header>
            <?php
            $categories = get_categories();
            ?>
            <ul id="portfolio_categories" class="portfolio_categories">
                <?php
                foreach ( $categories as $category ) {
                    echo '<li class="active segment-0"><a class="all" href="' . '">' . $category->name . '</a></li>';
                }
                ?>
            </ul>
            <div class="portfolio_items_container">
                <ul class="portfolio_items columns">
                    <?php
                    $args = [
                        'post_type' => 'portfolio'
                    ];
                    $portfolio_query = new WP_Query($args);
                    if ( $portfolio_query->have_posts() ) :
                        while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
                            ?>
                            <li data-type="webdesign" data-id="id-1" class="column column33">
                                <a href="<?php echo get_field('image_test_big', get_the_ID()) ?>"
                                   class="portfolio_image lightbox" data-rel="prettyPhoto[gallery]">
                                    <div class="inside">
                                        <img src="<?php echo get_field('image_test_small', get_the_ID()) ?>"/>
                                        <div class="mask"></div>
                                    </div>
                                </a>
                                <h1><?php echo get_the_title() ?></h1>
                                <p><?php echo get_the_content() ?></p>
                                <a class="button button_small button_orange" href="<?php the_permalink(); ?>"><span
                                            class="inside">read more</span></a>
                            </li>
                        <?php
                        endwhile;
                    else:
                        return '<p><strong>' . _e('not found', '') . '</strong></p>';
                    endif;
                    ?>
                    <?php
                    wp_reset_query();
                    ?>
                </ul>
            </div>
        </div>
    </section>
<?php
get_sidebar('lower');
get_footer();
