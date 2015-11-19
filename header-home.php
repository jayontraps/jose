<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package jose
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="MY7rMCG8q_9269Vc1Qe7ei_qLOOhhnf_1RsDnv-s0qI" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script>
// Picture element HTML5 shiv
document.createElement( "picture" );
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/plugins/picturefill.min.js" async></script>

</head>

<?php
	// add class of light or dark to body
	$class = get_post_meta( $post->ID, "body_class", true );
?>
<body <?php body_class($class); ?>>
<div id="page" class="hfeed site wrapper">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'jose' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div>

<!-- 		<button id="navicon" class="menu-toggle"><?php // _e( 'Primary Menu', 'jose' ); ?></button>
 -->



 <svg id="navicon" class="menu-toggle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
<rect x="6" y="9" width="28" height="2"/>
<rect x="6" y="18" width="28" height="2"/>
<rect x="6" y="27" width="28" height="2"/>
</svg>




		<nav id="site-navigation" class="main-navigation" role="navigation">
			
			<?php 
				jose_primary_nav();
				// wp_nav_menu( array( 	
				// 				'theme_location' => 'primary' ) ); 
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->



	<?php 
	$fullscreen_image = get_field('fullscreen_image');
	$mobile_image = get_field('mobile_image');

	if( !empty($fullscreen_image) ): ?>

	    <div id="hero" class="hero" >
	        <picture>
	            <!--[if IE 9]><video style="display: none;"><![endif]-->
	            <source srcset="<?php echo $fullscreen_image['url']; ?>" alt="<?php echo $fullscreen_image['alt']; ?>" media="(min-width: 770px)">
	            <!--[if IE 9]></video><![endif]-->
	            <img srcset="<?php echo $mobile_image['url']; ?>" alt="<?php echo $mobile_image['alt']; ?>">
	        </picture>  
	    </div>

	<?php endif; ?>
	
	
	<div id="playBtn" style="display: none">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 40 40" enable-background="new 0 0 100 100" xml:space="preserve" preserveAspectRatio="xMinYMin meet" class="svg-content">

	<!-- viewBox="5.0 -10.0 100.0 135.0" -->

	<g id="Play">


<circle fill="none" stroke-width="1" stroke-miterlimit="10" cx="19.437" cy="19.725" r="18.291"/>

<polygon fill="none" stroke-width="1" stroke-miterlimit="10" points="12.5,7.924 32.067,19.222 12.5,30.519 "/>
<!-- points="83.5,42.667 268.926,149.723 83.5,256.777 " -->
<!-- 
		<circle fill="none"  stroke-width="1" stroke-miterlimit="10" cx="50" cy="49.998" r="47"/>
		<polygon fill="none" stroke-width="1" stroke-miterlimit="10" points="36,28 72,49.96 36,71.921  "/>

 -->
	</g>

</svg>





	</div>

	<div id="content" class="content">
