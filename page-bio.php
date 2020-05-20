<?php
/*
	Template Name: bio page
*/

get_header(); ?>

  <main id="main" class="main" role="main">  
    <?php while ( have_posts() ) : the_post(); ?>  
    
    <div class="main_image">
      <?php $mobile_image = get_field('mobile_image');
        if( !empty($mobile_image) ): ?>
        
        <img id="fullscreen-image" src="<?php echo $mobile_image['url']; ?>" alt="" >
        
        <?php if(get_field('image_credits')): ?>
          <div class="credits">
            <span>Image credit: </span><?php echo get_field('image_credits') ?>
          </div>
        <?php endif; ?>            
      <?php endif; ?>
    </div>

    <div class="main_content">
      <?php get_template_part( 'content', 'page' ); ?>
    </div>    
	 
		
	  <?php endwhile; // end of the loop. ?>
  </main><!-- #main -->


<?php get_footer(); ?>
