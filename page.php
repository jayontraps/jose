<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package jose
 */

get_header(); ?>

<div id="content" class="content post-<?php the_ID(); ?>">	
  <?php include 'inc/fullscreen-images.php'; ?>
  <main id="main" class="site-main content_wrap" role="main">
	  <?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'page' ); ?>
	  <?php endwhile; // end of the loop. ?>
  </main><!-- #main -->
<?php get_footer(); ?>
