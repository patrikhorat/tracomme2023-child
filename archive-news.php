<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tracomme2023
 */




// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'tracomme2023_container_type' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

				<main class="site-main" id="main">

					<?php
					if ( have_posts() ) {
						?>
						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							echo '<h2 class="page-subtitle">';
							esc_attr_e( 'News, Events, More', 'tracomme2023-child' );
							echo '</h2>';
							?>
							<div class="addthis-container margin-bottom-16 addthisleft">
								<div class="addthis_inline_share_toolbox"></div>
							</div>
						</header><!-- .page-header -->
						<?php  
						//Start the loop.
						while ( have_posts() ) {
							the_post();						
							/*
								* Include the Post-Format-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Format name) and that will be used instead.
								*/
							get_template_part( 'loop-templates/content', 'news' );
							
						}
					} else {
						get_template_part( 'loop-templates/content', 'none' );
					}
					?>

				</main><!-- #main -->
				<?php
				tracomme2023child_pagination();
				?>
			<div class="teaser-box">Hier kommt der Teaser!!!
			<?php 	// Get the Content Box
			/*
					$contentbox = get_page_by_title( 'Teaser Box - News Archiv', '', 'content-boxen' );
					$contentboxid = $contentbox->ID;
					$post_contentbox = get_post($contentboxid);
					$content_contentbox = $post_contentbox->post_content;
					echo do_shortcode($content_contentbox);
			*/
			?>
			</div>
		</div><!-- .row -->
	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
