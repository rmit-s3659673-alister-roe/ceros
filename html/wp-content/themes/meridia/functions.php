<?php

/**
 * Theme functions and definitions
 *
 * @package Meridia
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !function_exists( 'meridia_fs' ) ) {
    // Create a helper function for easy SDK access.
    function meridia_fs()
    {
        global  $meridia_fs ;
        
        if ( !isset( $meridia_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $meridia_fs = fs_dynamic_init( array(
                'id'             => '5161',
                'slug'           => 'meridia',
                'premium_slug'   => 'meridia-pro',
                'type'           => 'theme',
                'public_key'     => 'pk_e73faa5f0f734afecae406580963c',
                'is_premium'     => false,
                'premium_suffix' => 'Pro',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'    => 'getting-started',
                'support' => false,
                'parent'  => array(
                'slug' => 'themes.php',
            ),
            ),
                'is_live'        => true,
            ) );
        }
        
        return $meridia_fs;
    }
    
    // Init Freemius.
    meridia_fs();
    // Signal that SDK was initiated.
    do_action( 'meridia_fs_loaded' );
}

// Set the content width based on the theme's design and stylesheet.

if ( !isset( $content_width ) ) {
    $content_width = 1170;
    // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound/
}

// Constants
define( 'MERIDIA_THEME_DIR', get_template_directory() );
define( 'MERIDIA_THEME_URI', get_template_directory_uri() );
define( 'MERIDIA_PRODUCTION', true );
// Includes
require MERIDIA_THEME_DIR . '/includes/theme-setup.php';
require MERIDIA_THEME_DIR . '/includes/theme-functions.php';
require MERIDIA_THEME_DIR . '/includes/admin/theme-admin.php';
require MERIDIA_THEME_DIR . '/includes/theme-hooks.php';
require MERIDIA_THEME_DIR . '/includes/template-parts.php';
require MERIDIA_THEME_DIR . '/includes/class-meridia-nav-walker.php';
require MERIDIA_THEME_DIR . '/includes/class-meridia-comments-walker.php';
require MERIDIA_THEME_DIR . '/includes/customizer.php';

if ( meridia_is_woocommerce_activated() ) {
    require 'includes/woocommerce/woocommerce-theme-hooks.php';
    require 'includes/woocommerce/woocommerce-theme-functions.php';
}

/**
* Theme styles
*/
function meridia_theme_styles()
{
    wp_enqueue_style( 'bootstrap', MERIDIA_THEME_URI . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'meridia-font-icons', MERIDIA_THEME_URI . '/assets/css/font-icons.css' );
    wp_enqueue_style( 'meridia-styles', get_stylesheet_uri(), array( 'bootstrap', 'meridia-font-icons' ) );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    // Fonts
    if ( !class_exists( 'Kirki' ) ) {
        wp_enqueue_style( 'meridia-google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,600|Open+Sans:400,400i,700|Libre+Baskerville:400i' );
    }
    wp_dequeue_style( 'wp-editor-font' );
    wp_deregister_style( 'wp-editor-font' );
}

add_action( 'wp_enqueue_scripts', 'meridia_theme_styles' );
/**
* Load Gutenberg backend styles.
*/
function meridia_gutenberg_assets()
{
    wp_enqueue_style( 'meridia-gutenberg-editor-styles', get_theme_file_uri( '/assets/css/gutenberg-editor-style.css' ), false );
    if ( !class_exists( 'Kirki' ) ) {
        wp_enqueue_style( 'meridia-gutenberg-editor-google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,600|Open+Sans:400,400i,700|Libre+Baskerville:400i' );
    }
}

add_action( 'enqueue_block_editor_assets', 'meridia_gutenberg_assets' );
/**
 * Theme scripts
 */
function meridia_theme_js()
{
    wp_enqueue_script(
        'bootstrap',
        MERIDIA_THEME_URI . '/assets/js/bootstrap.min.js',
        array( 'jquery' ),
        '4.0.0',
        true
    );
    wp_enqueue_script(
        'jquery-owl-carousel',
        MERIDIA_THEME_URI . '/assets/js/owl.carousel.min.js',
        array( 'jquery' ),
        '2.3.4',
        true
    );
    wp_enqueue_script(
        'modernizr',
        MERIDIA_THEME_URI . '/assets/js/modernizr.min.js',
        array( 'jquery' ),
        '3.6.0',
        true
    );
    wp_enqueue_script(
        'meridia-scripts',
        MERIDIA_THEME_URI . '/assets/js/scripts.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );
    // PHP to JS
    global  $wp_query ;
    $meridia_layout = '';
    $meridia_sidebar_on = '';
    
    if ( MERIDIA_PRODUCTION ) {
        $meridia_layout = get_theme_mod( 'meridia_post_layout_type', 'grid' );
        $meridia_sidebar_on = get_theme_mod( 'meridia_blog_layout_type', true );
    } else {
        $meridia_layout = ( isset( $_GET['meridia_layout'] ) ? $_GET['meridia_layout'] : 'grid' );
        $meridia_sidebar_on = ( isset( $_GET['meridia_sidebar'] ) ? $_GET['meridia_sidebar'] : 'on' );
    }
    
    // Load more
    wp_register_script(
        'meridia_loadmore',
        MERIDIA_THEME_URI . '/assets/js/loadmore.min.js',
        array( 'jquery' ),
        '1.0',
        true
    );
    wp_localize_script( 'meridia_loadmore', 'meridia_loadmore_params', array(
        'ajax_url'     => esc_url( admin_url( 'admin-ajax.php' ) ),
        'ajax_nonce'   => wp_create_nonce( 'meridia_ajax_loadmore_nonce' ),
        'posts'        => json_encode( $wp_query->query_vars ),
        'current_page' => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
        'max_page'     => $wp_query->max_num_pages,
        'layout'       => esc_html( $meridia_layout ),
        'sidebar_on'   => esc_html( $meridia_sidebar_on ),
    ) );
    wp_enqueue_script( 'meridia_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'meridia_theme_js' );
/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function meridia_skip_link_focus_fix()
{
    // The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
    ?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php 
}

add_action( 'wp_print_footer_scripts', 'meridia_skip_link_focus_fix' );
/**
 * Theme admin scripts and styles.
 */
function meridia_admin_scripts()
{
    wp_enqueue_style( 'meridia-admin-styles', MERIDIA_THEME_URI . '/assets/admin/css/admin-styles.css' );
}

add_action( 'admin_enqueue_scripts', 'meridia_admin_scripts' );
/**
 * WP Customizer styles and scripts
 */
function meridia_customizer_enqueue_scripts()
{
    wp_enqueue_style( 'meridia-customizer-styles', MERIDIA_THEME_URI . '/assets/css/customizer/customizer.css' );
}

add_action( 'customize_controls_enqueue_scripts', 'meridia_customizer_enqueue_scripts' );