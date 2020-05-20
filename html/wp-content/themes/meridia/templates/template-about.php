<?php
/*
Template Name: About
*/

/**
 * Page About
 *
 * @package Meridia
 * @since   Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();
?>


<!-- About -->
<section class="section-wrap about-me pt-40 pb-60">
	<div class="container-holder">
		<div class="container">

			<!-- Title -->
			<div class="text-center">
				<h1 class="heading-underline uppercase"><?php the_title(); ?></h1>
			</div>

			<div class="row row-35">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="col-sm-6" >
					<!-- Image -->
					<?php if( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?>
				</div> <!-- end col -->

				<div class="col-sm-6" >
					<article class="entry__article clearfix">
						<?php the_content(); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
					</article>
				</div> <!-- .col -->

				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- Instagram -->
<?php if ( is_active_sidebar( 'meridia-footer-instagram' ) ) : ?>
	<?php dynamic_sidebar( 'meridia-footer-instagram' ); ?>
<?php endif; ?>

<?php get_footer(); ?>