<?php
/*
	Template Name: work index page
*/

get_header(); ?>


	<main id="main" class="site-main content_wrap" role="main">

		<?php // while ( have_posts() ) : the_post(); ?>
		<?php // endwhile; // end of the loop. ?>

		<ul class="nav">
		<?php 	
			$my_query = new WP_Query(array( 
				'post_type' => 'portfolio', 
				'posts_per_page' => 8,
				'orderby' => 'meta_value_num',
				'order' => 'ASC' 
				));

			while ($my_query->have_posts()) : $my_query->the_post(); ?>

				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

		<?php endwhile; 

		// wp_reset_query();

		?>

		</ul>			

	</main><!-- #main -->


<?php get_footer(); ?>
