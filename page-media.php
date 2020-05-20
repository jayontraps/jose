<?php
/*
	Template Name: media page
*/

get_header(); ?>
	
  <main id="main" class="media_list" role="main">

	  <?php while ( have_posts() ) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('item-content'); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<span class="brd-line"></span>

		<div class="entry-content">	

		<?php while( have_rows('media_item') ): the_row(); 
			// vars
			$media_embed_code = get_sub_field('media_embed_code');
			$media_title = get_sub_field('media_title');
			$media_description = get_sub_field('media_description');
			$media_meta = get_sub_field('media_meta');
			$media_co = get_sub_field('media_company');
		?>
		
			<div class="Media">		
				
				<div class="media-col Media_video">				
					<iframe data-src="<?php echo $media_embed_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="630" height="357" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>				
								

        <div class="media-col">				
          <span class="brd-line"></span>					
          <h3 class="Media_title"><?php echo $media_title; ?></h3>
          <?php if( $media_co ): ?>
          <h4 class="Media_co"><?php echo $media_co; ?></h4>
          <?php endif; ?>

          <?php if( $media_meta ): ?>
          <div class="Media_meta"><?php echo $media_meta; ?></div>
          <?php endif; ?>				

          <?php if( $media_description ): ?>
          <div class="Media_description"><?php echo $media_description; ?></div>
          <?php endif; ?>						
          </div>		
        </div>

		<?php endwhile; ?>

		</div>

	</article>

	

	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->


<?php get_footer(); ?>
