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
		<div id="eventsexpertise-single-header-wrapper" class="entry-image-wrapper">
			<div class="eventsexpertise-single-header-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'eventsexpertise-single-image' ); ?>)";>
				<div class="eventsexpertise-single-image-overlay"></div>
			</div>
	</header><!-- .entry-header -->

	<div id="eventsexpertise-single-content-wrapper" class="entry-content">
		
		<div class="entry-meta eventsexpertise-single-header-info-wrapper">
			<div class="eventsexpertise-single-header-meta-infobox">
				<div class="eventsexpertise-single-header-meta-info">
					<div class="eventsexpertise-tag-single-page"><a href="/eventsexpertise" title="News ???">News ???</a>
					</div>
					<div class="eventsexpertise-single-header-meta-info">
						<?php the_title( '<h1 class="entry-title eventsexpertise-single-h1-title">', '</h1>' ); ?>
					</div>
					<div class="eventsexpertise-single-header-meta-info">
						<?php echo '<div class="eventsexpertise-single-header-meta-info-author">';
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
