<?php
/*
	Template Name: news page
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
		        <!-- <div class="item-content">
		 -->

				<article id="post-<?php the_ID(); ?>" <?php post_class('item-content'); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
					<span class="brd-line"></span>

					<div class="entry-content">
						<?php the_content(); ?>

						<?php if(get_field('gallery_intro')): ?>
		                    <div class="more-link">Read more 
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.2" baseProfile="tiny" x="0px" y="0px" width="9px" height="12px" viewBox="-0.198 -0.811 9 12" overflow="visible" xml:space="preserve" class="svg replaced-svg">
								<defs>
								</defs>
								<polygon fill="#9A9A9A" points="0,0 0,11.064 7.877,5.532 "></polygon>
								</svg>
		                	</div>			
		                <?php endif; ?>	
		                                     

	                   

					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>
		</div>

	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->


<?php get_footer(); ?>
