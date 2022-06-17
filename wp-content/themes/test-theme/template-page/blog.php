<?php
/**
 * Template name: Blog
 */
get_header();
?>
    <!-- END TITLEBAR -->

    <!-- BEGIN CONTENT -->
    <section id="content">
        <div class="wrapper page_text">
            <div class="columns">
                <div class="column column75">
                    <?php
                    $posts = get_posts();
                    $args = [
                        'post_type' => 'post',
                        'posts_per_page' => 2
                    ];
                    $blog_query = new WP_Query($args);
                    ?>
                    <?php
                    if ( $blog_query->have_posts() ) :
                        while ( $blog_query->have_posts() ) : $blog_query->the_post();
                            ?>
                            <article class="article">
                                <div class="article_image nomargin">
                                    <div class="inside">
                                        <div><?php echo get_the_post_thumbnail(); ?></div>
                                    </div>
                                </div>
                                <div class="article_details">
                                    <ul class="article_author_date">
                                        <li><em>Add:</em><?php echo get_the_date(); ?></li>
                                        <li><em>Author: </em> <a
                                                    href="<?php the_permalink(); ?>"><?php echo get_the_author(); ?></a>
                                        </li>
                                    </ul>
                                    <p class="article_comments"><em>Comment:</em><?php echo get_comments(); ?></p>
                                </div>

                                <h1><?php echo get_the_title(); ?></h1>
                                <p><?php echo get_the_content() ?></p>
                                <a class="button button_small button_orange float_left"
                                   href="<?php the_permalink(); ?>"><span class="inside">Read more</span></a>
                            </article>
                        <?php
                        endwhile;
                    else:
                        return '<p><strong>' . _e('not found', 'test-theme') . '</strong></p>';
                    endif;
                    ?>
                    <?php
                    wp_reset_query();
                    ?>
                </div>
                <div class="column column25">
                    <div class="padd16bot">
                        <form class="searchbar">
                            <fieldset>
                                <div>
                                    <span class="input_text"><?php get_sidebar('right'); ?></span>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTENT -->
    </div>
    </div>
<?php
get_footer();
?>