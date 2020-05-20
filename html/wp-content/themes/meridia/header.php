<?php

/**
 * Header template file.
 *
 * @package Meridia
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
$header_type = ( isset( $_GET['meridia_header'] ) ? $_GET['meridia_header'] : 'type-1' );
$header_type_setting = get_theme_mod( 'meridia_header_type', 'header-type-1' );
?>
<!DOCTYPE html>
<html <?php 
language_attributes();
?>>
<head>
		
 	<?php 
meridia_head_top();
?>
	<meta charset="<?php 
bloginfo( 'charset' );
?>">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php 
wp_head();
?>
	<?php 
meridia_head_bottom();
?>
</head>

<body <?php 
body_class();
?> itemscope itemtype="http://schema.org/WebPage">

	<?php 
wp_body_open();
?>
	
	<?php 
meridia_preloader();
?>

	<?php 
meridia_header_before();
?>

	<?php 

if ( MERIDIA_PRODUCTION ) {
    if ( meridia_fs()->is_free_plan() ) {
        if ( 'header-type-1' == $header_type_setting ) {
            get_template_part( 'template-parts/header/header-1' );
        }
    }
} else {
    if ( meridia_fs()->is_free_plan() ) {
        
        if ( 'type-1' == $header_type ) {
            set_theme_mod( 'meridia_header_type', 'header-type-1' );
            get_template_part( 'template-parts/header/header-1' );
        }
    
    }
}

?>

	<?php 
meridia_header_after();
?>

	<main id="site-content" class="main oh" role="main">