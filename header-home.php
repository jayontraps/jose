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
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script>
// Picture element HTML5 shiv
document.createElement( "picture" );
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/picturefill.min.js" async></script>

</head>

<?php
	// add class of light or dark to body
	$class = get_post_meta( $post->ID, "body_class", true );
?>
<body <?php body_class($class); ?>>
<div id="page" class="hfeed site wrapper">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'jose' ); ?></a>

	<header id="masthead" class="site-header playVideo" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

<!-- 		<button id="navicon" class="menu-toggle"><?php // _e( 'Primary Menu', 'jose' ); ?></button>
 -->



<!--  
		<svg id="navicon" class="menu-toggle" 
		xmlns="http://www.w3.org/2000/svg" 
		xmlns:xlink="http://www.w3.org/1999/xlink" 
		width="40" height="40" 
		viewBox="0 0 40 40">

		<g id="icomoon-ignore">
			<line 
			stroke-width="1" x1="" y1="" x2="" y2="" 
			stroke="#449FDB" 
			opacity=""></line>
		</g>
			<path d="M32 18h-24c-1.104 0-2 0.896-2 2s0.896 2 2 2h24c1.106 0 2-0.896 2-2s-0.894-2-2-2zM8 14h24c1.106 0 2-0.896 2-2s-0.894-2-2-2h-24c-1.104 0-2 0.896-2 2s0.896 2 2 2zM32 26h-24c-1.104 0-2 0.894-2 2s0.896 2 2 2h24c1.106 0 2-0.894 2-2s-0.894-2-2-2z" fill="#ffffff"></path>
		</svg>



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

	    <div id="hero" class="hero" style="display: none">
	        <picture>
	            <!--[if IE 9]><video style="display: none;"><![endif]-->
	            <source srcset="<?php echo $fullscreen_image['url']; ?>" alt="<?php echo $fullscreen_image['alt']; ?>" media="(min-width: 770px)">
	            <!--[if IE 9]></video><![endif]-->
	            <img srcset="<?php echo $mobile_image['url']; ?>" alt="<?php echo $mobile_image['alt']; ?>">
	        </picture>  
	    </div>

	<?php endif; ?>


	<div id="content" class="content">
