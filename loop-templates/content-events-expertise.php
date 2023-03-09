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
	<div class="eventsexpertise-wrapper">
		<div class="eventsexpertise-vorschaubild">
			<?php echo '<a href="'.esc_url( get_permalink() ).'" rel="bookmark">'; ?>
			<?php echo get_the_post_thumbnail( $post->ID, 'eventsexpertise-archive-image' ); ?>
			<?php echo '</a>'; ?>
		</div>
		<div class="eventsexpertise-preview">
			<div class="eventsexpertise-preview-content">
				<header class="entry-header">
				<div class="eventsexpertise-date"><?php echo get_the_date(); ?></div>
				<?php
				the_title(
					sprintf( '<h3 class="eventsexpertise-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h3>'
				);
				?>
				</header><!-- .entry-header -->
				<div class="eventsexpertise-excerpt">
					<?php
					the_excerpt();
					?>
				</div>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-## -->
