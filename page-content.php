<?php
/*
	Template Name: content page
*/

get_header(); ?>

<div id="content" class="content post-<?php the_ID(); ?>">

	<?php include "inc/fullscreen-images.php"; ?>

  <main id="main" class="site-main content_wrap news" role="main">

	  <?php while ( have_posts() ) : the_post(); ?>

		    <div id="post-<?php the_ID(); ?>" >

				<article id="post-<?php the_ID(); ?>" <?php post_class('item-content primary'); ?>>
					<header class="entry-header">
						<?php if(get_field('intro_title')): ?>
							<h1 class="entry-title"><?php echo get_field('intro_title') ?></h1>
						<?php endif; ?>
					</header><!-- .entry-header -->
					<span class="brd-line"></span>

					<div class="entry-content">

            <?php if (is_page( "workshops" )): ?>
              <?php if (get_field('embed_code_url')) : ?>
                <div class="videoHolder">
                  <iframe src="<?php echo get_field('embed_code_url') ?>?title=0&amp;byline=0&amp;portrait=0" width="630" height="357" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
              <?php endif; ?>
						<?php endif; ?>

						<?php if(get_field('intro')){
							echo get_field('intro');
						} ?>

						<?php if(get_field('more')): ?>
						    <div id="readMore" class="more-link">Read more &raquo;
						    	<?php // include "inc/inc.svgarrow.php"; ?>
							</div>
            <?php endif; ?>

            <?php if(get_field('more')): ?>
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
            <?php endif; ?>

						<?php if (is_page( 'contact' )) { include "inc/inc-contact-actions.php"; } ?>

						<?php
							if (is_page( "workshops" )) {
								get_template_part( 'content', 'workshops' );
							}
						?>

					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>


	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->


<?php get_footer(); ?>
