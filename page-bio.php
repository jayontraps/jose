<?php
/*
	Template Name: bio page
*/

get_header(); ?>

  <main id="main" class="main about" role="main">  
    <?php while ( have_posts() ) : the_post(); ?>  
    
    <div class="about_profile">
      <div class="about_description company">
        <header class="entry-header">        
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>		
        </header>
        <span class="brd-line"></span>
        <div class="company_content"><?php the_content(); ?></div>
      </div>
    </div>
      
    
    
    <?php while( have_rows('profiles') ): the_row(); 
      $title = get_sub_field('title');
      $content = get_sub_field('content');
      $image = get_sub_field('image');
      $image_credit = get_sub_field('image_credit');         
    ?>
    
      <div class="about_profile">
        <div class="about_description">
          <header class="entry-header">          
          <?php if( $title ): ?>      
            <h2 class="about_title"><?php echo $title; ?></h2>			
          <?php endif; ?>
          </header>      
          <?php if( $content ): ?>      
            <?php echo $content; ?>
          <?php endif; ?>
        </div>
        <div class="about_image">
          <?php if( !empty( $image ) ): ?>
            <img class="profile_pic" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <?php endif; ?>
                  
          <?php if( $image_credit ): ?>
            <div class="credits">
              <span>Image credit: </span><?php echo $image_credit ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    
    <?php endwhile; ?>


    

		
	  <?php endwhile; // end of the loop. ?>
  </main><!-- #main -->


<?php get_footer(); ?>
