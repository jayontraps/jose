<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package jose
 */
?>


<div class="grid">
    <div id="post-<?php the_ID(); ?>" class="col-1-2">
        <!-- <div class="item-content">
 -->

		<article id="post-<?php the_ID(); ?>" <?php post_class('item-content'); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<span class="brd-line"></span>

			<div class="entry-content">
				<?php the_content(); ?>


				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'jose' ),
						'after'  => '</div>',
					) );
				?>

			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div>
</div>