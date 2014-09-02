<?php
/**
 * The template for displaying all single portfolio items.
 *
 * @package jose
 */

get_header(); ?>


<?php include 'inc/fullscreen-images.php'; ?>


<main id="main" class="site-main content_wrap" role="main">

<?php while ( have_posts() ) : the_post(); ?>

    <div class="grid">
        <div class="col-1-2">
            <div class="item-content">

                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<?php if (get_field('embed_code_url')) : ?>
						<div class="videoHolder">
							<iframe src="<?php echo get_field('embed_code_url') ?>?title=0&amp;byline=0&amp;portrait=0" width="630" height="357" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								
						</div>				
					<?php endif; ?>

<!--                 <div class="videoHolder">
                    <img src="images/KI_video.png">
                </div> -->
                
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
   					
                    <!--                     
                    <p>          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.2" baseProfile="tiny" x="0px" y="0px" width="9px" height="12px" viewBox="-0.198 -0.811 9 12" overflow="visible" xml:space="preserve" class="svg replaced-svg">
                    <defs>
                    </defs>
                    <polygon fill="#9A9A9A" points="0,0 0,11.064 7.877,5.532 "></polygon>
                    </svg> READ MORE</p>
                    -->
                    
                </div>                    
            </div>                    
        </div>
    </div>



	<?php jose_post_nav(); ?>
	
<?php endwhile; // end of the loop. ?>

</main><!-- #main -->



<?php get_footer(); ?>