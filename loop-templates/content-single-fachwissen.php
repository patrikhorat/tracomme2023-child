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

//Get Meta Value File Link
$fachwissen_file = get_post_meta($post->ID, 'fachwissen_file', true);
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<div id="fachwissen-single-header-wrapper" class="entry-image-wrapper">
			<div class="fachwissen-single-header-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'fachwissen-archive-image' ); ?>)";>
				<div class="fachwissen-single-image-overlay"></div>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div id="fachwissen-single-content-wrapper" class="entry-content">
		
		<div class="entry-meta fachwissen-single-header-info-wrapper">
			<div class="fachwissen-single-header-meta-infobox">
				<div class="fachwissen-single-header-meta-info">
					<div class="fachwissen-tag-single-page"><a href="/<?php echo $archive_link; ?>" title="<?php echo $archive_title; ?>"><?php echo $archive_title; ?></a>
					</div>
					<div class="fachwissen-single-header-meta-info">
						<?php the_title( '<h1 class="entry-title fachwissen-single-h1-title">', '</h1>' ); ?>
					</div>
					<div class="fachwissen-tag-single-page"><a href="<?php echo $fachwissen_file; ?>" title="<?php esc_attr_e( 'Download PDF', 'tracomme2023-child' ); ?>"><?php esc_attr_e( 'Download Article', 'tracomme2023-child' ); ?></a>
					</div>
				</div>
			</div>
		</div><!-- .entry-meta -->

		<div class="sharethis-container margin-bottom-50 sharethiscenter">
		<div class="sharethis-inline-share-buttons"></div>
		</div>
		
		<?php
		the_content();
		?>
		<div class="margin-bottom-50"></div>
	</div><!-- .entry-content -->

	

</article><!-- #post-## -->
