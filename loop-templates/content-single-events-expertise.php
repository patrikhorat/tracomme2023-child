<?php
/**
 * Single post partial template
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<div id="news-single-header-wrapper" class="entry-image-wrapper">
			<div class="news-single-header-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'news-single-image' ); ?>)";>
				<div class="news-single-image-overlay"></div>
			</div>
	</header><!-- .entry-header -->

	<div id="news-single-content-wrapper" class="entry-content">
		
		<div class="entry-meta news-single-header-info-wrapper">
			<div class="news-single-header-meta-infobox">
				<div class="news-single-header-meta-info">
					<div class="news-tag-single-page"><a href="/news" title="News">News</a>
					</div>
					<div class="news-single-header-meta-info">
						<?php the_title( '<h1 class="entry-title news-single-h1-title">', '</h1>' ); ?>
					</div>
					<div class="news-single-header-meta-info">
						<?php echo '<div class="news-single-header-meta-info-author">';
						esc_attr_e( 'Published on', 'tracomme2023-child' );
						echo ' ';
						echo get_the_date();
						echo '</div>';
						?>
					</div>
				</div>
			</div>
		</div><!-- .entry-meta -->

		<div class="addthis-container margin-bottom-50">
			<div class="addthis_inline_share_toolbox"></div>
		</div>
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

	

</article><!-- #post-## -->
