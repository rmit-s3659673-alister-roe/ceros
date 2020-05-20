<?php
/**
 * Theme admin functions.
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
* Add admin menu
*
* @since 1.0.0
*/
function meridia_theme_admin_menu() {
	add_theme_page(
		__( 'Getting Started', 'meridia' ),
		__( 'Meridia', 'meridia' ),
		'manage_options',
		'getting-started',
		'meridia_admin_page_content',
		30
	);
}
add_action( 'admin_menu', 'meridia_theme_admin_menu' );


/**
* Add admin page content
*
* @since 1.0.0
*/
function meridia_admin_page_content() {
	$meridia_urls = array(
		'docs' 									=> 'https://demo.deothemes.com/wp_docs/meridia/index.html',
		'contact' 							=> 'https://deothemes.com/contact/',		
		'custom-widgets'				=> 'https://demo.deothemes.com/wp_docs/meridia/index.html#custom-widgets',
		'header-types'					=> 'https://demo.deothemes.com/wp_docs/meridia/index.html#header-types',
		'featured-area-types'		=> 'https://demo.deothemes.com/wp_docs/meridia/index.html#featured-area-types',
		'gdpr'									=> 'https://demo.deothemes.com/wp_docs/meridia/index.html#gdpr',
		'socials'								=> 'https://demo.deothemes.com/wp_docs/meridia/index.html#social-profiles',		
		'demo-import'						=> 'https://demo.deothemes.com/wp_docs/meridia/index.html#demo-import',
		'woocommerce' 					=> 'https://demo.deothemes.com/wp_docs/meridia/index.html#woocommerce',
	);

	$meridia_info = array(
		'custom-widgets' => array(
			'title'			=> __( 'Custom Widgets', 'meridia' ),
			'class'			=> 'deo-addon-list-item',
			'title_url' => $meridia_urls['custom-widgets'],
			'links'			=> array(
				array(
					'link_class'	 => 'deo-learn-more',
					'link_url'		 => $meridia_urls['custom-widgets'],
					'link_text'    => __( 'Learn More &#187;', 'meridia' ),
					'target_blank' => true
				),
			),
		),
		'header-types' => array(
			'title'			=> __( '3 Header Types', 'meridia' ),
			'class'			=> 'deo-addon-list-item',
			'title_url' => $meridia_urls['header-types'],
			'links'			=> array(
				array(
					'link_class'	 => 'deo-learn-more',
					'link_url'		 => $meridia_urls['header-types'],
					'link_text'    => __( 'Learn More &#187;', 'meridia' ),
					'target_blank' => true
				),
			),
		),
		'featured-area-types' => array(
			'title'			=> __( '3 Featured Area Types', 'meridia' ),
			'class'			=> 'deo-addon-list-item',
			'title_url' => $meridia_urls['header-types'],
			'links'			=> array(
				array(
					'link_class'	 => 'deo-learn-more',
					'link_url'		 => $meridia_urls['header-types'],
					'link_text'    => __( 'Learn More &#187;', 'meridia' ),
					'target_blank' => true
				),
			),
		),
		'gdpr' => array(
			'title'			=> __( 'GDPR', 'meridia' ),
			'class'			=> 'deo-addon-list-item',
			'title_url' => $meridia_urls['gdpr'],
			'links'			=> array(
				array(
					'link_class'	 => 'deo-learn-more',
					'link_url'		 => $meridia_urls['gdpr'],
					'link_text'    => __( 'Learn More &#187;', 'meridia' ),
					'target_blank' => true
				),
			),
		),
		'socials' => array(
			'title'			=> __( 'Social Media', 'meridia' ),
			'class'			=> 'deo-addon-list-item',
			'title_url' => $meridia_urls['socials'],
			'links'			=> array(
				array(
					'link_class'	 => 'deo-learn-more',
					'link_url'		 => $meridia_urls['socials'],
					'link_text'    => __( 'Learn More &#187;', 'meridia' ),
					'target_blank' => true
				),
			),
		),
		'demo-import' => array(
			'title'			=> __( 'One Click Demo Import', 'meridia' ),
			'class'			=> 'deo-addon-list-item',
			'title_url' => $meridia_urls['demo-import'],
			'links'			=> array(
				array(
					'link_class'	 => 'deo-learn-more',
					'link_url'		 => $meridia_urls['demo-import'],
					'link_text'    => __( 'Learn More &#187;', 'meridia' ),
					'target_blank' => true
				),
			),
		),
		'woocommerce' => array(
			'title'			=> __( 'WooCommerce', 'meridia' ),
			'class'			=> 'deo-addon-list-item',
			'title_url' => $meridia_urls['woocommerce'],
			'links'			=> array(
				array(
					'link_class'	 => 'deo-learn-more',
					'link_url'		 => $meridia_urls['woocommerce'],
					'link_text'    => __( 'Learn More &#187;', 'meridia' ),
					'target_blank' => true
				),
			),
		),		
	);

	?>
		<div class="wrap deo-container">
			<h1 class="deo-title"><?php esc_html_e( 'Getting Started', 'meridia' ); ?></h1>
			<p class="deo-text">
				<?php					
					echo esc_html__( 'Meridia is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it! Before you get started, install all the required and recommended plugins, without them theme will lack some customizations.', 'meridia' );					
				?>
			</p>
			<h3><?php echo esc_html__( 'What is next?', 'meridia' ); ?></h3>
			<ul class="deo-list">
				<li>
					<?php
						/* translators: %1$s: Docs URL. */
						printf(
							esc_html__( 'Check the %1$s for installation and customization guides.', 'meridia' ),
							sprintf(
								'<a href="%s" target="_blank">%s</a>',
								esc_url( $meridia_urls['docs'] ),
								esc_html__( 'Knowledge Base', 'meridia' )
							)
						);
					?>
				</li>
				<li>
					<?php
						/* translators: %1$s: Customizer URL. */
						printf(
							esc_html__( 'Go to %1$s to modify the look of your site. (requires active Kirki plugin)', 'meridia' ),
							sprintf(
								'<a href="%s" target="_blank">%s</a>',
								esc_url( admin_url( 'customize.php' ) ),
								esc_html__( 'Customizer', 'meridia' )
							)
						);
					?>
				</li>
				<li>
					<?php
						/* translators: %1$s: Contact URL. */
						printf(
							esc_html__( 'Need help? %1$s We\'re happy to help!', 'meridia' ),
							sprintf(
								'<a href="%s" target="_blank">%s</a>',
								esc_url( $meridia_urls['contact'] ),
								esc_html__( 'Get in touch with us.', 'meridia' )
							)
						);
					?>
				</li>
			</ul>

			<div class="postbox deo-postbox">
				<h2 class="deo-addon-title"><?php echo esc_html__( 'More features with Meridia Pro' ); ?></h2>
				<ul class="deo-addon-list">
					<?php
					foreach ( (array) $meridia_info as $addon => $info ) {
						$title_url     = ( isset( $info['title_url'] ) && ! empty( $info['title_url'] ) ) ? 'href="' . esc_url( $info['title_url'] ) . '"' : '';
						$anchor_target = ( isset( $info['title_url'] ) && ! empty( $info['title_url'] ) ) ? "target='_blank' rel='noopener'" : '';

						echo '<li class="' . esc_attr( $info['class'] ) . '"><a class="deo-addon-item-title"' . $title_url . $anchor_target . ' >' . esc_html( $info['title'] ) . '</a><div class="deo-addon-link-wrapper">';

							foreach ( $info['links'] as $key => $link ) {
								printf(
									'<a class="%1$s" %2$s %3$s> %4$s </a>',
									esc_attr( $link['link_class'] ),
									isset( $link['link_url'] ) ? 'href="' . esc_url( $link['link_url'] ) . '"' : '',
									( isset( $link['target_blank'] ) && $link['target_blank'] ) ? 'target="_blank" rel="noopener"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									esc_html( $link['link_text'] )
								);
							}

						echo '</div></li>';
					}
					?>
				</ul>
			</div>
		</div>
	<?php
}

/**
* Change theme icon
*
* @since 1.0.0
*/
function meridia_fs_custom_icon() {
  return MERIDIA_THEME_DIR . '/assets/admin/img/theme-icon.jpg';
} 
meridia_fs()->add_filter( 'plugin_icon' , 'meridia_fs_custom_icon' );