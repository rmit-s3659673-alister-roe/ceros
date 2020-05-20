<?php

/**
 * Theme Customizer
 *
 * @package Meridia
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
function meridia_customize_register( $wp_customize )
{
    // Customize Background Settings
    $wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background Styles', 'meridia' );
    $wp_customize->get_control( 'background_color' )->section = 'background_image';
    // Remove Custom Header Section
    $wp_customize->remove_section( 'header_image' );
    $wp_customize->remove_section( 'colors' );
}

add_action( 'customize_register', 'meridia_customize_register' );
// Check if Kirki is installed

if ( class_exists( 'Kirki' ) ) {
    // Selector Vars
    $meridia_selectors = array(
        'main_color'                 => 'a,
			a:focus,
			.loader,
			.socials a:hover,
			.entry-navigation a:hover,
			.owl-next:hover i,
			.owl-prev:hover i,
			.socials--nobase a:hover,
			.entry-category,
			.entry-title:hover a,
			.entry-meta li a:hover,
			.instagram-feed > p a:hover,
			.related-posts__entry-title a:hover,
			.comment-edit-link,
			.widget-popular-posts__entry-title a:hover,
			.widget_recent_entries a:hover,
			.footer .widget_recent_entries a:hover,
			.widget_recent_comments a:hover,
			.footer .widget_recent_comments a:hover,
			.widget_nav_menu a:hover,
			.footer .widget_nav_menu a:hover,
			.widget_archive a:hover,
			.footer .widget_archive a:hover,
			.widget_pages a:hover,
			.footer .widget_pages a:hover,
			.widget_categories a:hover,
			.footer .widget_categories a:hover,
			.widget_meta a:hover,
			.footer .widget_meta a:hover,
			.widget_rss .rsswidget:hover
			.footer .widget_rss .rsswidget:hover
			',
        'main_background_color'      => '.btn-color,
			.btn-button:focus,
			.wp-block-button .wp-block-button__link:active,
			.wp-block-button .wp-block-button__link:focus,
			.wp-block-button .wp-block-button__link:hover,
			.pagination a:hover,
			.mc4wp-form-fields input[type=submit],
			.nav__icon-toggle:focus .nav__icon-toggle-bar,
			.nav__icon-toggle:hover .nav__icon-toggle-bar,
			.comment-author__post-author-label,
			#back-to-top:hover',
        'main_border_color'          => 'input:focus, textarea:focus, blockquote',
        'shop_main_color'            => '.woocommerce ul.products li.product a:hover .woocommerce-loop-product__title,
			.woocommerce ul.products li.product a:focus .woocommerce-loop-product__title,
			.widget_product_categories li a:hover,
			.widget_rating_filter li a:hover,
			.woocommerce-widget-layered-nav-list li a:hover,
			.widget_products .product_list_widget a:hover,
			.widget_top_rated_products .product_list_widget a:hover,
			.widget_recent_reviews .product_list_widget a:hover,
			.widget_shopping_cart .product_list_widget a:hover,
			.widget_recently_viewed_products .product_list_widget a:hover,
			.woocommerce .woocommerce-breadcrumb a:hover,
			.woocommerce .woocommerce-breadcrumb a:focus,
			.woocommerce-page .woocommerce-breadcrumb a:hover,
			.woocommerce-page .woocommerce-breadcrumb a:focus,
			.woocommerce table.shop_table .product-name a:hover,
			.woocommerce-MyAccount-navigation-link.is-active a,
			.woocommerce-MyAccount-navigation li a:hover',
        'shop_main_background_color' => '.woocommerce #respond input#submit,
			.woocommerce #respond input#submit.alt,
			.woocommerce a.button,
			.woocommerce a.button.alt,
			.woocommerce button.button,
			.woocommerce button.button.alt,
			.woocommerce input.button,
			.woocommerce input.button.alt,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce nav.woocommerce-pagination ul li a:focus,
			.woocommerce nav.woocommerce-pagination ul li a:hover',
        'shop_main_border_color'     => '#add_payment_method table.cart td.actions .coupon .input-text:focus,
			.woocommerce-cart table.cart td.actions .coupon .input-text:focus,
			.woocommerce-checkout table.cart td.actions .coupon .input-text:focus',
        'slider_background_color'    => '.hero-slider:before',
        'headings_color'             => 'h1,h2,h3,h4,h5,h6',
        'shop_headings_color'        => '.widget_products .product_list_widget a,
			.widget_top_rated_products .product_list_widget a,
			.widget_recent_reviews .product_list_widget a,
			.widget_shopping_cart .product_list_widget a,
			.widget_recently_viewed_products .product_list_widget a',
        'text_color'                 => 'body',
        'meta_color'                 => '.entry-meta li, .entry-share span, .comment-date, .gallery-caption',
        'headings'                   => 'h1,h2,h3,h4,h5,h6, .btn, .nav__menu > li > a, .nav__dropdown-menu > li > a, .nav__dropdown-submenu > .nav__dropdown-menu > li > a',
        'h1'                         => 'h1',
        'h2'                         => 'h2',
        'h3'                         => 'h3',
        'h4'                         => 'h4',
        'h5'                         => 'h5',
        'h6'                         => 'h6',
        'text'                       => 'body, .widget-popular-posts__entry-title',
        'meta'                       => '.entry-meta li, .entry-category, .entry-share span',
        'footer_links_color'         => '.footer__widgets a,
			.footer #wp-calendar caption,
			.footer #wp-calendar a,
			.footer .widget_recent_entries a,
			.footer .widget_rss .rsswidget,
			.footer .widget_recent_comments a,
			.footer .widget_nav_menu a,
			.footer .widget_archive a,
			.footer .widget_pages a,
			.footer .widget_categories a,
			.footer .widget_meta a,
			.footer .deo-newsletter-gdpr-checkbox__label',
        'footer_dividers_color'      => '.footer .widget_recent_entries li,
			.footer .widget-popular-posts__list > li,
			.footer .recentcomments,
			.footer .widget_nav_menu li,
			.footer .widget_pages li,
			.footer .widget_categories li,
			.footer .widget_meta li,
			.footer__socials',
    );
    // Kirki
    Kirki::add_config( 'meridia_config', array(
        'capability'  => 'edit_theme_options',
        'option_type' => 'theme_mod',
        'option_name' => 'meridia_config',
    ) );
    /**
     * SECTIONS / PANELS
     **/
    $meridia_priority = 20;
    $meridia_uniqid = 1;
    // 01 GENERAL PANEL
    Kirki::add_panel( 'meridia_general', array(
        'title'    => esc_attr__( 'General', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // Preloader
    Kirki::add_section( 'meridia_preloader', array(
        'title' => esc_html__( 'Preloader', 'meridia' ),
        'panel' => 'meridia_general',
    ) );
    // Back to Top
    Kirki::add_section( 'meridia_back_to_top', array(
        'title' => esc_html__( 'Back to Top', 'meridia' ),
        'panel' => 'meridia_general',
    ) );
    // 02 Header
    Kirki::add_section( 'meridia_header', array(
        'title'    => esc_html__( 'Header', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // 03 Featured Area
    Kirki::add_section( 'meridia_featured_area', array(
        'title'    => esc_html__( 'Featured Area', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // 04 Promo Boxes
    Kirki::add_section( 'meridia_promo', array(
        'title'    => esc_html__( 'Promo Boxes', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // 05 BLOG PANEL
    Kirki::add_panel( 'meridia_blog', array(
        'title'    => esc_attr__( 'Blog', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // Post Layout
    Kirki::add_section( 'meridia_post_layout', array(
        'title' => esc_html__( 'Post Layout', 'meridia' ),
        'panel' => 'meridia_blog',
    ) );
    // Post Pagination
    Kirki::add_section( 'meridia_post_pagination', array(
        'title' => esc_html__( 'Post Pagination', 'meridia' ),
        'panel' => 'meridia_blog',
    ) );
    // Post Meta
    Kirki::add_section( 'meridia_post_meta', array(
        'title' => esc_html__( 'Post Meta', 'meridia' ),
        'panel' => 'meridia_blog',
    ) );
    // Single Post
    Kirki::add_section( 'meridia_single_post', array(
        'title' => esc_html__( 'Single Post', 'meridia' ),
        'panel' => 'meridia_blog',
    ) );
    // Post Excerpt
    Kirki::add_section( 'meridia_post_excerpt', array(
        'title' => esc_html__( 'Post Excerpt', 'meridia' ),
        'panel' => 'meridia_blog',
    ) );
    // 06 Layout PANEL
    Kirki::add_panel( 'meridia_layout', array(
        'title'    => esc_html__( 'Layout', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // Blog Layout
    Kirki::add_section( 'meridia_blog_layout', array(
        'title'       => esc_html__( 'Blog', 'meridia' ),
        'description' => esc_html__( 'Layout options for blog pages', 'meridia' ),
        'panel'       => 'meridia_layout',
        'capability'  => 'edit_theme_options',
    ) );
    // Archives Layout
    Kirki::add_section( 'meridia_archives_layout', array(
        'title'       => esc_html__( 'Archives', 'meridia' ),
        'description' => esc_html__( 'Layout options for archives and categories pages', 'meridia' ),
        'panel'       => 'meridia_layout',
        'capability'  => 'edit_theme_options',
    ) );
    // Page Layout
    Kirki::add_section( 'meridia_page_layout', array(
        'title'       => esc_html__( 'Page', 'meridia' ),
        'description' => esc_html__( 'Layout options for regular pages', 'meridia' ),
        'panel'       => 'meridia_layout',
        'capability'  => 'edit_theme_options',
    ) );
    // 07 Colors PANEL
    Kirki::add_panel( 'meridia_colors', array(
        'title'    => esc_html__( 'Colors', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // General Colors
    Kirki::add_section( 'meridia_general_colors', array(
        'title' => esc_html__( 'General Colors', 'meridia' ),
        'panel' => 'meridia_colors',
    ) );
    // Header Colors
    Kirki::add_section( 'meridia_header_colors', array(
        'title' => esc_html__( 'Header Colors', 'meridia' ),
        'panel' => 'meridia_colors',
    ) );
    // Text Colors
    Kirki::add_section( 'meridia_text_colors', array(
        'title' => esc_html__( 'Text Colors', 'meridia' ),
        'panel' => 'meridia_colors',
    ) );
    // Footer Colors
    Kirki::add_section( 'meridia_footer_colors', array(
        'title' => esc_html__( 'Footer Colors', 'meridia' ),
        'panel' => 'meridia_colors',
    ) );
    // 08 Typography
    Kirki::add_section( 'meridia_typography', array(
        'title'    => esc_html__( 'Typography', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    // 10 Footer
    Kirki::add_section( 'meridia_footer', array(
        'title'    => esc_html__( 'Footer', 'meridia' ),
        'priority' => $meridia_priority++,
    ) );
    /**
     * CONTROLS
     **/
    // Logo Image Upload
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'image',
        'settings' => 'meridia_logo_image_upload',
        'label'    => esc_attr__( 'Upload White Logo', 'meridia' ),
        'section'  => 'title_tagline',
        'default'  => MERIDIA_THEME_URI . '/assets/img/logo.png',
    ) );
    // Logo Retina Image Upload
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'image',
        'settings'    => 'meridia_logo_retina_image_upload',
        'label'       => esc_attr__( 'Upload White Retina Logo', 'meridia' ),
        'description' => esc_html__( 'Logo 2x bigger size', 'meridia' ),
        'section'     => 'title_tagline',
        'default'     => MERIDIA_THEME_URI . '/assets/img/logo@2x.png',
    ) );
    // Logo Dark Image Upload
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'image',
        'settings' => 'meridia_logo_dark_image_upload',
        'label'    => esc_attr__( 'Upload Dark Logo', 'meridia' ),
        'section'  => 'title_tagline',
        'default'  => MERIDIA_THEME_URI . '/assets/img/logo_dark.png',
    ) );
    // Logo Dark Retina Image Upload
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'image',
        'settings'    => 'meridia_logo_dark_retina_image_upload',
        'label'       => esc_attr__( 'Upload Dark Retina Logo', 'meridia' ),
        'description' => esc_html__( 'Logo 2x bigger size', 'meridia' ),
        'section'     => 'title_tagline',
        'default'     => MERIDIA_THEME_URI . '/assets/img/logo_dark@2x.png',
    ) );
    /**
     * 01 General
     */
    // Preloader
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_preloader_settings',
        'label'    => esc_html__( 'Enable/Disable Theme Preloader', 'meridia' ),
        'section'  => 'meridia_preloader',
        'default'  => false,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Back to top
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'checkbox',
        'settings' => 'meridia_back_to_top_settings',
        'label'    => esc_html__( 'Back to top arrow', 'meridia' ),
        'section'  => 'meridia_back_to_top',
        'default'  => 1,
    ) );
    // Sticky nav
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_sticky_nav_settings',
        'label'    => esc_html__( 'Sticky Navbar', 'meridia' ),
        'section'  => 'meridia_header',
        'default'  => 1,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Header navbar height
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'slider',
        'settings'    => 'meridia_header_navbar_height',
        'label'       => esc_attr__( 'Header navbar height', 'meridia' ),
        'description' => esc_html__( 'Will apply only on big screens, doesn\'t affect mobile headers. Affects navbar height.', 'meridia' ),
        'section'     => 'meridia_header',
        'default'     => 60,
        'choices'     => array(
        'min'  => '40',
        'max'  => '200',
        'step' => '1',
    ),
        'output'      => array( array(
        'element'     => '.nav:not(.nav--transparent), .nav__flex-parent',
        'property'    => 'height',
        'units'       => 'px',
        'media_query' => '@media (min-width: 992px)',
    ), array(
        'element'     => '.nav:not(.nav--transparent)',
        'property'    => 'min-height',
        'units'       => 'px',
        'media_query' => '@media (min-width: 992px)',
    ), array(
        'element'     => '.nav__menu > li > a',
        'property'    => 'line-height',
        'units'       => 'px',
        'media_query' => '@media (min-width: 992px)',
    ) ),
    ) );
    // Logo height
    Kirki::add_field( 'meridia_config', array(
        'type'            => 'slider',
        'settings'        => 'meridia_header_logo_height',
        'label'           => esc_attr__( 'Header logo height', 'meridia' ),
        'section'         => 'meridia_header',
        'default'         => 48,
        'choices'         => array(
        'min'  => '10',
        'max'  => '200',
        'step' => '1',
    ),
        'output'          => array( array(
        'element'  => '.nav__header .logo',
        'property' => 'max-height',
        'units'    => 'px',
    ) ),
        'active_callback' => array( array(
        'setting'  => 'meridia_header_type',
        'value'    => 'header-type-2',
        'operator' => '!=',
    ) ),
    ) );
    // Menu items horizontal spacing
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'slider',
        'settings'    => 'meridia_header_text_links_horizontal_spacing',
        'label'       => esc_attr__( 'Menu text links horizontal spacing', 'meridia' ),
        'description' => esc_html__( 'Will apply only on big screens, doesn\'t affect mobile headers', 'meridia' ),
        'section'     => 'meridia_header',
        'default'     => 13,
        'choices'     => array(
        'min'  => '0',
        'max'  => '60',
        'step' => '1',
    ),
        'output'      => array( array(
        'element'     => '.nav__menu > li > a',
        'property'    => 'padding-left',
        'units'       => 'px',
        'media_query' => '@media (min-width: 992px)',
    ), array(
        'element'     => '.nav__menu > li > a',
        'property'    => 'padding-right',
        'units'       => 'px',
        'media_query' => '@media (min-width: 992px)',
    ) ),
    ) );
    // Show nav search
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_nav_search_show',
        'label'    => esc_html__( 'Show navbar search', 'meridia' ),
        'section'  => 'meridia_header',
        'default'  => 1,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    /**
     * 03 Featured Area
     */
    // Featured Show
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_featured_show_settings',
        'label'    => esc_html__( 'Enable/Disable Featured Area', 'meridia' ),
        'section'  => 'meridia_featured_area',
        'default'  => 1,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Featured Slider Categories control
    Kirki::add_field( 'meridia_config', array(
        'type'            => 'select',
        'settings'        => 'meridia_featured_slider_categories_settings',
        'label'           => esc_html__( 'Choose featured category', 'meridia' ),
        'section'         => 'meridia_featured_area',
        'default'         => 0,
        'choices'         => meridia_categories_dropdown(),
        'active_callback' => array( array(
        'setting'  => 'meridia_featured_select_settings',
        'value'    => 'hero-image',
        'operator' => '!=',
    ) ),
    ) );
    // Featured Slider Posts ID controls
    Kirki::add_field( 'meridia_config', array(
        'type'            => 'text',
        'settings'        => 'meridia_featured_slider_posts_id_settings',
        'label'           => esc_html__( 'Choose specific posts by ID', 'meridia' ),
        'description'     => esc_html__( 'Paste posts ID\'s separated by commas. This will overwrite featured category settings.', 'meridia' ),
        'section'         => 'meridia_featured_area',
        'default'         => esc_attr( '' ),
        'active_callback' => array( array(
        'setting'  => 'meridia_featured_select_settings',
        'value'    => 'hero-image',
        'operator' => '!=',
    ) ),
    ) );
    // Featured Slider Posts control
    Kirki::add_field( 'meridia_config', array(
        'type'            => 'number',
        'settings'        => 'meridia_hero_slider_posts_settings',
        'label'           => esc_html__( 'How many posts to show', 'meridia' ),
        'section'         => 'meridia_featured_area',
        'default'         => 3,
        'active_callback' => array( array(
        'setting'  => 'meridia_featured_select_settings',
        'value'    => 'hero-slider',
        'operator' => '==',
    ), array(
        'setting'  => 'meridia_featured_select_settings',
        'value'    => 'hero-image',
        'operator' => '!=',
    ) ),
        'choices'         => array(
        'min'  => 0,
        'max'  => 10,
        'step' => 1,
    ),
    ) );
    /**
     * 04 Promo Boxes
     */
    // Promo Boxes Show
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_promo_show_settings',
        'label'    => esc_html__( 'Enable/Disable Promo Boxes', 'meridia' ),
        'section'  => 'meridia_promo',
        'default'  => false,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'custom',
        'settings' => 'separator-' . $meridia_uniqid++,
        'section'  => 'meridia_promo',
        'default'  => '<h3 class="customizer-title">' . esc_attr__( 'Promo Box 1', 'meridia' ) . '</h3>',
    ) );
    // Promo Box Image Upload 1
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'image',
        'settings'    => 'meridia_promo_image_upload_1',
        'label'       => esc_attr__( 'Promo Box 1 Image Upload', 'meridia' ),
        'description' => esc_attr__( 'Recommended size is 350x260.', 'meridia' ),
        'section'     => 'meridia_promo',
        'default'     => MERIDIA_THEME_URI . '/assets/img/defaults/meridia_promo_1.jpg',
    ) );
    // Promo Box Text Control 1
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'text',
        'settings' => 'meridia_promo_text_1',
        'label'    => esc_html__( 'Promo Box 1 Text', 'meridia' ),
        'section'  => 'meridia_promo',
        'default'  => esc_attr__( 'Travel Guide', 'meridia' ),
    ) );
    // Promo Box URL Control 1
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'url',
        'settings' => 'meridia_promo_url_1',
        'label'    => esc_html__( 'Promo Box 1 URL', 'meridia' ),
        'section'  => 'meridia_promo',
        'default'  => esc_url( '#' ),
    ) );
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'custom',
        'settings' => 'separator-' . $meridia_uniqid++,
        'section'  => 'meridia_promo',
        'default'  => '<h3 class="customizer-title">' . esc_attr__( 'Promo Box 2', 'meridia' ) . '</h3>',
    ) );
    // Promo Box Image Upload 2
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'image',
        'settings'    => 'meridia_promo_image_upload_2',
        'label'       => esc_attr__( 'Promo Box 2 Image Upload', 'meridia' ),
        'description' => esc_attr__( 'Recommended size is 350x260.', 'meridia' ),
        'section'     => 'meridia_promo',
        'default'     => MERIDIA_THEME_URI . '/assets/img/defaults/meridia_promo_2.jpg',
    ) );
    // Promo Box Text Control 2
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'text',
        'settings' => 'meridia_promo_text_2',
        'label'    => esc_html__( 'Promo Box 2 Text', 'meridia' ),
        'section'  => 'meridia_promo',
        'default'  => esc_attr__( 'Instagram', 'meridia' ),
    ) );
    // Promo Box URL Control 2
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'url',
        'settings' => 'meridia_promo_url_2',
        'label'    => esc_html__( 'Promo Box 2 URL', 'meridia' ),
        'section'  => 'meridia_promo',
        'default'  => esc_url( '#' ),
    ) );
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'custom',
        'settings' => 'separator-' . $meridia_uniqid++,
        'section'  => 'meridia_promo',
        'default'  => '<h3 class="customizer-title">' . esc_attr__( 'Promo Box 3', 'meridia' ) . '</h3>',
    ) );
    // Promo Box Image Upload 3
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'image',
        'settings'    => 'meridia_promo_image_upload_3',
        'label'       => esc_attr__( 'Promo Box 3 Image Upload', 'meridia' ),
        'description' => esc_attr__( 'Recommended size is 350x260.', 'meridia' ),
        'section'     => 'meridia_promo',
        'default'     => MERIDIA_THEME_URI . '/assets/img/defaults/meridia_promo_3.jpg',
    ) );
    // Promo Box Text Control 3
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'text',
        'settings' => 'meridia_promo_text_3',
        'label'    => esc_html__( 'Promo Box 3 Text', 'meridia' ),
        'section'  => 'meridia_promo',
        'default'  => esc_attr__( 'Lifestyle', 'meridia' ),
    ) );
    // Promo Box URL Control 3
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'url',
        'settings' => 'meridia_promo_url_3',
        'label'    => esc_html__( 'Promo Box 3 URL', 'meridia' ),
        'section'  => 'meridia_promo',
        'default'  => esc_url( '#' ),
    ) );
    /**
     * 05 Blog
     */
    /**
     * Pagination
     */
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'radio',
        'settings' => 'meridia_pagination_settings',
        'label'    => esc_attr__( 'Pagination options', 'meridia' ),
        'section'  => 'meridia_post_pagination',
        'default'  => 'buttons',
        'choices'  => array(
        'button'  => esc_attr__( 'Load More Button', 'meridia' ),
        'numbers' => esc_attr__( 'Numbers', 'meridia' ),
    ),
    ) );
    /**
     * Meta
     */
    // Meta category
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_meta_category_settings',
        'label'    => esc_attr__( 'Show meta category', 'meridia' ),
        'section'  => 'meridia_post_meta',
        'default'  => '1',
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Meta date control
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_meta_date_settings',
        'label'    => esc_attr__( 'Show meta date', 'meridia' ),
        'section'  => 'meridia_post_meta',
        'default'  => '1',
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Meta comments control
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_meta_comments_settings',
        'label'    => esc_attr__( 'Show meta comments', 'meridia' ),
        'section'  => 'meridia_post_meta',
        'default'  => '1',
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    /**
     * Single Post
     */
    // Post tags
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_post_tags_settings',
        'label'    => esc_attr__( 'Show tags', 'meridia' ),
        'section'  => 'meridia_single_post',
        'default'  => true,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Related posts
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_related_posts_settings',
        'label'    => esc_attr__( 'Show related posts', 'meridia' ),
        'section'  => 'meridia_single_post',
        'default'  => true,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Related by
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'select',
        'settings' => 'meridia_related_posts_relation',
        'label'    => esc_html__( 'Related by', 'meridia' ),
        'section'  => 'meridia_single_post',
        'default'  => 'category',
        'choices'  => array(
        'category' => esc_attr__( 'Category', 'meridia' ),
        'tag'      => esc_attr__( 'Tag', 'meridia' ),
        'author'   => esc_attr__( 'Author', 'meridia' ),
    ),
    ) );
    /**
     * Posts Excerpt
     */
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'number',
        'settings' => 'meridia_posts_excerpt_settings',
        'label'    => esc_attr__( 'Posts excerpt options', 'meridia' ),
        'section'  => 'meridia_post_excerpt',
        'default'  => 55,
        'choices'  => array(
        'min'  => 0,
        'max'  => 9999,
        'step' => 1,
    ),
    ) );
    /**
     * 06 Layout
     */
    // Post Layout
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'radio-image',
        'settings' => 'meridia_post_layout_type',
        'label'    => esc_html__( 'Post layout type', 'meridia' ),
        'section'  => 'meridia_blog_layout',
        'default'  => 'grid',
        'choices'  => array(
        'grid' => get_template_directory_uri() . '/assets/img/customizer/grid.png',
        'list' => get_template_directory_uri() . '/assets/img/customizer/list.png',
    ),
    ) );
    // Blog Layout
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'radio-image',
        'settings' => 'meridia_blog_layout_type',
        'label'    => esc_html__( 'Blog layout type', 'meridia' ),
        'section'  => 'meridia_blog_layout',
        'default'  => 'right-sidebar',
        'choices'  => array(
        'left-sidebar'  => get_template_directory_uri() . '/assets/img/customizer/left-sidebar.png',
        'right-sidebar' => get_template_directory_uri() . '/assets/img/customizer/right-sidebar.png',
        'fullwidth'     => get_template_directory_uri() . '/assets/img/customizer/fullwidth.png',
    ),
    ) );
    // Archives Layout
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'radio-image',
        'settings' => 'meridia_archives_layout_type',
        'label'    => esc_html__( 'Page layout type', 'meridia' ),
        'section'  => 'meridia_archives_layout',
        'default'  => 'fullwidth',
        'choices'  => array(
        'left-sidebar'  => get_template_directory_uri() . '/assets/img/customizer/left-sidebar.png',
        'right-sidebar' => get_template_directory_uri() . '/assets/img/customizer/right-sidebar.png',
        'fullwidth'     => get_template_directory_uri() . '/assets/img/customizer/fullwidth.png',
    ),
    ) );
    // Archives columns
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'select',
        'settings'    => 'meridia_archives_columns',
        'label'       => esc_html__( 'Columns', 'meridia' ),
        'description' => esc_html__( 'Will apply on grid layout type', 'meridia' ),
        'section'     => 'meridia_archives_layout',
        'default'     => 'col-lg-4',
        'choices'     => array(
        'col-lg-12' => esc_attr__( '1 Column', 'meridia' ),
        'col-lg-6'  => esc_attr__( '2 Columns', 'meridia' ),
        'col-lg-4'  => esc_attr__( '3 Columns', 'meridia' ),
        'col-lg-3'  => esc_attr__( '4 Columns', 'meridia' ),
    ),
    ) );
    // Page Layout
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'radio-image',
        'settings' => 'meridia_page_layout_type',
        'label'    => esc_html__( 'Page layout type', 'meridia' ),
        'section'  => 'meridia_page_layout',
        'default'  => 'fullwidth',
        'choices'  => array(
        'left-sidebar'  => get_template_directory_uri() . '/assets/img/customizer/left-sidebar.png',
        'right-sidebar' => get_template_directory_uri() . '/assets/img/customizer/right-sidebar.png',
        'fullwidth'     => get_template_directory_uri() . '/assets/img/customizer/fullwidth.png',
    ),
    ) );
    /**
     * 07 Colors
     */
    /* General Colors */
    // Main color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_color_settings',
        'label'    => esc_html__( 'Main accent color', 'meridia' ),
        'section'  => 'meridia_general_colors',
        'default'  => '#c0945c',
        'output'   => array(
        array(
        'element'  => $meridia_selectors['main_color'],
        'property' => 'color',
    ),
        array(
        'element'  => $meridia_selectors['shop_main_color'],
        'property' => 'color',
    ),
        array(
        'element'  => $meridia_selectors['main_background_color'],
        'property' => 'background-color',
    ),
        array(
        'element'  => $meridia_selectors['shop_main_background_color'],
        'property' => 'background-color',
    ),
        array(
        'element'  => $meridia_selectors['main_border_color'],
        'property' => 'border-color',
    ),
        array(
        'element'  => $meridia_selectors['shop_main_border_color'],
        'property' => 'border-color',
    )
    ),
    ) );
    // Background
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_background_color_settings',
        'label'    => esc_html__( 'Background color', 'meridia' ),
        'section'  => 'meridia_general_colors',
        'default'  => '#ffffff',
        'output'   => array( array(
        'element'  => 'body',
        'property' => 'background-color',
    ) ),
    ) );
    // Page container background
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_page_container_background_color_settings',
        'label'    => esc_html__( 'Page container background color', 'meridia' ),
        'section'  => 'meridia_general_colors',
        'default'  => '',
        'output'   => array( array(
        'element'  => '.container-holder',
        'property' => 'background-color',
    ) ),
    ) );
    // Slider background color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_slider_background_color_settings',
        'label'    => esc_html__( 'Slider background color', 'meridia' ),
        'section'  => 'meridia_general_colors',
        'default'  => '#fcf3ec',
        'output'   => array( array(
        'element'  => $meridia_selectors['slider_background_color'],
        'property' => 'background-color',
    ) ),
    ) );
    // Page title background color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_page_title_background_color_settings',
        'label'    => esc_html__( 'Page title background color', 'meridia' ),
        'section'  => 'meridia_general_colors',
        'default'  => '',
        'output'   => array( array(
        'element'  => '.page-title',
        'property' => 'background-color',
    ) ),
    ) );
    // Page title text color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_page_title_text_color',
        'label'    => esc_html__( 'Page title text color', 'meridia' ),
        'section'  => 'meridia_general_colors',
        'default'  => '',
        'output'   => array( array(
        'element'  => '.page-title__title',
        'property' => 'color',
    ) ),
    ) );
    /* Header Colors */
    // Header background color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_background_color',
        'label'    => esc_html__( 'Header background color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#000000',
        'output'   => array( array(
        'element'  => '.nav:not(.nav--white):not(.nav--transparent)',
        'property' => 'background-color',
    ) ),
    ) );
    // Header text color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_text_color',
        'label'    => esc_html__( 'Header text color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#ffffff',
        'output'   => array( array(
        'element'  => '.nav__menu > li > a, .nav__search-trigger',
        'property' => 'color',
    ) ),
    ) );
    // Header active text color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_text_active_color',
        'label'    => esc_html__( 'Header active link color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#c0945c',
        'output'   => array( array(
        'element'  => '.nav__menu > .active > a,
				.nav__menu > .current_page_parent > a,
				.nav__menu .current-menu-item > a',
        'property' => 'color',
    ) ),
    ) );
    // Header text hover color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_text_hover_color',
        'label'    => esc_html__( 'Header text hover color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#c0945c',
        'output'   => array( array(
        'element'  => '.nav__menu > li > a:hover, .nav__search-trigger:hover, .nav__socials .social:hover',
        'property' => 'color',
    ) ),
    ) );
    // Header dropdown background color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_dropdown_background_color',
        'label'    => esc_html__( 'Menu dropdown background color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#000000',
        'output'   => array( array(
        'element'     => '.nav__dropdown-menu',
        'property'    => 'background-color',
        'media_query' => '@media (min-width: 992px)',
    ) ),
    ) );
    // Header dropdown dividers color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_dropdown_dividers_color',
        'label'    => esc_html__( 'Menu dropdown dividers color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#363636',
        'output'   => array( array(
        'element'     => '.nav__dropdown-menu > li > a',
        'property'    => 'border-top-color',
        'media_query' => '@media (min-width: 992px)',
    ) ),
    ) );
    // Header dropdown text color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_dropdown_text_color',
        'label'    => esc_html__( 'Menu dropdown text color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#ffffff',
        'output'   => array( array(
        'element'     => '.nav__dropdown-menu > li > a',
        'property'    => 'color',
        'media_query' => '@media (min-width: 992px)',
    ) ),
    ) );
    // Header dropdown text hover color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_dropdown_text_hover_color',
        'label'    => esc_html__( 'Menu dropdown text hover color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#c0945c',
        'output'   => array( array(
        'element'     => '.nav__dropdown-menu > li > a:hover',
        'property'    => 'color',
        'media_query' => '@media (min-width: 992px)',
    ) ),
    ) );
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'custom',
        'settings' => 'separator-' . $meridia_uniqid++,
        'section'  => 'meridia_header_colors',
        'default'  => '<h3 class="customizer-title">' . esc_attr__( 'Mobile header', 'meridia' ) . '</h3>',
    ) );
    // Header mobile dropdown arrow color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_mobile_dropdown_arrow_color',
        'label'    => esc_html__( 'Header mobile dropdown arrow color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#999999',
        'output'   => array( array(
        'element'     => '.nav__dropdown-trigger',
        'property'    => 'color',
        'media_query' => '@media (max-width: 991px)',
    ) ),
    ) );
    // Header mobile dividers color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_mobile_dividers_color',
        'label'    => esc_html__( 'Header mobile dividers color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#363636',
        'output'   => array( array(
        'element'     => '.nav__menu li a',
        'property'    => 'border-bottom-color',
        'media_query' => '@media (max-width: 991px)',
    ) ),
    ) );
    // Header mobile search placeholder color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_mobile_search_placeholder_color',
        'label'    => esc_html__( 'Header mobile search placeholder color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#ffffff',
        'output'   => array( array(
        'element'  => '.nav__search-mobile .search-input::-webkit-input-placeholder, .nav__search-mobile .search-input',
        'property' => 'color',
    ), array(
        'element'  => '.nav__search-mobile .search-input:-moz-placeholder, .nav__search-mobile .search-input::-moz-placeholder',
        'property' => 'color',
    ), array(
        'element'  => '.nav__search-mobile .search-input:-ms-input-placeholder',
        'property' => 'color',
    ) ),
    ) );
    // Header mobile search icon color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_mobile_search_icon_color',
        'label'    => esc_html__( 'Header mobile search icon color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#ffffff',
        'output'   => array( array(
        'element'  => '.nav__search-mobile .search-button',
        'property' => 'color',
    ) ),
    ) );
    // Header mobile toggle color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_header_mobile_toggle_color',
        'label'    => esc_html__( 'Header mobile toggle color', 'meridia' ),
        'section'  => 'meridia_header_colors',
        'default'  => '#ffffff',
        'output'   => array( array(
        'element'  => '.nav__icon-toggle-bar',
        'property' => 'background-color',
    ) ),
    ) );
    /* Text Colors */
    // Headings color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_headings_color_settings',
        'label'    => esc_html__( 'Headings color', 'meridia' ),
        'section'  => 'meridia_text_colors',
        'default'  => '#000000',
        'output'   => array( array(
        'element'  => $meridia_selectors['headings_color'],
        'property' => 'color',
    ), array(
        'element'  => $meridia_selectors['shop_headings_color'],
        'property' => 'color',
    ), array(
        'element'  => '.edit-post-visual-editor .editor-post-title__block .editor-post-title__input,
				.edit-post-visual-editor .wp-block[data-type="core/heading"] h1,
				.edit-post-visual-editor .wp-block[data-type="core/heading"] h2,
				.edit-post-visual-editor .wp-block[data-type="core/heading"] h3,
				.edit-post-visual-editor .wp-block[data-type="core/heading"] h4,
				.edit-post-visual-editor .wp-block[data-type="core/heading"] h5,
				.edit-post-visual-editor .wp-block[data-type="core/heading"] h6',
        'property' => 'color',
        'context'  => array( 'editor' ),
    ) ),
    ) );
    // Text color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_text_color_settings',
        'label'    => esc_html__( 'Text color', 'meridia' ),
        'section'  => 'meridia_text_colors',
        'default'  => '#343434',
        'output'   => array( array(
        'element'  => $meridia_selectors['text_color'],
        'property' => 'color',
    ), array(
        'element'  => '.editor-styles-wrapper.edit-post-visual-editor',
        'property' => 'color',
        'context'  => array( 'editor' ),
    ) ),
    ) );
    // Meta color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_meta_color_settings',
        'label'    => esc_html__( 'Meta color', 'meridia' ),
        'section'  => 'meridia_text_colors',
        'default'  => '#999999',
        'output'   => array( array(
        'element'  => $meridia_selectors['meta_color'],
        'property' => 'color',
    ) ),
    ) );
    /* Footer Colors */
    // Footer background color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_footer_background_color',
        'label'    => esc_html__( 'Footer background color', 'meridia' ),
        'section'  => 'meridia_footer_colors',
        'default'  => '#ffffff',
        'output'   => array( array(
        'element'  => '.footer',
        'property' => 'background-color',
    ) ),
    ) );
    // Footer dividers color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_footer_dividers_color',
        'label'    => esc_html__( 'Footer dividers color', 'meridia' ),
        'section'  => 'meridia_footer_colors',
        'default'  => '#eaeaea',
        'output'   => array( array(
        'element'  => $meridia_selectors['footer_dividers_color'],
        'property' => 'border-color',
    ) ),
    ) );
    // Footer widget title color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_footer_widget_title_color',
        'label'    => esc_html__( 'Footer widget title color', 'meridia' ),
        'section'  => 'meridia_footer_colors',
        'default'  => '#000000',
        'output'   => array( array(
        'element'  => '.footer__widgets .widget-title',
        'property' => 'color',
    ) ),
    ) );
    // Footer links color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_footer_links_color',
        'label'    => esc_html__( 'Footer links color', 'meridia' ),
        'section'  => 'meridia_footer_colors',
        'default'  => '#343434',
        'output'   => array( array(
        'element'  => $meridia_selectors['footer_links_color'],
        'property' => 'color',
    ) ),
    ) );
    // Footer bottom background color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_footer_bottom_background_color',
        'label'    => esc_html__( 'Footer bottom background color', 'meridia' ),
        'section'  => 'meridia_footer_colors',
        'default'  => '#000000',
        'output'   => array( array(
        'element'  => '.footer-bottom',
        'property' => 'background-color',
    ) ),
    ) );
    // Footer bottom text color
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'color',
        'settings' => 'meridia_footer_bottom_copyright_text_color',
        'label'    => esc_html__( 'Footer copyright text color', 'meridia' ),
        'section'  => 'meridia_footer_colors',
        'default'  => '#999999',
        'output'   => array( array(
        'element'  => '.copyright',
        'property' => 'color',
    ) ),
    ) );
    /**
     * 08 Typography
     */
    // H1
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'typography',
        'settings' => 'meridia_headings_h1',
        'label'    => esc_html__( 'H1 Headings', 'meridia' ),
        'section'  => 'meridia_typography',
        'default'  => array(
        'font-family'    => 'Raleway',
        'font-size'      => '34px',
        'variant'        => '600',
        'line-height'    => '1.3',
        'letter-spacing' => '0.1em',
    ),
        'choices'  => array(
        'variant' => array( 'regular', '600' ),
    ),
        'output'   => array( array(
        'element' => $meridia_selectors['h1'],
    ), array(
        'element' => '.edit-post-visual-editor .wp-block[data-type="core/heading"] h1,
				.editor-post-title__block .editor-post-title__input',
        'context' => array( 'editor' ),
    ) ),
    ) );
    // H2
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'typography',
        'settings' => 'meridia_headings_h2',
        'label'    => esc_html__( 'H2 Headings', 'meridia' ),
        'section'  => 'meridia_typography',
        'default'  => array(
        'font-family'    => 'Raleway',
        'font-size'      => '32px',
        'variant'        => '600',
        'line-height'    => '1.3',
        'letter-spacing' => 'normal',
    ),
        'choices'  => array(
        'variant' => array( 'regular', '600' ),
    ),
        'output'   => array( array(
        'element' => $meridia_selectors['h2'],
    ), array(
        'element' => '.edit-post-visual-editor .wp-block[data-type="core/heading"] h2',
        'context' => array( 'editor' ),
    ) ),
    ) );
    // H3
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'typography',
        'settings' => 'meridia_headings_h3',
        'label'    => esc_html__( 'H3 Headings', 'meridia' ),
        'section'  => 'meridia_typography',
        'default'  => array(
        'font-family'    => 'Raleway',
        'font-size'      => '28px',
        'variant'        => '600',
        'line-height'    => '1.3',
        'letter-spacing' => 'normal',
    ),
        'choices'  => array(
        'variant' => array( 'regular', '600' ),
    ),
        'output'   => array( array(
        'element' => $meridia_selectors['h3'],
    ), array(
        'element' => '.edit-post-visual-editor .wp-block[data-type="core/heading"] h3',
        'context' => array( 'editor' ),
    ) ),
    ) );
    // H4
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'typography',
        'settings' => 'meridia_headings_h4',
        'label'    => esc_html__( 'H4 Headings', 'meridia' ),
        'section'  => 'meridia_typography',
        'default'  => array(
        'font-family'    => 'Raleway',
        'font-size'      => '24px',
        'variant'        => '600',
        'line-height'    => '1.3',
        'letter-spacing' => 'normal',
    ),
        'choices'  => array(
        'variant' => array( 'regular', '600' ),
    ),
        'output'   => array( array(
        'element' => $meridia_selectors['h4'],
    ), array(
        'element' => '.edit-post-visual-editor .wp-block[data-type="core/heading"] h4',
        'context' => array( 'editor' ),
    ) ),
    ) );
    // H5
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'typography',
        'settings' => 'meridia_headings_h5',
        'label'    => esc_html__( 'H5 Headings', 'meridia' ),
        'section'  => 'meridia_typography',
        'default'  => array(
        'font-family'    => 'Raleway',
        'font-size'      => '20px',
        'variant'        => '600',
        'line-height'    => '1.3',
        'letter-spacing' => 'normal',
    ),
        'choices'  => array(
        'variant' => array( 'regular', '600' ),
    ),
        'output'   => array( array(
        'element' => $meridia_selectors['h5'],
    ), array(
        'element' => '.edit-post-visual-editor .wp-block[data-type="core/heading"] h5',
        'context' => array( 'editor' ),
    ) ),
    ) );
    // H6
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'typography',
        'settings' => 'meridia_headings_h6',
        'label'    => esc_html__( 'H6 Headings', 'meridia' ),
        'section'  => 'meridia_typography',
        'default'  => array(
        'font-family'    => 'Raleway',
        'font-size'      => '18px',
        'variant'        => '600',
        'line-height'    => '1.3',
        'letter-spacing' => 'normal',
    ),
        'choices'  => array(
        'variant' => array( 'regular', '600' ),
    ),
        'output'   => array( array(
        'element' => $meridia_selectors['h6'],
    ), array(
        'element' => '.edit-post-visual-editor .wp-block[data-type="core/heading"] h6',
        'context' => array( 'editor' ),
    ) ),
    ) );
    // Meta typography
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'typography',
        'settings'    => 'meridia_meta_typography',
        'label'       => esc_html__( 'Meta Typography', 'meridia' ),
        'description' => esc_html__( 'Set the meta font styles.', 'meridia' ),
        'help'        => esc_html__( 'The typography options you set here apply to all content on your site.', 'meridia' ),
        'section'     => 'meridia_typography',
        'default'     => array(
        'font-family' => 'Libre Baskerville',
        'variant'     => 'italic',
        'font-size'   => '11px',
    ),
        'output'      => array( array(
        'element' => $meridia_selectors['meta'],
    ) ),
    ) );
    // Body typography
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'typography',
        'settings'    => 'meridia_body_typography',
        'label'       => esc_html__( 'Body Typography', 'meridia' ),
        'description' => esc_html__( 'Select the main typography options for your site.', 'meridia' ),
        'section'     => 'meridia_typography',
        'default'     => array(
        'font-family' => 'Open Sans',
        'font-size'   => '15px',
        'line-height' => '1.5',
    ),
        'choices'     => array(
        'variant' => array( '700', 'italic' ),
    ),
        'output'      => array( array(
        'element' => $meridia_selectors['text'],
    ), array(
        'element' => '.edit-post-visual-editor .editor-block-list__block,
				.edit-post-visual-editor .editor-block-list__block-edit,
				.edit-post-visual-editor',
        'context' => array( 'editor' ),
    ) ),
    ) );
    // Blockquote typography
    Kirki::add_field( 'meridia_config', array(
        'type'        => 'typography',
        'settings'    => 'meridia_blockquote_typography',
        'label'       => esc_html__( 'BLockquote Typography', 'meridia' ),
        'description' => esc_html__( 'Set the meta font styles.', 'meridia' ),
        'section'     => 'meridia_typography',
        'default'     => array(
        'font-family' => 'Libre Baskerville',
        'variant'     => 'italic',
        'font-size'   => '20px',
    ),
        'output'      => array( array(
        'element' => '.wp-block-pullquote p, .wp-block-quote p',
    ), array(
        'element' => '.edit-post-visual-editor .wp-block-quote p,
				.edit-post-visual-editor .wp-block-pullquote p',
        'context' => array( 'editor' ),
    ) ),
    ) );
    /**
     * 10 Footer
     */
    // Footer columns
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'select',
        'settings' => 'meridia_footer_col_settings',
        'label'    => esc_html__( 'How many columns to show', 'meridia' ),
        'section'  => 'meridia_footer',
        'default'  => 'four-col',
        'choices'  => array(
        'one-col'   => esc_attr__( '1 Column', 'meridia' ),
        'two-col'   => esc_attr__( '2 Columns', 'meridia' ),
        'three-col' => esc_attr__( '3 Columns', 'meridia' ),
        'four-col'  => esc_attr__( '4 Columns', 'meridia' ),
    ),
    ) );
    // Show bottom footer year
    Kirki::add_field( 'meridia_config', array(
        'type'     => 'switch',
        'settings' => 'meridia_footer_bottom_year_show',
        'label'    => esc_attr__( 'Show bottom footer year', 'meridia' ),
        'section'  => 'meridia_footer',
        'default'  => true,
        'choices'  => array(
        'on'  => esc_attr__( 'On', 'meridia' ),
        'off' => esc_attr__( 'Off', 'meridia' ),
    ),
    ) );
    // Bottom footer text
    Kirki::add_field( 'meridia_config', array(
        'type'              => 'text',
        'settings'          => 'meridia_footer_bottom_text',
        'section'           => 'meridia_footer',
        'label'             => esc_html__( 'Footer bottom text', 'meridia' ),
        'description'       => esc_html__( 'Allowed HTML: a, span, i, em, strong', 'meridia' ),
        'sanitize_callback' => 'meridia_sanitize_html',
        'default'           => sprintf( esc_html__( 'Meridia, Made by %1$sDeoThemes%2$s', 'meridia' ), '<a href="' . esc_url( 'https://deothemes.com' ) . '">', '</a>' ),
    ) );
}

// endif Kirki check