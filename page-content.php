<?php
/*
	Template Name: content page
*/

get_header(); ?>
	
<?php 
$fullscreen_image = get_field('fullscreen_image');
$mobile_image = get_field('mobile_image');

if( !empty($fullscreen_image) ): ?>

    <div id="hero" class="hero">
        <picture>
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source srcset="<?php echo $fullscreen_image['url']; ?>" alt="<?php echo $fullscreen_image['alt']; ?>" media="(min-width: 770px)">
            <!--[if IE 9]></video><![endif]-->
            <img srcset="<?php echo $mobile_image['url']; ?>" alt="<?php echo $mobile_image['alt']; ?>">
        </picture>  
    </div>

<?php endif; ?>


<main id="main" class="site-main content_wrap news" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="grid">
		    <div id="post-<?php the_ID(); ?>" class="col-1-3">

				<article id="post-<?php the_ID(); ?>" <?php post_class('item-content primary'); ?>>
					<header class="entry-header">
						<?php if(get_field('intro_title')): ?>
							<h1 class="entry-title"><?php echo get_field('intro_title') ?></h1>
						<?php endif; ?>	

					</header><!-- .entry-header -->
					<span class="brd-line"></span>

					<div class="entry-content">
						<?php if(get_field('intro')){
							echo get_field('intro');
						} ?>	

						<?php if(get_field('more')): ?>
		                    <div id="readMore" class="more-link">More info &raquo;
		                    	<?php // include "inc/inc.svgarrow.php"; ?>
		                	</div>			
		                <?php endif; ?>	
		                                     	                  
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>


			<?php if(get_field('more')): ?>
				<div class="col-2-3">
					<div class="secondaryWrap">
						<article id="secondary-post" <?php post_class('item-content secondary'); ?>>
							<?php if(get_field('more_title')): ?>
								<header class="entry-header">							
									<h1 class="entry-title"><?php echo get_field('more_title') ?></h1>
								</header><!-- .entry-header -->
								<span class="brd-line"></span>
							<?php endif; ?>	

							
							<div>
								<?php if(get_field('more')){
									echo get_field('more');
								} ?>	
				                                     	                  
							</div>
						</article>
					</div>
				</div>

            <?php endif; ?>	






		</div><!-- .grid -->

	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->


<?php get_footer(); ?>
