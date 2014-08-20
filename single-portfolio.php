<?php
/**
 * The template for displaying all single portfolio items.
 *
 * @package jose
 */

get_header(); ?>


	<main id="main" class="site-main content_wrap" role="main">
	
	<?php if ( has_post_thumbnail() ) : ?>

		<?php // the_post_thumbnail(); 
			$large_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );			
		?>
		<div class="hero">
			<img src="<?php echo $large_image_url; ?>">
		</div>

	<?php endif; ?>



	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php jose_post_nav(); ?>
		
	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->



<?php get_footer(); ?>