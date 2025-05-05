<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stereoland_theme
 */

?>
					<!--continued from the header.php file -->
					</main><!-- #main -->
				</div><!-- .site-main__wrapper__inner -->
			</section><!-- #primary -->

			<!-- sidebar -->
			<?php get_template_part( 'template-parts/content', 'sidebar' ); ?>

			<!-- footer -->
				<footer id="colophon" class="site-footer">
					<div class="site-footer__inner">
						<div class="site-info">
						Copyright &copy; <?php echo date('Y'); ?> StereoLand Inc. All Rights Reserved.
						</div><!-- .site-info -->
					</div><!-- .site-footer__inner -->
				</footer><!-- #colophon -->
				<?php wp_footer(); ?>
			</div><!-- #page -->
	</body>
</html>
