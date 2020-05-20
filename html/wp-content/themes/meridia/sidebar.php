<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( ! is_active_sidebar( 'meridia-blog-sidebar' ) ) {
	return;
}
?>

<div itemtype="http://schema.org/WPSideBar" itemscope="itemscope" id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'meridia-blog-sidebar' ); ?>
</div><!-- #secondary -->
