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
	<div class="newsevents-wrapper">
		<div class="newsevents-vorschaubild">
			<?php echo '<a href="'.esc_url( get_permalink() ).'" rel="bookmark">'; ?>
			<?php echo get_the_post_thumbnail( $post->ID, 'newsevents-archive-image' ); ?>
			<?php echo '</a>'; ?>
		</div>
		<div class="newsevents-preview">
			<div class="newsevents-preview-content">
				<header class="entry-header">
				<div class="newsevents-date"><?php echo get_the_date(); ?></div>
				<?php
				the_title(
					sprintf( '<h3 class="newsevents-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h3>'
				);
				?>
				</header><!-- .entry-header -->
				<div class="newsevents-excerpt">
					<?php
					the_excerpt();
					?>
				</div>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-## -->
