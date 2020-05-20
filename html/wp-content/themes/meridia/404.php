<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header(); ?>

<!-- Page Title -->
<div class="container">
	<div class="page-title text-center">
		<h1><?php esc_html_e('404 Page not found', 'meridia') ?></h1>
	</div>
</div> <!-- .page title -->

<section class="section-wrap section-blog pt-0">
	<div class="container">
		<div class="row justify-content-center">
				
			<div class="col-lg-6">

				<div class="entry__article text-center">
					<p class="mb-20"><?php esc_html_e( 'Don\'t fret! Let\'s get you back on track. Perhaps searching can help', 'meridia' ); ?></p>
					<?php get_search_form(); ?>
				</div>

			</div><!-- .col -->
			
		</div>
	</div>
</section>

<!-- Instagram -->
<?php if ( is_active_sidebar( 'meridia-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'meridia-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
