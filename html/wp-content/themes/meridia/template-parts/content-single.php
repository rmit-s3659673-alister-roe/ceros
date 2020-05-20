<?php
/**
 * Single post
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry single-post__entry' ); ?>>

	<!-- Entry Header -->
	<div class="entry-header">
		<!-- Category -->
		<?php if( get_theme_mod( 'meridia_meta_category_settings', true ) ) { meridia_meta_category(); } ?>

		<!-- Title -->
		<h1 class="entry-title single-post__entry-title"><?php the_title(); ?></h1>

		<?php if( get_theme_mod( 'meridia_meta_date_settings', true ) || get_theme_mod( 'meridia_meta_comments_settings', true ) ) : ?>
			<!-- Meta -->
			<ul class="entry-meta">
				<li class="entry-date">
					<?php if( get_theme_mod( 'meridia_meta_date_settings', true ) ) { meridia_meta_date(); } ?>
				</li>                 
				<li class="entry-comments">
					<?php if( get_theme_mod( 'meridia_meta_comments_settings', true ) ) { meridia_meta_comments(); } ?>
				</li>             
			</ul>
		<?php endif; ?>

	</div>


	<?php
		// Post thumb
		if ( has_post_thumbnail() ) {
			$post_format = get_post_format( $post->ID );   

			switch ( $post_format ) {
				case 'gallery':
				case 'video':
				case 'audio':
					break;

				default: ?>
					<figure class="entry-img single-post__entry-img-holder">
						<?php the_post_thumbnail( 'meridia_large' ); ?>
					</figure>
				<?php
			}
		}
	?>

	<?php meridia_entry_content_top(); ?>

	<!-- Article -->
	<div class="entry__article clearfix">

		<?php the_content(); ?>

		<?php
			// Post Multi Page Pagination
			$defaults = array(
				'before'           => '<div class="entry-pages">' . esc_html__( 'Pages:', 'meridia' ),
				'after'            => '</div>',
				'link_before'      => '',
				'link_after'       => '',
				'next_or_number'   => 'number',
				'separator'        => ' ',
				'nextpagelink'     => esc_html__( 'Next page', 'meridia' ),
				'previouspagelink' => esc_html__( 'Previous page', 'meridia' ),
				'pagelink'         => '%',
				'echo'             => 1
				);

			wp_link_pages( $defaults );
		?>

	</div><!-- .entry-article -->

	<?php meridia_entry_content_bottom(); ?>
	
	<?php if( get_theme_mod( 'meridia_post_tags_settings', true ) || get_theme_mod( 'meridia_post_share_icons_settings', true ) ) : ?>
		<!-- Tags / Share -->
		<div class="row entry__share-tags">
			<?php if( get_theme_mod( 'meridia_post_tags_settings', true ) ) : ?>
				<div class="col-md-6">
					<div class="entry-tags tags">
						<?php the_tags( '', '', '' ); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if( get_theme_mod( 'meridia_post_share_icons_settings', true ) && function_exists('meridia_social_sharing_buttons') ) : ?>
				<div class="col-md-6">
					<div class="entry-share">
						<?php meridia_social_sharing_buttons(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div> <!-- end tags / share -->
	<?php endif; ?>

</article><!-- #post-## -->


<?php if ( get_theme_mod( 'meridia_author_box_show', true ) ) {
	meridia_author_box();
} ?>


<!-- Prev / Next Posts -->
<?php meridia_post_nav(); ?>

<?php if ( get_theme_mod( 'meridia_related_posts_settings', true ) ) {
	// Related Posts
	meridia_related_posts(); }
?>

<?php
	// Comments
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
?>

