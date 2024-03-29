<?php
/**
 * Partial template for content in page.php
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<?php
		the_content();
		tracomme2023_link_pages();
		?>

	</div><!-- .entry-content -->
	<div class="teaser-box">
		<?php 	// Get the Content Box for Teaser in correct language or German
		$my_current_lang = apply_filters( 'wpml_current_language', NULL );
		if ($my_current_lang == "de") {
			$contentbox = get_page_by_path( 'teaser-newsevents', '', 'content-boxen' );
		}
		else if ($my_current_lang == "en")
		{
			$contentbox = get_page_by_path( 'teaser-newsevents-en', '', 'content-boxen' );
		}
		else {
			$contentbox = get_page_by_path( 'teaser-newsevents', '', 'content-boxen' );
		}
		$contentboxid = $contentbox->ID;
		$post_contentbox = get_post($contentboxid);
		$content_contentbox = $post_contentbox->post_content;
		echo do_shortcode($content_contentbox);
		?>
	</div>


</article><!-- #post-<?php the_ID(); ?> -->
