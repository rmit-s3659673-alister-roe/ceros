<?php
/**
 * Template parts
 *
 * @package 	Meridia
 * @since 		Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Preloader
 */
function meridia_preloader() {
	if( get_theme_mod( 'meridia_preloader_show', false ) ) : ?>
		<div class="loader-mask">
			<div class="loader">
				<div></div>
			</div>
		</div>
	<?php endif;
}


/**
 * Primary Navbar
 */
function meridia_primary_navbar() {
	?>
		<!-- Navbar -->
		<nav id="navbar-collapse" class="flex-child nav__wrap collapse navbar-collapse" itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" role="navigation">
			<?php
			if ( has_nav_menu('primary-menu') ) {
				wp_nav_menu( array(
					'theme_location'  => 'primary-menu',
					'fallback_cb'			=> '__return_false',
					'container'       => false,
					'menu_class'      => 'nav__menu',
					'walker'          => new Meridia_Walker_Nav_Primary()
				) );
			}
			?>

			<?php if ( get_theme_mod( 'meridia_nav_search_show', true ) ) : ?>
				<!-- Mobile Search -->
				<div class="nav__search-mobile d-lg-none">
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>

		</nav> <!-- end navbar -->
	<?php
}


/**
 * Mobile Menu Toggle
 */
function meridia_mobile_menu_toggle() {
	if ( has_nav_menu('primary-menu') ) : ?>
		<button type="button" class="nav__icon-toggle" id="nav__icon-toggle" data-toggle="collapse" data-target="#navbar-collapse">
			<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'meridia' ); ?></span>
			<span class="nav__icon-toggle-bar"></span>
			<span class="nav__icon-toggle-bar"></span>
			<span class="nav__icon-toggle-bar"></span>
		</button>
	<?php endif;
}


/**
 * Fullscreen Search
 */
function meridia_fullscreen_search() {
	if ( get_theme_mod( 'meridia_nav_search_show', true ) ) : ?>
		<!-- Fullscreen Search -->
		<div class="search-wrap">
			<?php get_search_form(); ?>
			<button type="button" role="presentation" class="search-close" id="search-close" aria-label="<?php echo esc_attr__( 'close search', 'meridia' ); ?>">
				<i class="ui-close"></i>
			</button>
		</div>
	<?php endif;
}

/**
 * Back to top
 */
function meridia_back_to_top() {
	if( get_theme_mod( 'meridia_back_to_top_show', true ) ) : ?>
		<!-- Back to top -->
		<div id="back-to-top">
			<a href="#top"><i class="ui-arrow-up"></i></a>
		</div>
	<?php endif; 
}

/**
 * Content markup top
 */
function meridia_content_markup_top() {
	?>
	<section class="section-wrap">
		<div class="container">
			<div class="row">
	<?php
}


/**
 * Content markup bottom
 */
function meridia_content_markup_bottom() {
	?>
			</div>
		</div>
	</section>
	<?php
}