<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="fachwissen-wrapper">
		<div class="fachwissen-vorschaubild">
			<?php //echo '<a href="'.esc_url( get_permalink() ).'" rel="bookmark">'; 
			$fachwissen_file = get_post_meta($post->ID, "fachwissen_file", true);
					echo '<a href="'.$fachwissen_file.'" rel="bookmark" target="_blank">'; 
			?>
			<?php echo get_the_post_thumbnail( $post->ID, 'fachwissen-archive-image' ); ?>
			<?php echo '</a>'; ?>
		</div>
		<div class="fachwissen-preview">
			<div class="fachwissen-preview-content">
				<header class="entry-header">
				<?php
				the_title(
					sprintf( '<h3 class="fachwissen-title"><a href="%s" rel="bookmark" target="_blank">', $fachwissen_file ),
					'</a></h3>'
				);
				?>
				</header><!-- .entry-header -->
				<div class="fachwissen-excerpt">
					<?php
					the_excerpt();
					?>
				</div>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-## -->
