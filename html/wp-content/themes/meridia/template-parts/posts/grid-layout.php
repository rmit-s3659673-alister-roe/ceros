<?php
/**
 * Grid layout
 *
 * @package 	Meridia
 * @since 		Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

global $meridia_sidebar_on;
$meridia_sidebar = '';

if ( MERIDIA_PRODUCTION ) {
	if ( 'fullwidth' !== meridia_layout_type( 'blog' ) ) {
		$meridia_sidebar = 'col-lg-6';
	} else {
		$meridia_sidebar = 'col-lg-4';
	}
} else {
	if ( $meridia_sidebar_on == 'on' ) {
		$meridia_sidebar = 'col-lg-6';
	} else {
		$meridia_sidebar = 'col-lg-4';
	}
}

?>

<!-- Grid Layout -->
<?php if ( have_posts() ) : ?>
	
	<div class="row" id="masonry-grid">

		<?php while ( have_posts() ) : the_post();

			// large post
			if( $wp_query->current_post == 0 ) : ?>
				<div class="large-post col-lg-12">
					<?php get_template_part( 'template-parts/posts/grid-post-large', get_post_format() ); ?>
				</div>

			<?php else : ?>
				<div class="<?php echo esc_attr( $meridia_sidebar ); ?> col-sm-6">
					<?php get_template_part( 'template-parts/posts/grid-post-small', get_post_format() ); ?>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>

	</div> <!-- .row -->

	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>