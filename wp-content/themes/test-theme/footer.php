<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Test_Theme
 */

?>
		<!-- BEGIN FOOTER -->
		<footer id="footer">
			<div class="wrapper">
				<p class="copyrights">Copyright © <?php echo date('Y');?> by TheSame. All rights reserved</p>
				<a href="#page" class="up">
					<span class="arrow"></span>
					<span class="text">top</span>
				</a>
			</div>
		</footer>
		<!-- END FOOTER -->
	</div>
</div>
<?php wp_footer(); ?>

</body>
</html>
