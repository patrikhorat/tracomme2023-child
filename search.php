<?php
/**
 * The template for displaying search results pages
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'tracomme2023_container_type' );

?>

<div class="wrapper" id="search-wrapper">
	<div class="shrinkstart"></div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main search-maincontent" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">

							<h1 class="page-title">
								<?php
								printf(
									/* translators: %s: query term */
									esc_html__( 'Search Results for: %s', 'tracomme2023-child' ),
									'<span>' . get_search_query() . '</span>'
								);
								?>
							</h1>

					</header><!-- .page-header -->
					<h2 class="page-subtitle"><?php	printf( esc_html__( 'Did not find what you were looking for? Please contact us', 'tracomme2023-child' ),);?></h2>
					<div class="search-bar-search-page">
						<?php get_search_form(); ?>
					</div>
					<?php /* Start the Loop */ ?>
					<?php
					while ( have_posts() ) :
						the_post();

						/*
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', 'search' );
					endwhile;
					?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>
				<?php
				// Display the pagination component.
				tracomme2023_pagination();

				?>
			</main>


			<div class="teaser-box">
				<?php 	// Get the Content Box for Footer in correct language or German
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
			</div><!-- .row -->
	</div><!-- #content -->

</div><!-- #search-wrapper -->

<?php
get_footer();
