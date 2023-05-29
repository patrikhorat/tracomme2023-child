<?php
/**
 * The template for displaying all single posts
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'tracomme2023_container_type' );
?>

<div class="wrapper single-newsevents-page" id="page-wrapper">
	<div class="shrinkstart"></div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">
		
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'loop-templates/content', 'single-news-events' );
				?>
				<?php	
			}
			?>

		</main><!-- #main -->
		<div class="teaser-box">
			<?php 	// Get the Content Box for Teaser in correct language or German
			$my_current_lang = apply_filters( 'wpml_current_language', NULL );
			if ($my_current_lang == "de") {
				$contentbox = get_page_by_path( 'teaser-newsevents-single', '', 'content-boxen' );
			}
			else if ($my_current_lang == "en")
			{
				$contentbox = get_page_by_path( 'teaser-newsevents-single-en', '', 'content-boxen' );
			}
			else {
				$contentbox = get_page_by_path( 'teaser-newsevents-single', '', 'content-boxen' );
			}
			$contentboxid = $contentbox->ID;
			$post_contentbox = get_post($contentboxid);
			$content_contentbox = $post_contentbox->post_content;
			echo do_shortcode($content_contentbox);
			?>
		</div>

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
