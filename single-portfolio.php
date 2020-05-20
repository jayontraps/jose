<?php
/**
 * The template for displaying all single portfolio items.
 *
 * @package jose
 */

get_header(); ?>

  <div id="content" class="content post-<?php the_ID(); ?>">

  <?php include 'inc/fullscreen-images.php'; ?>

    <main id="main" class="site-main content_wrap" role="main">
	    <?php while ( have_posts() ) : the_post(); ?>
      <div class="item-content">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          <?php if (get_field('embed_code_url')) : ?>
            <div class="videoHolder">
              <iframe src="<?php echo get_field('embed_code_url') ?>?title=0&amp;byline=0&amp;portrait=0" width="630" height="357" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>								
            </div>				
          <?php endif; ?>
          
          <div class="item-details">
            <?php if( have_rows('credentials') ): ?>
            <ul class="credentials">
              <?php while( have_rows('credentials') ): the_row(); 
              // vars
              $role = get_sub_field('role');
              $name = get_sub_field('name');
              ?>
                <li>
                  <?php if( $role ): ?>
                    <span class="cred_role"><?php echo $role; ?>: </span>
                  <?php endif; ?>
                  <?php if( $name ): ?>
                    <span class="cred_name"><?php echo $name; ?></span>
                  <?php endif; ?>
                </li>
              <?php endwhile; ?>
            </ul>
            <?php endif; ?>  
            <?php the_content(); ?>   					                                       
          </div>                    
      </div>                    

	<?php jose_post_nav(); ?>
	
  <?php endwhile; // end of the loop. ?>

</main><!-- #main -->



<?php get_footer(); ?>