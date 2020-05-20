<?php

/**
 * Featured area
 *
 * @package 	Meridia
 * @since 		Meridia 1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
$meridia_featured = ( isset( $_GET['meridia_hero'] ) ? $_GET['meridia_hero'] : 'hero-slider' );
$meridia_featured_setting = get_theme_mod( 'meridia_featured_select_settings', 'hero-slider' );
$meridia_featured_show_setting = get_theme_mod( 'meridia_featured_show_settings', true );
// Featured Area
if ( $meridia_featured_show_setting ) {
    
    if ( MERIDIA_PRODUCTION ) {
        if ( meridia_fs()->is_free_plan() ) {
            if ( 'hero-slider' == $meridia_featured_setting ) {
                get_template_part( 'template-parts/featured-area/hero-slider' );
            }
        }
    } else {
        if ( meridia_fs()->is_free_plan() ) {
            
            if ( 'hero-slider' == $meridia_featured ) {
                set_theme_mod( 'meridia_featured_select_settings', 'hero-slider' );
                get_template_part( 'template-parts/featured-area/hero-slider' );
            }
        
        }
    }

}