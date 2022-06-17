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
            <?php  echo  do_shortcode('[am_post_grid posts_per_page="6"]'); ?>
        </div>
    </section>
<?php
get_footer();
