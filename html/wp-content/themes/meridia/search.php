<?php
/**
 * The template for displaying search results pages.
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header(); ?>

<!-- Page Title -->
<div class="page-title text-center">
	<h1 class="page-title__title"><?php printf( esc_html__( 'Search Results for: %s', 'meridia' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
</div><!-- .page title -->

<section class="section-wrap pb-50 grid-layout">
	<div class="container">    
		<div class="row" id="masonry-grid">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
				<div class="col-lg-4 col-sm-6 col-xs-12">            
					<?php get_template_part( 'template-parts/posts/grid-post-small', get_post_format() ); ?>
				</div>
				
			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>        
		
		</div> <!-- .row -->

		<?php meridia_post_pagination(); ?>

	</div>
</section>

<!-- Instagram -->
<?php if ( is_active_sidebar( 'meridia-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'meridia-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
