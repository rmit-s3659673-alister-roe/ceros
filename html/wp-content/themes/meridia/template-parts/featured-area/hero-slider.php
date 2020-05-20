<?php
/**
 * Hero slider
 *
 * @package 	Meridia
 * @since 		Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<!-- Hero -->
<section class="hero-slider pt-50">
	<div class="container">
		<div class="owl-single owl-carousel owl-theme">

			<?php
				$meridia_posts_per_page = ( get_theme_mod( 'meridia_hero_slider_posts_settings', '3' ) );
				$meridia_string_ID = ( get_theme_mod( 'meridia_featured_slider_posts_id_settings', '' ) );
				$meridia_post_ID = ( ! empty( $meridia_string_ID ) ) ? array_map( 'intval', explode(',', $meridia_string_ID )) : '';
				$meridia_categories = meridia_categories_dropdown();
				$meridia_post_category = ( get_theme_mod( 'meridia_featured_slider_categories_settings', $meridia_categories[0] ) );				

				$meridia_args = array(
					'post_type'      => 'post',
					'post__in'       => $meridia_post_ID,
					'ignore_sticky_posts' => true,
					'posts_per_page' => $meridia_posts_per_page,
					'cat'            => $meridia_post_category,
					'orderby'        => 'post__in',
				);

				$meridia_featured_query = new WP_Query( $meridia_args );

				if ( $meridia_featured_query->have_posts() ) :

					while ( $meridia_featured_query->have_posts() ) : $meridia_featured_query->the_post(); ?>

						<?php
							$meridia_featured_image = ( has_post_thumbnail() ) ? sprintf( 'background-image: url( %s )', get_the_post_thumbnail_url() ) : '';
						?>

						<article>
							
							<figure class="hero-bg-img bg-overlay" style="<?php echo esc_attr( $meridia_featured_image ); ?>">
								<?php the_post_thumbnail( 'full', array( 'class'=>'d-none' ) ); ?>
							</figure>

							<div class="hero-holder">
								<!-- Category -->
								<?php if ( get_theme_mod( 'meridia_meta_category_settings', true ) ) { meridia_meta_category(); } ?>
								<!-- Title -->
								<?php the_title( sprintf( '<h3 class="hero-heading white uppercase"><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							
								<a href="<?php the_permalink(); ?>" class="btn btn-md btn-white"><?php esc_html_e( 'Read More', 'meridia' ) ?></a>
							</div>
						</article>

					<?php
					endwhile;

					wp_reset_postdata();

				endif;
			?>

		</div> <!-- end owl -->
	</div>
</section> <!-- end latest stories -->