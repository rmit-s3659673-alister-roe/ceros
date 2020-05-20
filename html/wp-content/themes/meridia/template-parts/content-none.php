<?php
/**
 * If no content
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<div class="col-lg-6 offset-lg-3">
	<article <?php post_class('entry'); ?>>

		<!-- Article -->
		<div class="entry__article text-center">
			<h3><?php esc_html_e( 'There is no content to display', 'meridia' ); ?></h3>
			<p class="mb-20"><?php esc_html_e('Don\'t fret! Let\'s get you back on track. Perhaps searching can help', 'meridia') ?></p>
			<?php get_search_form(); ?>
		</div> <!-- .entry-wrap -->
		
	</article><!-- #post-## -->
</div>