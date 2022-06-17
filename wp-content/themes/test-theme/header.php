<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Test_Theme
 */

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- BEGIN PAGE -->
<div id="page">
    <div id="page_top">
        <div id="page_top_in">
            <!-- BEGIN TITLEBAR -->
            <header id="titlebar">
                <div class="wrapper">
                    <a id="logo" <?php  the_custom_logo() ?><span></span></a>
                    <div id="titlebar_right">
                        <ul id="social_icons">
                            <?php
                            $posts = get_field('social_networks', get_the_ID() );
                            if ( $posts ):
                                while (the_repeater_field('social', get_the_ID() ) ):
                                    ?>
                                    <li><a href="<?php echo get_sub_field('icon', get_the_ID() ) ?>"></a></li>
                                <?php
                                endwhile;
                            endif;
                            ?>
                        </ul>
                        <div class="clear"></div>

                                  <?php
                                    $args = array(
                                        'theme_location' => 'primary_menu',
                                        'container' => 'ul',
                                        'container_class' => 'nav-primary-menu',
                                        'menu_id' => 'top_menu'
                                    );

                                    wp_nav_menu($args);
                                    ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="breadcrumb">
                    <?php
                    if(function_exists('bcn_display'))
                    {
                        bcn_display();
                    }
                    ?>
                </div>
            </header>


