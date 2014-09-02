<?php
/*
	Template Name: work index page
*/

get_header(); ?>

<?php include 'inc/fullscreen-images.php'; ?>


	<main id="main" class="site-main content_wrap" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" class="itemList">
			<ul>
			<?php 	
				$my_query = new WP_Query(array( 
					'post_type' => 'portfolio', 
					'posts_per_page' => 8,
					'orderby' => 'menu_order',
					'order' => 'ASC' 
					));

				while ($my_query->have_posts()) : $my_query->the_post(); ?>

					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

			<?php endwhile; 

				wp_reset_query();

			?>

			</ul>	
		</div><!-- .itemList -->	

	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->

	


<?php get_footer(); ?>
