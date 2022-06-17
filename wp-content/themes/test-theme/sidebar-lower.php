<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Test_Theme
 */
?>
<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Test_Theme
 */

if ( ! is_active_sidebar( 'sidebar-lower' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar( 'sidebar-lower' ); ?>
</aside><!-- #secondary -->
<!--<div id="page_bottom">-->
<!--    <!-- BEGIN ABOVE_FOOTER -->-->
<!--    <section id="above_footer">-->
<!--        <div class="wrapper above_footer_boxes page_text">-->
<!--            <div class="box first">-->
<!--                <h3>About Us</h3>-->
<!--                <p>Suspendisse in faucibus lorem, pretium quis, <a href="#">lacinia aliquet</a> enim sapien et lacus tellus quis consectetuer nisl.</p>-->
<!--                <p>Vestibulum tempus. Pellentesque sagittis, nunc eu odio. Suspendisse turpis at ipsum. Pellentesque placerat. Vivamus vulputate luctus.</p>-->
<!--            </div>-->
<!---->
<!--            <div class="box second">-->
<!--                <h3>Recent Posts</h3>-->
<!--                <ul class="recent_posts">-->
<!--                    <li class="item">-->
<!--                        <a class="thumbnail" href="#"><img alt="" src="./gfx/examples/above_footer_recent_posts1.jpg"></a>-->
<!--                        <div class="text">-->
<!--                            <h4 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></h4>-->
<!--                            <p class="data">-->
<!--                                <span class="date">21/10/2011</span>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="item">-->
<!--                        <a class="thumbnail" href="#"><img alt="" src="./gfx/examples/above_footer_recent_posts2.jpg"></a>-->
<!--                        <div class="text">-->
<!--                            <h4 class="title"><a href="#">Cras vitae est lacus vehicula enim ac turpis at tellus.</a></h4>-->
<!--                            <p class="data">-->
<!--                                <span class="date">21/10/2011</span>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="item">-->
<!--                        <a class="thumbnail" href="#"><img alt="" src="./gfx/examples/above_footer_recent_posts3.jpg"></a>-->
<!--                        <div class="text">-->
<!--                            <h4 class="title"><a href="#">Quisque quis nibh.</a></h4>-->
<!--                            <p class="data">-->
<!--                                <span class="date">21/10/2011</span>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!---->
<!--            <div class="box third">-->
<!--                <h3>Categories</h3>-->
<!--                <ul class="menu categories page_text">-->
<!--                    <li><a href="#">Webdesign (8)</a></li>-->
<!--                    <li>-->
<!--                        <a href="#">Branding (12)</a>-->
<!--                        <ul>-->
<!--                            <li><a href="#">Photography (45)</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a href="#">Photomanipulation (5)</a></li>-->
<!--                    <li><a href="#">3D (1)</a></li>-->
<!--                    <li><a href="#">Others (7)</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!---->
<!--            <div class="box fourth">-->
<!--                <h3>Contact Us</h3>-->
<!--                <ul class="list_contact page_text">-->
<!--                    <li class="phone">+41 987 654 321<br />(011) 123 32 23</li>-->
<!--                    <li class="email"><a href="#">contact@thesame.com</a></li>-->
<!--                    <li class="address">King Street 4/30<br />12-345 City</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--</div>-->
