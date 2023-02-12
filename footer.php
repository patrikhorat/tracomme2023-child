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

	<?php 	// Get the Content Box for Footer in correct language or German
            $my_current_lang = apply_filters( 'wpml_current_language', NULL );
            if ($my_current_lang == "de") {
                $contentbox = get_page_by_path( 'footer', '', 'content-boxen' );
            }
            else if ($my_current_lang == "en")
            {
                $contentbox = get_page_by_path( 'footer-en', '', 'content-boxen' );
            }
            else {
                $contentbox = get_page_by_path( 'footer', '', 'content-boxen' );
            }
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

