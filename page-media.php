<?php
/*
	Template Name: media page
*/

get_header(); ?>
	
  <main id="main" class="media_list" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
    
    <?php get_template_part( 'content', 'page' ); ?>
	

				
		<div class="entry-content">	

      <?php while( have_rows('media_item') ): the_row(); 
        // vars
        $media_embed_code = get_sub_field('media_embed_code');
        $media_title = get_sub_field('media_title');
        $media_description = get_sub_field('media_description');
        $media_meta = get_sub_field('media_meta');
        $media_co = get_sub_field('media_company');
        $music_credit = get_sub_field('music_credit');
        $image = get_sub_field('thumbnail');
      ?>
      
        <div class="Media">		
                    				                  
          <div class="media-col Media_content">		
            
            <?php if (is_page( "media" )): ?>
              <span class="brd-line"></span>	            
            <?php endif; ?>

            <div class="flex-item">
              <?php if( !empty( $image ) ): ?>
                <img class="Media_thumbnail" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              <?php endif; ?>			
              <h3 class="Media_title"><?php echo $media_title; ?></h3>
            </div>            

            <?php if( $media_co ): ?>
            <h4 class="Media_co"><?php echo $media_co; ?></h4>
            <?php endif; ?>
            <?php if( $music_credit ): ?>
            <h4 class="Media_co"><?php echo $music_credit; ?></h4>
            <?php endif; ?>
            <?php if( $media_meta ): ?>
            <div class="Media_meta"><?php echo $media_meta; ?></div>
            <?php endif; ?>				
            <?php if( $media_description ): ?>
            <div class="Media_description"><?php echo $media_description; ?></div>
            <?php endif; ?>						
          </div>

          <div class="media-col Media_video">				
            <iframe data-src="<?php echo $media_embed_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="630" height="357" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
          </div>

        </div>

      <?php endwhile; ?>
      

    </div>
    
    
    <div id="challenge-contact-form" class="contact">
      <?php if (is_page( "adc-dance-challenge" )): ?>
        <?php echo do_shortcode( '[contact-form-7 id="761" title="ADC Dance Challenge"]' ); ?>
        <div class="logo-grid">
          <img src="http://www.joseagudo.co.uk/wp-content/uploads/2020/05/lottery_Logo_Black_RGB_royasy.jpg" alt="looery logo" />          
          <img src="http://www.joseagudo.co.uk/wp-content/uploads/2020/05/Croydon_Council_P260_copy_c9vwls.jpg" alt="Croyon council logo" />
          <img src="http://www.joseagudo.co.uk/wp-content/uploads/2020/05/Logo___The_Yoga_Edge_z954xs.png" alt="the Yoga Edge logo" class="square" />
        </div>
      <?php endif; ?> 
    </div>
	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->


<?php get_footer(); ?>
