<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'tracomme2023_container_type' );
?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

	<?php 	// Get the Content Box for the Forum Header
            $contentbox = get_page_by_title( 'Footer', '', 'content-boxen' );
            $contentboxid = $contentbox->ID;
            $post_contentbox = get_post($contentboxid);
            $content_contentbox = $post_contentbox->post_content;
            echo do_shortcode($content_contentbox);
    
	?>
	

	</div><!-- .container(-fluid) -->

</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

