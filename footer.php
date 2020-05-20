<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package jose
 */
?>

  </div><!-- #content.content -->

  <?php include "inc/mailchimp-signup.php"; ?>
	
  <footer id="colophon" class="cf" role="contentinfo">			
    <?php // jose_footer_nav(); ?>
    <div class="site-footer cf">
      <div class="footer-details"><?php // echo date('Y'); ?> &copy; Agudo Dance Company 12450230</div>
      
    </div>		
  </footer>
   	
	
	</div><!-- #page.wrapper -->

<?php wp_footer(); ?>

</body>
</html>
