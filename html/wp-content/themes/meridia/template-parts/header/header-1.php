<?php

/**
 * @package Meridia
 * 
 * Header 1
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>


<?php 
meridia_fullscreen_search();
?>

<header class="nav nav-1" itemtype="http://schema.org/WPHeader" itemscope="itemscope" role="banner">
	<div class="nav__holder <?php 
if ( get_theme_mod( 'meridia_sticky_nav_settings', true ) ) {
    ?>nav--sticky<?php 
}
?>" >
		<div class="container-fluid container-semi-fluid relative">
			<div class="nav__flex-parent flex-parent">

				<!-- Nav-header -->
				<div class="flex-child nav__header clearfix">

					<!-- Logo -->
					<div class="flex-child logo-container" itemtype="http://schema.org/Organization" itemscope="itemscope">
						<a href="<?php 
echo  esc_url( home_url( '/' ) ) ;
?>" class="logo-url">
							<?php 

if ( get_theme_mod( 'meridia_logo_image_upload' ) ) {
    ?>
								<img src="<?php 
    echo  esc_url( get_theme_mod( 'meridia_logo_image_upload' ) ) ;
    ?>" srcset="<?php 
    echo  esc_url( get_theme_mod( 'meridia_logo_image_upload' ) ) . ' 1x' ;
    ?>, <?php 
    echo  esc_url( get_theme_mod( 'meridia_logo_retina_image_upload' ) ) . ' 2x' ;
    ?>" class="logo" alt="<?php 
    bloginfo( 'name' );
    ?>">
							<?php 
} else {
    ?>
								<?php 
    
    if ( display_header_text() ) {
        ?>
									<span class="site-title white"><?php 
        bloginfo( 'name' );
        ?></span>
									<?php 
        $meridia_tagline = get_bloginfo( 'description', 'display' );
        ?>
									<p class="site-tagline"><?php 
        echo  esc_html( $meridia_tagline ) ;
        ?></p>
								<?php 
    }
    
    ?>
							<?php 
}

?>
						</a>
					</div>

					<?php 
?>
					
					<?php 
meridia_mobile_menu_toggle();
?>

				</div> <!-- end nav-header -->
				
				<?php 
meridia_primary_navbar();
?>

				<!-- Socials / Search -->
				<div class="flex-child d-none d-lg-block">
					
					<?php 
if ( get_theme_mod( 'meridia_nav_search_show', true ) ) {
    ?>
						<!-- Search -->
						<div class="nav__search">
							<a href="#" class="nav__search-trigger">
								<i class="ui-search"></i>
							</a>           
						</div>
					<?php 
}
?>


					<?php 
?>

				</div>				

			</div> <!-- .flex-parent -->
		</div> <!-- .nav__container -->
	</div> <!-- .nav__holder -->
</header> <!-- .nav -->