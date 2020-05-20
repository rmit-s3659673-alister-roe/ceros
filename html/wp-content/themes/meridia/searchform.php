<?php
/**
 * Search form
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<form role="search" method="get" class="search-form relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-input" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'meridia' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-button" aria-label="<?php echo esc_attr__( 'search button', 'meridia' ); ?>"><i class="ui-search search-icon"></i></button>
</form>