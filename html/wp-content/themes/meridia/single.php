<?php

/**
 * The template for displaying all single posts.
 *
 * @package Meridia
 */
get_header();
?>

<!-- Blog Single -->
<section class="section-wrap blog__single">
	<div class="container">
		<div class="row <?php 
if ( 'fullwidth' == meridia_layout_type( 'blog' ) ) {
    echo  esc_attr( 'justify-content-center' ) ;
}
?>">

			<!-- Content -->
			<div id="primary" class="blog__content col-lg-9 <?php 

if ( 'left-sidebar' == meridia_layout_type( 'blog' ) && is_active_sidebar( 'meridia-blog-sidebar' ) ) {
    echo  esc_attr( 'sidebar-on blog__content--right' ) ;
} elseif ( 'right-sidebar' == meridia_layout_type( 'blog' ) && is_active_sidebar( 'meridia-blog-sidebar' ) ) {
    echo  esc_attr( 'sidebar-on blog__content--left' ) ;
}

?>">

				<?php 
while ( have_posts() ) {
    the_post();
    ?>

					<?php 
    get_template_part( 'template-parts/content-single', get_post_format() );
    ?>

				<?php 
}
?>
			</div> <!-- .post-content -->


			<?php 
// Sidebar
if ( 'fullwidth' !== meridia_layout_type( 'blog' ) && is_active_sidebar( 'meridia-blog-sidebar' ) ) {
    meridia_sidebar();
}
?>
			
		</div>
	</div>
</section>
	

<!-- Instagram -->
<?php 

if ( is_active_sidebar( 'meridia-footer-instagram' ) ) {
    ?>
	<?php 
    dynamic_sidebar( 'meridia-footer-instagram' );
}

?>

<?php 
get_footer();