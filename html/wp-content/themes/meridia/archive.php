<?php
/**
 * The template for displaying archive pages.
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();

$meridia_archive_title    	 = get_the_archive_title();
$meridia_archive_description = get_the_archive_description();
$meridia_archive_columns 		 = get_theme_mod( 'meridia_archives_columns', 'col-lg-4' );

?>

<?php if ( $meridia_archive_title || $meridia_archive_description ) : ?>
	<!-- Page Title -->
	<div class="page-title text-center">

		<?php if ( $meridia_archive_title ) : ?>
			<h1 class="page-title__title"><?php echo wp_kses_post( $meridia_archive_title ); ?></h1>
		<?php endif; ?>

		<?php if ( $meridia_archive_description ) : ?>
			<div class="page-title__description"><?php echo wp_kses_post( wpautop( $meridia_archive_description ) ); ?></div>
		<?php endif; ?>

	</div> <!-- .page title -->
<?php endif; ?>


<section class="section-wrap pb-50 grid-layout">
	<div class="container">
		<div class="row">

			<!-- Content -->
			<div class="blog__content <?php
				if ( 'left-sidebar' == meridia_layout_type( 'archives' ) && is_active_sidebar( 'meridia-blog-sidebar' ) ) {
					echo esc_attr( 'col-lg-9 sidebar-on blog__content--right' );
				} elseif ( 'right-sidebar' == meridia_layout_type( 'archives' ) && is_active_sidebar( 'meridia-blog-sidebar' ) ) {
					echo esc_attr( 'col-lg-9 sidebar-on blog__content--left' );
				} elseif ( 'fullwidth' == meridia_layout_type( 'archives' ) ) {
					echo esc_attr( 'col-lg-12' );
				}
			?>">

				<div class="row" id="masonry-grid">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div class="<?php echo esc_attr( $meridia_archive_columns ); ?> col-sm-6 col-xs-12">            
							<?php get_template_part( 'template-parts/posts/grid-post-small', get_post_format() ); ?>
						</div>

					<?php endwhile; ?>

					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>

				</div> <!-- .row -->

				<?php meridia_post_pagination(); ?>

			</div> <!-- .blog__content -->

			<?php
				// Sidebar
				if ( 'fullwidth' !== meridia_layout_type( 'archives' ) ) {
					meridia_sidebar();
				}
			?>

		</div> <!-- .row -->

	</div>
</section>

<!-- Instagram -->
<?php if ( is_active_sidebar( 'meridia-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'meridia-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer();  ?>