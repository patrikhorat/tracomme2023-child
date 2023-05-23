<?php
/**
 * Single post partial template
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$herstellerlink = get_post_meta(get_the_ID(), 'produkt_link_hersteller', TRUE);
$produkt_subtitle = get_post_meta(get_the_ID(), 'produkt_subtitle', TRUE);


?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

</header><!-- .entry-header -->

	<div id="produkte-single-content-wrapper" class="entry-content">
		<div class="produkte-single-image-and-title">
			<div class="produkte-single-image">
				<?php echo get_the_post_thumbnail( $post->ID, 'produkte-featured-image' ); ?>
			</div>
			<div class="produkte-single-title">
				<div class="produkte-single-title-text-content">
					<div class="addthis-container margin-bottom-16 addthisleft">
						<div class="addthis_inline_share_toolbox"></div>
					</div>
					<?php the_title( '<h1 class="entry-title produkte-single-h1-title">', '</h1>' ); ?>
					<?php 
					if( !empty( $produkt_subtitle) ) : ?><div class="product-subtitle"><?echo $produkt_subtitle;?></div><? endif; ?>
				</div>
			</div>
		</div>
		
		<div class="entry-meta produkte-single-header-info-wrapper">
			<div class="produkte-single-header-meta-infobox">
				<div class="produkte-single-header-meta-info">
					<?php 
						tracomme_get_the_term_buttons_extern( 'brand' );
						tracomme_get_the_term_buttons_intern( 'fachgebiete-hauptkategorie' );
						tracomme_get_the_term_buttons_intern( 'fachgebiete-unterkategorie' );
						tracomme_get_the_term_buttons_extern( 'productcategory' );
					?>
				</div>
			</div>
		</div><!-- .entry-meta -->


		<?php
		the_content();
		?>
		<div class="entry-meta produkte-single-header-info-wrapper">
			<div class="produkte-single-header-meta-infobox">
				<div class="produkte-single-header-meta-info">
					<div class="produkte-tag-single-page-larger"><a href="<?php echo $herstellerlink; ?>" target="_blank"><?php esc_attr_e( 'Product Page Manufacturer', 'tracomme2023-child' ); ?></a></div>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

	

</article><!-- #post-## -->
