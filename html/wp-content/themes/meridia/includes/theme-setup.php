<?php

/**
 * Theme functions.
 *
 * @package Meridia
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
if ( !function_exists( 'meridia_theme_setup' ) ) {
    /**
    * Sets up theme defaults and registers support for various WordPress features.
    *
    * Note that this function is hooked into the after_setup_theme hook, which
    * runs before the init hook. The init hook is too late for some features, such
    * as indicating support for post thumbnails.
    */
    function meridia_theme_setup()
    {
        // Enable theme support
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );
        add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery' ) );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'custom-background', apply_filters( 'meridia_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
        add_theme_support( 'custom-header' );
        // Gutenberg
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        add_editor_style();
        add_theme_support( 'editor-color-palette', array(
            array(
            'name'  => esc_html__( 'gold', 'meridia' ),
            'slug'  => 'gold',
            'color' => '#c0945c',
        ),
            array(
            'name'  => esc_html__( 'seashell', 'meridia' ),
            'slug'  => 'seashell',
            'color' => '#fcf3ec',
        ),
            array(
            'name'  => esc_html__( 'pink', 'meridia' ),
            'slug'  => 'pink',
            'color' => '#d082a6',
        ),
            array(
            'name'  => esc_html__( 'grey', 'meridia' ),
            'slug'  => 'grey',
            'color' => '#999999',
        ),
            array(
            'name'  => esc_html__( 'white', 'meridia' ),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
            array(
            'name'  => esc_html__( 'black', 'meridia' ),
            'slug'  => 'black',
            'color' => '#000000',
        )
        ) );
        // Add custom image sizes
        add_image_size(
            'meridia_thumbnail',
            88,
            69,
            true
        );
        add_image_size(
            'meridia_medium',
            359,
            274,
            true
        );
        add_image_size(
            'meridia_large',
            769,
            501,
            true
        );
        // Nav menus
        register_nav_menus( array(
            'primary-menu' => esc_html__( 'Primary Menu', 'meridia' ),
        ) );
    }

}
// theme_setup
add_action( 'after_setup_theme', 'meridia_theme_setup' );
/*
 * Register widget areas.
 */
function meridia_widgets_init()
{
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'meridia' ),
        'id'            => 'meridia-blog-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="heading-lines"><h4 class="widget-title">',
        'after_title'   => '</h4></div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'meridia' ),
        'id'            => 'meridia-page-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="heading-lines"><h4 class="widget-title">',
        'after_title'   => '</h4></div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Instagram', 'meridia' ),
        'id'            => 'meridia-footer-instagram',
        'before_widget' => '<div id="%1$s" class="instagram-feed instagram-feed--wide text-center %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="instagram-feed__title uppercase">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'meridia' ),
        'id'            => 'meridia-footer-col-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'meridia' ),
        'id'            => 'meridia-footer-col-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'meridia' ),
        'id'            => 'meridia-footer-col-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 4', 'meridia' ),
        'id'            => 'meridia-footer-col-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}

add_action( 'widgets_init', 'meridia_widgets_init' );
/*
 * TGMPA plugins activation
 */
require_once MERIDIA_THEME_DIR . '/includes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'meridia_tgmpa_register_required_plugins' );
function meridia_tgmpa_register_required_plugins()
{
    $plugins = array(
        array(
        'name'     => 'Kirki',
        'slug'     => 'kirki',
        'required' => false,
    ),
        array(
        'name'     => 'Contact Form 7',
        'slug'     => 'contact-form-7',
        'required' => false,
    ),
        array(
        'name'     => 'Custom Twitter Feeds',
        'slug'     => 'custom-twitter-feeds',
        'required' => false,
    ),
        array(
        'name'     => 'Smash Balloon Social Photo Feed',
        'slug'     => 'instagram-feed',
        'required' => false,
    ),
        array(
        'name'     => 'MailChimp for WordPress',
        'slug'     => 'mailchimp-for-wp',
        'required' => false,
    ),
        array(
        'name'     => 'One Click Demo Import',
        'slug'     => 'one-click-demo-import',
        'required' => false,
    )
    );
    $config = array(
        'id'           => 'tgmpa',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
        'page_title'                     => esc_html__( 'Install Required Plugins', 'meridia' ),
        'menu_title'                     => esc_html__( 'Install Plugins', 'meridia' ),
        'installing'                     => esc_html__( 'Installing Plugin: %s', 'meridia' ),
        'updating'                       => esc_html__( 'Updating Plugin: %s', 'meridia' ),
        'oops'                           => esc_html__( 'Something went wrong with the plugin API.', 'meridia' ),
        'return'                         => esc_html__( 'Return to Required Plugins Installer', 'meridia' ),
        'plugin_activated'               => esc_html__( 'Plugin activated successfully.', 'meridia' ),
        'activated_successfully'         => esc_html__( 'The following plugin was activated successfully:', 'meridia' ),
        'plugin_already_active'          => esc_html__( 'No action taken. Plugin %1$s was already active.', 'meridia' ),
        'plugin_needs_higher_version'    => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'meridia' ),
        'complete'                       => esc_html__( 'All plugins installed and activated successfully. %1$s', 'meridia' ),
        'dismiss'                        => esc_html__( 'Dismiss this notice', 'meridia' ),
        'notice_cannot_install_activate' => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'meridia' ),
        'contact_admin'                  => esc_html__( 'Please contact the administrator of this site for help.', 'meridia' ),
        'nag_type'                       => 'updated',
    ),
    );
    tgmpa( $plugins, $config );
}

/*
 * Disable Kirki telemetry
 */
add_filter( 'kirki_telemetry', '__return_false' );