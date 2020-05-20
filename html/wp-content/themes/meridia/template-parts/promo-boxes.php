<?php
/**
 * Promo boxes
 *
 * @package 	Meridia
 * @since 		Meridia 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

$meridia_promo_show_setting = get_theme_mod( 'meridia_promo_show_settings', false );

if ( ! $meridia_promo_show_setting ) {
  return;
}

$meridia_promo = array(
  'image_1' => get_theme_mod( 'meridia_promo_image_upload_1' ),
  'image_2' => get_theme_mod( 'meridia_promo_image_upload_2' ),
  'image_3' => get_theme_mod( 'meridia_promo_image_upload_3' ),
  'text_1' => get_theme_mod( 'meridia_promo_text_1', esc_html__( 'Travel Guide', 'meridia' ) ),
  'text_2' => get_theme_mod( 'meridia_promo_text_2', esc_html__( 'Instagram', 'meridia' ) ),
  'text_3' => get_theme_mod( 'meridia_promo_text_3', esc_html__( 'Lifestyle', 'meridia' ) ),
  'url_1' => get_theme_mod( 'meridia_promo_url_1', esc_url( '#' ) ),
  'url_2' => get_theme_mod( 'meridia_promo_url_2', esc_url( '#' ) ),
  'url_3' => get_theme_mod( 'meridia_promo_url_3', esc_url( '#' ) ),
);
?>

<!-- Promo Boxes -->
<section class="section-wrap bottom-divider">
  <div class="container">
    <div class="row">

      <!-- Box 1 -->
      <div class="col-md-4">
        <a href="<?php echo esc_url( $meridia_promo['url_1'] ); ?>" class="promo-box">
          <?php if ( $meridia_promo['image_1'] ) : ?>
            <img src="<?php echo esc_url( $meridia_promo['image_1'] ); ?>" class="img-fw" alt="<?php echo esc_attr( $meridia_promo['text_1'] ); ?>">
          <?php endif; ?>
          <div class="promo-box__holder">
            <?php printf( "<h4 class='promo-box__text'>%s</h4>", esc_html( $meridia_promo['text_1'] ) ); ?>
          </div>
        </a>
      </div>

      <!-- Box 2 -->
      <div class="col-md-4">
        <a href="<?php echo esc_url( $meridia_promo['url_2'] ); ?>" class="promo-box">
          <?php if ( $meridia_promo['image_2'] ) : ?>
            <img src="<?php echo esc_url( $meridia_promo['image_2'] ); ?>" class="img-fw" alt="<?php echo esc_attr( $meridia_promo['text_2'] ); ?>">
          <?php endif; ?>
          <div class="promo-box__holder">
            <?php printf( "<h4 class='promo-box__text'>%s</h4>", esc_html( $meridia_promo['text_2'] ) ); ?>
          </div>
        </a>
      </div>

      <!-- Box 3 -->
      <div class="col-md-4">
        <a href="<?php echo esc_url( $meridia_promo['url_3'] ); ?>" class="promo-box">
          <?php if ( $meridia_promo['image_3'] ) : ?>
            <img src="<?php echo esc_url( $meridia_promo['image_3'] ); ?>" class="img-fw" alt="<?php echo esc_attr( $meridia_promo['text_3'] ); ?>">
          <?php endif; ?>
          <div class="promo-box__holder">
            <?php printf( "<h4 class='promo-box__text'>%s</h4>", esc_html( $meridia_promo['text_3'] ) ); ?>
          </div>
        </a>
      </div>

    </div>
  </div>
</section> <!-- end promo boxes -->