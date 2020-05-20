<?php
/**
 * The template for displaying all single posts.
 *
 * @package jose
 */

get_header(); ?>

<div id="content" id="post-<?php the_ID(); ?>" class="content post-<?php the_ID(); ?>">

	<main id="main" class="site-main content_wrap" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php jose_post_nav(); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->


<?php get_footer(); ?>