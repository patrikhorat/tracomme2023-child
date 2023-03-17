<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'tracomme2023_container_type' );
?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main">

					<div class="teaser-box">
						<?php 	// Get the Content Box for 404 in correct language or German
						$my_current_lang = apply_filters( 'wpml_current_language', NULL );
						if ($my_current_lang == "de") {
							$contentboxerror = get_page_by_path( '404-error-page', '', 'content-boxen' );
						}
						else if ($my_current_lang == "en")
						{
							$contentboxerror = get_page_by_path( '404-error-page-en', '', 'content-boxen' );
						}
						else {
							$contentboxerror = get_page_by_path( '404-error-page', '', 'content-boxen' );
						}
						$contentboxiderror = $contentboxerror->ID;
						$post_contentboxerror = get_post($contentboxiderror);
						$content_contentboxerror = $post_contentboxerror->post_content;
						echo do_shortcode($content_contentboxerror);
						?>
					</div>
					<div class="teaser-box">
						<?php 	// Get the Content Box for Teaser in correct language or German
						$my_current_lang = apply_filters( 'wpml_current_language', NULL );
						if ($my_current_lang == "de") {
							$contentbox = get_page_by_path( 'teaser-eventsexpertise', '', 'content-boxen' );
						}
						else if ($my_current_lang == "en")
						{
							$contentbox = get_page_by_path( 'teaser-eventsexpertise-en', '', 'content-boxen' );
						}
						else {
							$contentbox = get_page_by_path( 'teaser-eventsexpertise', '', 'content-boxen' );
						}
						$contentboxid = $contentbox->ID;
						$post_contentbox = get_post($contentboxid);
						$content_contentbox = $post_contentbox->post_content;
						echo do_shortcode($content_contentbox);
						?>
					</div>
				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
