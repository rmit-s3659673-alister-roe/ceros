<?php
/**
 *
 * @package   GS Videos for YouTube
 * @author    GS Plugins <samdani1997@gmail.com>
 * @license   GPL-2.0+
 * @link      https://gsplugins.com
 * @copyright 2016 GS Plugins
 *
 * @wordpress-plugin
 * Plugin Name:           GS Videos for YouTube
 * Plugin URI:            https://gsplugins.com/wordpress-plugins
 * Description:           Best Responsive YouTube Gallery plugin for Wordpress to display YouTube Channel or Playlist videos at your site. Display anywhere at your site using shortcode like [gs_ytgal theme="gs_ytgal_grid"] & widgets. Check more shortcode examples and documentation at <a href="http://youtubegallery.gsplugins.com">GS Youtube Gallery PRO Demos & Docs</a>
 * Version:               1.1.1
 * Author:                GS Plugins
 * Author URI:            https://gsplugins.com
 * Text Domain:           gsyoutubegalleries
 * License:               GPL-2.0+
 * License URI:           http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! defined( 'GSYOUTUBEGALLERIES_HACK_MSG' ) ) define( 'GSYOUTUBEGALLERIES_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gsyoutubegallery' ) );

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSYOUTUBEGALLERIES_HACK_MSG );

/**
 * Defining constants
*/
if( ! defined( 'GSYOUTUBEGALLERIES_VERSION' ) ) define( 'GSYOUTUBEGALLERIES_VERSION', '1.1.1' );
if( ! defined( 'GSYOUTUBEGALLERIES_MENU_POSITION' ) ) define( 'GSYOUTUBEGALLERIES_MENU_POSITION', '31' );
if( ! defined( 'GSYOUTUBEGALLERIES_PLUGIN_DIR' ) ) define( 'GSYOUTUBEGALLERIES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'GSYOUTUBEGALLERIES_PLUGIN_URI' ) ) define( 'GSYOUTUBEGALLERIES_PLUGIN_URI', plugins_url( '', __FILE__ ) );
if( ! defined( 'GSYOUTUBEGALLERIES_FILES_DIR' ) ) define( 'GSYOUTUBEGALLERIES_FILES_DIR', GSYOUTUBEGALLERIES_PLUGIN_DIR . 'gs-youtubegalleries-files' );
if( ! defined( 'GSYOUTUBEGALLERIES_FILES_URI' ) ) define( 'GSYOUTUBEGALLERIES_FILES_URI', GSYOUTUBEGALLERIES_PLUGIN_URI . '/gs-youtubegalleries-files' );

/**
 * require_once
*/
require_once GSYOUTUBEGALLERIES_FILES_DIR . '/gs-plugins/gs-plugins.php';
require_once GSYOUTUBEGALLERIES_FILES_DIR . '/gs-plugins/gs-plugins-free.php';
require_once GSYOUTUBEGALLERIES_FILES_DIR . '/gs-plugins/gs-yt-help.php';
require_once GSYOUTUBEGALLERIES_FILES_DIR . '/includes/gs_youtubegalleries_shortcode.php';
require_once GSYOUTUBEGALLERIES_FILES_DIR . '/gs_youtubegalleries_scripts.php';
require_once GSYOUTUBEGALLERIES_FILES_DIR . '/admin/class.settings-api.php';
require_once GSYOUTUBEGALLERIES_FILES_DIR . '/admin/gs_youtubegalleries_options_config.php';

if ( ! function_exists('gs_ytvideos_pro_link') ) {
	function gs_ytvideos_pro_link( $gsYtVids_links ) {
		$gsYtVids_links[] = '<a class="gs-pro-link" href="https://gsplugins.com/product/wordpress-youtube-video-gallery-plugin" target="_blank">Go Pro!</a>';
		$gsYtVids_links[] = '<a href="https://gsplugins.com/wordpress-plugins" target="_blank">GS Plugins</a>';
		return $gsYtVids_links;
	}
	add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'gs_ytvideos_pro_link' );
}

/**
 * @gsyoutubegalleries_review_dismiss()
 * @gsyoutubegalleries_review_pending()
 * @gsyoutubegalleries_review_notice_message()
 * Make all the above functions working.
 */
function gsyoutubegalleries_review_notice(){

    gsyoutubegalleries_review_dismiss();
    gsyoutubegalleries_review_pending();

    $activation_time    = get_site_option( 'gsyoutubegalleries_active_time' );
    $review_dismissal   = get_site_option( 'gsyoutubegalleries_review_dismiss' );
    $maybe_later        = get_site_option( 'gsyoutubegalleries_maybe_later' );

    if ( 'yes' == $review_dismissal ) {
        return;
    }

    if ( ! $activation_time ) {
        add_site_option( 'gsyoutubegalleries_active_time', time() );
    }
    
    $daysinseconds = 259200; // 3 Days in seconds.
   
    if( 'yes' == $maybe_later ) {
        $daysinseconds = 604800 ; // 7 Days in seconds.
    }

    if ( time() - $activation_time > $daysinseconds ) {
        add_action( 'admin_notices' , 'gsyoutubegalleries_review_notice_message' );
    }
}
add_action( 'admin_init', 'gsyoutubegalleries_review_notice' );

/**
 * For the notice preview.
 */
function gsyoutubegalleries_review_notice_message(){
    $scheme      = (parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY )) ? '&' : '?';
    $url         = $_SERVER['REQUEST_URI'] . $scheme . 'gsyoutubegalleries_review_dismiss=yes';
    $dismiss_url = wp_nonce_url( $url, 'gsyoutubegalleries-review-nonce' );

    $_later_link = $_SERVER['REQUEST_URI'] . $scheme . 'gsyoutubegalleries_review_later=yes';
    $later_url   = wp_nonce_url( $_later_link, 'gsyoutubegalleries-review-nonce' );
    ?>
    
    <div class="gslogo-review-notice">
        <div class="gslogo-review-thumbnail">
            <img src="<?php echo GSYOUTUBEGALLERIES_FILES_URI . '/assets/css/icon-128x128.png'; ?>" alt="">
        </div>
        <div class="gslogo-review-text">
            <h3><?php _e( 'Leave A Review?', 'gstwf' ) ?></h3>
            <p><?php _e( 'We hope you\'ve enjoyed using <b>GS Videos for YouTube</b>! Would you consider leaving us a review on WordPress.org?', 'gstwf' ) ?></p>
            <ul class="gslogo-review-ul">
                <li>
                    <a href="https://wordpress.org/support/plugin/gs-youtube-gallery/reviews/" target="_blank">
                        <span class="dashicons dashicons-external"></span>
                        <?php _e( 'Sure! I\'d love to!', 'gstwf' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $dismiss_url ?>">
                        <span class="dashicons dashicons-smiley"></span>
                        <?php _e( 'I\'ve already left a review', 'gstwf' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $later_url ?>">
                        <span class="dashicons dashicons-calendar-alt"></span>
                        <?php _e( 'Maybe Later', 'gstwf' ) ?>
                    </a>
                </li>
                <li>
                    <a href="https://gsplugins.com/support/" target="_blank">
                        <span class="dashicons dashicons-sos"></span>
                        <?php _e( 'I need help!', 'gstwf' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $dismiss_url ?>">
                        <span class="dashicons dashicons-dismiss"></span>
                        <?php _e( 'Never show again', 'gstwf' ) ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <?php
}

/**
 * For Dismiss! 
 */
function gsyoutubegalleries_review_dismiss(){

    if ( ! is_admin() ||
        ! current_user_can( 'manage_options' ) ||
        ! isset( $_GET['_wpnonce'] ) ||
        ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'gsyoutubegalleries-review-nonce' ) ||
        ! isset( $_GET['gsyoutubegalleries_review_dismiss'] ) ) {

        return;
    }

    add_site_option( 'gsyoutubegalleries_review_dismiss', 'yes' );   
}

/**
 * For Maybe Later Update.
 */
function gsyoutubegalleries_review_pending() {

    if ( ! is_admin() ||
        ! current_user_can( 'manage_options' ) ||
        ! isset( $_GET['_wpnonce'] ) ||
        ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'gsyoutubegalleries-review-nonce' ) ||
        ! isset( $_GET['gsyoutubegalleries_review_later'] ) ) {

        return;
    }
    // Reset Time to current time.
    update_site_option( 'gsyoutubegalleries_active_time', time() );
    update_site_option( 'gsyoutubegalleries_maybe_later', 'yes' );

}

/**
 * Remove Reviews Metadata on plugin Deactivation.
 */
function gsyoutubegalleries_deactivate() {
    delete_option('gsyoutubegalleries_active_time');
    delete_option('gsyoutubegalleries_maybe_later');
}
register_deactivation_hook(__FILE__, 'gsyoutubegalleries_deactivate');
