<?php
/**
 * List layout
 *
 * @package 	Meridia
 * @since 		Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<!-- List Layout --> 
<?php if ( have_posts() ) : ?>
	<div class="list-content">  
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/posts/list-post' ); ?>
		<?php endwhile; ?>
	</div>

	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>