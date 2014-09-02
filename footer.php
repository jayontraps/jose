<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package jose
 */
?>

	</div><!-- #content -->


	<footer id="colophon" class="cf" role="contentinfo">

		<?php // jose_footer_nav(); ?>
		
		<div class="site-footer cf">
			<?php if(get_field('image_credits')): ?>
				<div class="credits"><span>Image credit: </span><?php echo get_field('image_credits') ?></div>
			<?php endif; ?>
		</div>
		

	</footer>
	

	
	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
