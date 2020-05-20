<?php
/**
 * Lost post
 *
 * @package 	Meridia
 * @since 		Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-item post-list'); ?>>

	<!-- Post thumb -->
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-img post-list__entry-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail( 'meridia_medium' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-body">
		<!-- Entry Header -->
		<div class="entry-header post-list__entry-header">
			<!-- Category -->
			<?php if( get_theme_mod( 'meridia_meta_category_settings', true ) ) { meridia_meta_category(); } ?>

			<!-- Title -->
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</div>

		<!-- Content -->
		<div class="entry-wrap">
			<div class="entry">
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
				<?php if( get_theme_mod( 'meridia_meta_date_settings', true ) || get_theme_mod( 'meridia_meta_comments_settings', true ) ) : ?>
					<ul class="entry-meta">
						<?php if( get_theme_mod( 'meridia_meta_date_settings', true ) ) : ?>
							<li class="entry-date">
								<?php meridia_meta_date(); ?>
							</li>
						<?php endif; ?>
						<?php if( get_theme_mod( 'meridia_meta_comments_settings', true ) ) : ?>
							<li class="entry-comments">
								<?php meridia_meta_comments(); ?>
							</li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div> <!-- end entry content -->
	</div> <!-- end entry body -->
	
</article><!-- #post-## -->