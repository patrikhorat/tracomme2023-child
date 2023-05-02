<?php
/**
 * Single post partial template
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//Get post type    
$post_type = get_post_type();
$post_type_obj = get_post_type_object( get_post_type() );

//Get post type's label
$archive_title = apply_filters('post_type_archive_title', $post_type_obj->labels->name );
$archive_link = apply_filters('get_post_type_archive_link', $post_type );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<div id="eventsexpertise-single-header-wrapper" class="entry-image-wrapper">
			<div class="eventsexpertise-single-header-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'eventsexpertise-single-image' ); ?>)";>
				<div class="eventsexpertise-single-image-overlay"></div>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div id="eventsexpertise-single-content-wrapper" class="entry-content">
		
		<div class="entry-meta eventsexpertise-single-header-info-wrapper">
			<div class="eventsexpertise-single-header-meta-infobox">
				<div class="eventsexpertise-single-header-meta-info">
					<div class="eventsexpertise-tag-single-page"><a href="/<?php echo $archive_link; ?>" title="<?php echo $archive_title; ?>"><?php echo $archive_title; ?></a>
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
