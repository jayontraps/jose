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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-166918160-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-166918160-1');
</script>

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

	<?php include "inc/logo-layer.php"; ?>

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'jose' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="inner-header">

			<div class="site_logo">
				
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg">	
					<h1 class="site-title">Jose Agudo</h1>			
				</a>
		
			</div>


			 <svg id="navicon" class="menu-toggle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
				<rect x="6" y="9" width="28" height="2"/>
				<rect x="6" y="18" width="28" height="2"/>
				<rect x="6" y="27" width="28" height="2"/>
			</svg>


			<nav id="site-navigation" class="main-navigation" role="navigation">			
				<?php jose_primary_nav(); ?>
			</nav>
			
		</div>

	</header>



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
			</g>

		</svg>

	</div>



	<div id="content" class="content">
