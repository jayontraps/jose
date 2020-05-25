<?php
/*
	Template Name: calendar page
*/

get_header(); ?>

<div id="content" class="content post-<?php the_ID(); ?>">
	
  <?php include 'inc/fullscreen-images.php'; ?>

  <main id="main" class="site-main content_wrap" role="main">

	  <?php while ( have_posts() ) : the_post(); ?>
	    <div id="post-<?php the_ID(); ?>">	        
			  <article id="post-<?php the_ID(); ?>" <?php post_class('item-content'); ?>>
				  <header class="entry-header">
					  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				  </header><!-- .entry-header -->
				  <span class="brd-line"></span>

				  <div class="entry-content">  					

				    <ul class="calendar_list">

	          <?php 
	            $temp = $wp_query; 
              $wp_query = null; 
              $wp_query = new WP_Query(); 

              $today = date('Ymd');

              $args = array (			
                'post_type' => 'events',
                'posts_per_page' => 10,
                'paged' => $paged,
                'cat' => -4,	
                'meta_key' => 'start_date', // name of custom field
                'orderby' => 'meta_value_num',
                'order' => 'ASC'		    
              );

              $wp_query->query($args); 
              while ($wp_query->have_posts()) : $wp_query->the_post(); 
            ?>

            <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php 
              $start_date = get_field('start_date');
              // $start_date = 19881123 (23/11/1988)
              // extract Y,M,D
              $y = substr($start_date, 0, 4);
              $m = substr($start_date, 4, 2);
              $d = substr($start_date, 6, 2);

              // create UNIX
              $time = strtotime("{$d}-{$m}-{$y}");

              // format date (23/11/1988)
              $start_full = date('jS M Y', $time);
              $start_part = date('jS M', $time);



              // if range of dates
              if(get_field('end_date')) {
                $end_date = get_field('end_date');
                // $end_date = 19881123 (23/11/1988)
                // extract Y,M,D
                $end_y = substr($end_date, 0, 4);
                $end_m = substr($end_date, 4, 2);
                $end_d = substr($end_date, 6, 2);

                // create UNIX
                $end_time = strtotime("{$end_d}-{$end_m}-{$end_y}");

                // format date (23/11/1988)
                $end_res = date('jS M Y', $end_time);


                echo '<span class="date meta_grid">' . $start_part . ' - '. $end_res . '</span>';
              } else {
                echo '<span class="date meta_grid">' . $start_full . '</span>';
              }
            ?>		
            <?php if (get_field('location')) : ?> 	
              <span class="location meta_grid"> - <?php the_field('location'); ?></span>
            <?php endif; ?>

            <?php if (get_field('description')) : ?> 	
              <div class="description"><?php the_field('description'); ?></div>
            <?php endif; ?>	
          </li>

            <?php endwhile; ?>

          </ul>

          <span class="brd-line"></span>

          <?php /* Display navigation to next/previous pages when applicable */ ?>
          <?php if ( function_exists('jose_pagination') ) { jose_pagination(); } else if ( is_paged() ) { ?>
            <nav id="post-nav">
              <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'jose' ) ); ?></div>
              <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
            </nav>
          <?php } ?>


          <?php 
            $wp_query = null; 
            $wp_query = $temp;  // Reset
            wp_reset_postdata();
          ?>		

				</div><!-- .entry-content -->
			</article><!-- #post-## -->
		</div>

	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->


<?php get_footer(); ?>
