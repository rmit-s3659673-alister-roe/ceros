<?php
/**
 * The template for displaying the footer.
 *
 * @package Meridia
 */
?>

	<?php
		$footer_bottom_text = get_theme_mod( 'meridia_footer_bottom_text', esc_html__( 'All Rights Reserved', 'meridia'	) );
	?>

	<?php meridia_footer_before(); ?>

	<!-- Footer -->
	<footer class="footer" itemscope itemtype="http://schema.org/WPFooter">
		<div class="container">
			<?php if ( is_active_sidebar( 'meridia-footer-col-1' ) || is_active_sidebar( 'meridia-footer-col-2' ) || is_active_sidebar( 'meridia-footer-col-3' ) || is_active_sidebar( 'meridia-footer-col-4' ) ) : ?>
				<div class="footer__widgets">
					<div class="row">
						<!-- 4 Columns -->           
						<?php if ( get_theme_mod( 'meridia_footer_col_settings', 'four-col' ) == 'four-col' ) : ?>                

							<?php if ( is_active_sidebar( 'meridia-footer-col-1' ) ) : ?>
								<div class="col-lg-3 col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-1' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'meridia-footer-col-2' ) ) : ?>
								<div class="col-lg-3 col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-2' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'meridia-footer-col-3' ) ) : ?>
								<div class="col-lg-3 col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-3' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'meridia-footer-col-4' ) ) : ?>
								<div class="col-lg-3 col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-4' ); ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>
						
						<!-- 3 Columns -->
						<?php if ( get_theme_mod( 'meridia_footer_col_settings', 'four-col' ) == 'three-col' ) : ?>                

							<?php if ( is_active_sidebar( 'meridia-footer-col-1' ) ) : ?>
								<div class="col-lg-4 col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-1' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'meridia-footer-col-2' ) ) : ?>
								<div class="col-lg-4 col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-2' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'meridia-footer-col-3' ) ) : ?>
								<div class="col-lg-4 col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-3' ); ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>

						<!-- 2 Columns -->
						<?php if ( get_theme_mod( 'meridia_footer_col_settings', 'four-col' ) == 'two-col' ) : ?>                

							<?php if ( is_active_sidebar( 'meridia-footer-col-1' ) ) : ?>
								<div class="col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-1' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'meridia-footer-col-2' ) ) : ?>
								<div class="col-md-6">
									<?php dynamic_sidebar( 'meridia-footer-col-2' ); ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>

						<!-- 1 Column -->
						<?php if ( get_theme_mod( 'meridia_footer_col_settings', 'four-col' ) == 'one-col' ) : ?>                

							<?php if ( is_active_sidebar( 'meridia-footer-col-1' ) ) : ?>
								<div class="col-md-12">
									<?php dynamic_sidebar( 'meridia-footer-col-1' ); ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>
					</div>
				</div> <!-- end footer widgets -->
			<?php endif; ?>
			
			<!-- Socials -->
			<?php if ( get_theme_mod( 'meridia_footer_socials_show_settings', true ) && function_exists( 'meridia_render_social_icons' ) ) : ?>
				<div class="footer__socials">
					<?php meridia_render_social_icons( 'text', true ); ?>
				</div>
			<?php endif; ?>

		</div> <!-- end container -->

		<div class="footer-bottom text-center">
			<div class="container">

				<?php if ( $footer_bottom_text ) : ?>

					<span class="copyright">
						<?php if ( get_theme_mod( 'meridia_footer_bottom_year_show', true ) ) : ?>
							&copy; <?php echo date_i18n( __( 'Y' , 'meridia' ) ) . ' '; ?>
						<?php endif; ?>
						<?php
							echo wp_kses_post( $footer_bottom_text );
						?>
					</span>

				<?php endif; ?>
			</div>
		</div> <!-- end footer bottom -->
	</footer>

	<?php meridia_back_to_top(); ?>
	
	<?php meridia_footer_after(); ?>

</main> <!-- .main-wrapper -->

<?php meridia_body_bottom(); ?>

<?php wp_footer(); ?>
</body>
</html>