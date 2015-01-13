<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package jose
 */

// Pagination
function jose_pagination() {
	global $wp_query;
 
	$big = 999999999; // This needs to be an unlikely integer
 
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5,
		'prev_next' => True,
	    'prev_text' => __('&laquo;', 'jose'),
	    'next_text' => __('&raquo;', 'jose'),
		'type' => 'list'
	) );
 
	$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination nav'>", $paginate_links );
	$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'><a href='#'>", $paginate_links );
	$paginate_links = str_replace( "</span>", "</a>", $paginate_links );
	$paginate_links = preg_replace( "/\s*page-numbers/", "", $paginate_links );

	// Display the pagination if more than one page is found
	if ( $paginate_links ) {
		echo '<div class="pagination-centered">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}
}






if ( ! function_exists( 'jose_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function jose_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'jose' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'jose' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'jose' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'jose_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function jose_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<?php
		previous_post_link( '<div class="item_nav nav-previous">%link</div>', _x( '<span class="meta-nav"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" viewBox="0 0 60 60">
<g id="icomoon-ignore">
	<line stroke-width="1" x1="" y1="" x2="" y2="" stroke="#449FDB" opacity=""></line>
</g>
	<path d="M43.197 52.254c0.804 0.813 0.804 2.124 0 2.937s-2.103 0.813-2.907 0l-23.49-23.721c-0.804-0.813-0.804-2.127 0-2.937l23.49-23.724c0.804-0.813 2.103-0.813 2.907 0s0.804 2.124 0 2.937l-21.42 22.254 21.42 22.254z" class="blob"></path>
</svg></span>&nbsp;', 'Previous post link', 'jose' ) );

		next_post_link(     '<div class="item_nav nav-next">%link</div>',     _x( '&nbsp;<span class="meta-nav"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" viewBox="0 0 60 60">
<g id="icomoon-ignore">
	<line stroke-width="1" x1="" y1="" x2="" y2="" stroke="#449FDB" opacity=""></line>
</g>
	<path d="M16.799 52.254c-0.804 0.813-0.804 2.124 0 2.937s2.103 0.813 2.907 0l23.49-23.721c0.804-0.813 0.804-2.127 0-2.937l-23.49-23.724c-0.804-0.813-2.103-0.813-2.907 0s-0.804 2.124 0 2.937l21.42 22.254-21.42 22.254z" class="blob"></path>
</svg></span>', 'Next post link',     'jose' ) );
	?>

	<?php
}
endif;

if ( ! function_exists( 'jose_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function jose_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'jose' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'jose' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function jose_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'jose_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'jose_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so jose_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so jose_categorized_blog should return false.
		return false;
	}
}



// define primary menu
function jose_primary_nav() {
    if ( has_nav_menu( 'primary' ) ) {
	wp_nav_menu(
		array(
			'theme_location'  	=> 'primary',
			'container'       	=> 'div',
			'container_class' 	=> 'menu-primary-container',
			'menu_id'         	=> 'menu-primary',
			'menu_class'      	=> 'menu nav-menu cf',	
			'after'				=> '<span class="slant"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve"><rect x="-6.842" y="18.658" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -8.2841 20.0002)" width="53.686" height="1"/></svg></span>',		
			'depth'           	=> 1,
			'fallback_cb'     	=> '',
		)
	);
    }
}


// add footer menu
function jose_footer_nav() {
    if ( has_nav_menu( 'footer' ) ) {
	wp_nav_menu(
		array(
			'theme_location'  => 'footer',
			'container'       => 'div',
			'container_id'    => 'menu-footer',
			'container_class' => 'site-footer grid',
			'menu_id'         => 'menu-footer-items',
			'menu_class'      => 'nav',		
			'depth'           => 1,
			'fallback_cb'     => '',
		)
	);
    }
}




/**
 * Flush out the transients used in jose_categorized_blog.
 */
function jose_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'jose_categories' );
}
add_action( 'edit_category', 'jose_category_transient_flusher' );
add_action( 'save_post',     'jose_category_transient_flusher' );
