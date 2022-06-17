<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Test_Theme
 */

get_header();
?>
<!-- END TITLEBAR -->

<!-- BEGIN CONTENT -->
<section id="content">
    <div class="wrapper page_text">
        <div class="columnss">
            <div class="column column33">
                <h1><?php echo get_the_title() ?></h1>
                <p><?php echo get_the_content() ?></p>
                <h1><?php echo esc_html__( 'Client:', 'text_domain' ) ?></h1>
                <p><?php echo get_field('portfolio_client', get_the_ID()) ?></p>
                <h1><?php echo esc_html__( 'Model & Photographer:', 'text_domain' ) ?></h1>
                <p><a href="<?php echo get_field('portfolio_model', get_the_ID()) ?>">Jessica Parker</a> // Jo-Who Shan
                </p>
            </div>
            <div class="column column66">
                <div id="content_slide">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            $posts = get_field('portfolio_page', get_the_ID());
                            if ( $posts ) :
                                while ( the_repeater_field('portfolio_image_page', get_the_ID() ) ) :
                                    ?>
                                    <li>
                                        <a href="<?php echo get_sub_field('portfolio_image_big', get_the_ID()) ?>"
                                           class="lightbox" data-rel="prettyPhoto[gallery]">
                                            <img src="<?php echo get_sub_field('portfolio_image_small', get_the_ID()) ?>"
                                                 alt="1"/>
                                        </a>
                                    </li>
                                <?php
                                endwhile;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    wp_reset_query();
    ?>
</section>

<?php
get_footer();
?>
