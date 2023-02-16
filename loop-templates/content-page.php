<?php
/**
 * Partial template for content in page.php
 *
 * @package Tracomme2023
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<?php
		the_content();
		tracomme2023_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php tracomme2023_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
