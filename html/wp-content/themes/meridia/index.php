<?php
/**
 * The main template file.
 *
 * @package Meridia
 * @since   Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();

$meridia_sidebar_on  = isset( $_GET['meridia_sidebar'] ) ? $_GET['meridia_sidebar'] : 'on';
$meridia_post_layout = isset( $_GET['meridia_layout'] ) ? $_GET['meridia_layout'] : 'grid';

// Featured Area
get_template_part( 'template-parts/featured-area/featured-area' );

// Promo Boxes
get_template_part( 'template-parts/promo-boxes' );

?>

<!-- Blog -->
<section class="section-wrap section-blog content">	
	<div class="container">
		<div class="row">

			<?php meridia_primary_content_top(); ?>

			<!-- Content -->
			<div id="primary" class="blog__content <?php
				if ( MERIDIA_PRODUCTION ) {
					
					if ( 'grid' == get_theme_mod( 'meridia_post_layout_type', 'grid' ) ) {
						echo esc_attr('grid-layout ');
					} else {
						echo esc_attr('list-layout ');
					}

				} else {

					if ( $meridia_post_layout == 'grid' ) {
						echo esc_attr('grid-layout ');
					} else {
						echo esc_attr('list-layout ');
					}

				}

				if ( MERIDIA_PRODUCTION ) {
					switch( meridia_layout_type( 'blog' ) ) {
						
						case ( 'fullwidth' ) :
							echo esc_attr( 'col-lg-12' );
							break;

						case ( 'right-sidebar' && is_active_sidebar( 'meridia-blog-sidebar' ) ) :
							echo esc_attr( 'col-lg-9 sidebar-on blog__content--left' );
							break;

						case ( 'left-sidebar' && is_active_sidebar( 'meridia-blog-sidebar' ) ) :
							echo esc_attr( 'col-lg-9 sidebar-on blog__content--right' );
							break;

						default:
							echo esc_attr( 'col-lg-9 sidebar-on blog__content--left' );
					}

				}	else {

					if ( 'on' == $meridia_sidebar_on && is_active_sidebar( 'meridia-blog-sidebar' ) ) {
						echo esc_attr( 'col-lg-9 sidebar-on blog__content--left' );
					} else {
						echo esc_attr( 'col-lg-12' );
					}

				}

				?>">

				<!-- Grid/List Layout -->
				<?php
					if ( MERIDIA_PRODUCTION ) {

						switch( get_theme_mod( 'meridia_post_layout_type', 'grid' ) ) {

							case ( 'grid' ) :
								get_template_part( 'template-parts/posts/grid-layout' );
								break;

							case ( 'list' ):
								get_template_part( 'template-parts/posts/list-layout' );
								break;

							default:
								get_template_part( 'template-parts/posts/grid-layout' );
						}

					} else {

						switch( $meridia_post_layout ) {

							case ( 'grid' ) :
								set_theme_mod( 'meridia_post_layout_type', 'grid' );
								get_template_part( 'template-parts/posts/grid-layout' );
								break;

							case ( 'list' ):
								set_theme_mod( 'meridia_post_layout_type', 'list' );
								get_template_part( 'template-parts/posts/list-layout' );
								break;

							default:
								set_theme_mod( 'meridia_post_layout_type', 'grid' );
								get_template_part( 'template-parts/posts/grid-layout' );
						}
					}
				?>        

				<!-- Pagination -->
				<?php meridia_post_pagination(); ?>

			</div> <!-- .blog__content -->

			<?php meridia_primary_content_bottom(); ?>
			
			<?php
				// Sidebar
				if ( MERIDIA_PRODUCTION ) {
					if ( 'fullwidth' !== meridia_layout_type( 'blog' ) ) {
						meridia_sidebar();
					}
				} else {
					if ( 'on' == $meridia_sidebar_on ) {
						set_theme_mod( 'meridia_blog_layout_type', 'right-sidebar' );
						meridia_sidebar();
					}
				}
			?>

		</div>
	</div>
</section>

<!-- Instagram -->
<?php if ( is_active_sidebar( 'meridia-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'meridia-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>