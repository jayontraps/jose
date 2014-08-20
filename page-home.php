<?php
/*
	Template Name: home page
*/

get_header(); ?>

	<?php include 'inc/fullscreen-images.php'; ?>


	<main id="main" class="site-main content_wrap" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		
		<h1>this is the homepage</h1>

		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->



<?php get_footer(); ?>
