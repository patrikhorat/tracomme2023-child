<?php
/**
 * Tracomme2023 Child Theme functions and definitions
 *
 * @package Tracomme2023Child
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function tracomme2023_remove_scripts() {
	wp_dequeue_style( 'tracomme2023-styles' );
	wp_deregister_style( 'tracomme2023-styles' );

	wp_dequeue_script( 'tracomme2023-scripts' );
	wp_deregister_script( 'tracomme2023-scripts' );
}
add_action( 'wp_enqueue_scripts', 'tracomme2023_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-tracomme2023-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-tracomme2023-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'tracomme2023-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function tracomme2023_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_tracomme2023_bootstrap_version', 'tracomme2023_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function tracomme2023_child_customize_controls_js() {
	wp_enqueue_script(
		'tracomme2023_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'tracomme2023_child_customize_controls_js' );


/* Add Additional Menus to Theme */
function register_childtheme_menus() {
	register_nav_menu('contact_menu', __( 'Contact Menu', 'tracomme2023-child' ));
	//register_nav_menu('language_menu', __( 'Language Menu', 'tracomme2023-child' ));
  }
  
  add_action( 'init', 'register_childtheme_menus' );



/* Button Colors Selection */  
add_action( 'vc_after_init', 'change_vc_button_colors' );
 
function change_vc_button_colors() {
	
	//Get current values stored in the color param in "Call to Action" element
		$param = WPBMap::getParam( 'vc_btn', 'color' );
	
	// Add New Colors to the 'value' array
	// btn-custom-1 and btn-custom-2 are the new classes that will be 
	// applied to your buttons, and you can add your own style declarations
	// to your stylesheet to style them the way you want.
		$param['value'][__( 'Tracomme Blue', 'tracomme2023-child' )] = 'btn-tracomme-blue';
		$param['value'][__( 'Tracomme Dark Blue', 'tracomme2023-child' )] = 'btn-tracomme-darkblue';
		$param['value'][__( 'Tracomme White', 'tracomme2023-child' )] = 'btn-tracomme-white';
		$param['value'][__( 'Tracomme Light Grey', 'tracomme2023-child' )] = 'btn-tracomme-lightgrey';
	
	// Remove any colors you don't want to use.
		unset($param['value']['Classic Grey']);
		unset($param['value']['Classic Blue']);
		unset($param['value']['Classic Turquoise']);
		unset($param['value']['Classic Green']);
		unset($param['value']['Classic Orange']);
		unset($param['value']['Classic Red']);
		unset($param['value']['Classic Black']);
		unset($param['value']['Blue']);
		unset($param['value']['Turquoise']);
		unset($param['value']['Pink']);
		unset($param['value']['Violet']);
		unset($param['value']['Peacoc']);
		unset($param['value']['Chino']);
		unset($param['value']['Mulled Wine']);
		unset($param['value']['Vista Blue']);
		unset($param['value']['Black']);
		unset($param['value']['Grey']);
		unset($param['value']['Orange']);
		unset($param['value']['Sky']);
		unset($param['value']['Green']);
		unset($param['value']['Juicy pink']);
		unset($param['value']['Sandy brown']);
		unset($param['value']['Purple']);
		unset($param['value']['White']);
	
	// Finally "update" with the new values
		vc_update_shortcode_param( 'vc_btn', $param );
}


/* News Image */
/* Image Size for "Online Artikel" Archive & Single Page */
add_image_size( 'news-archive-image', 960, 600, true );
add_image_size( 'news-single-image', 1920, 800, true );


// get rid of the “Category:”, “Tag:”, “Author:”, “Archives:” and “Other taxonomy name:”
function my_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'my_theme_archive_title' );


  /* Remove <p> tags from archive description */
  remove_filter('term_description','wpautop');
  remove_filter ('get_the_archive_description', 'wpautop');
  remove_filter('term_description','wpautop');
  remove_filter( 'the_content', 'wpautop' );
  remove_filter( 'the_content', 'wpautop' );
  remove_filter( 'the_excerpt', 'wpautop' );
  remove_filter('term_description','wpautop');


/* Create Shortcode for AddThis addthisshortcode */
 function addthisleft16_shortcode_func() { 
  
// HTML code für shortcode
return '<div class="addthis-container margin-bottom-16 addthisleft">
<div class="addthis_inline_share_toolbox"></div>
</div>';

}
// Register shortcode
add_shortcode('addthisleft16', 'addthisleft16_shortcode_func'); 

function addthiscenter16_shortcode_func() { 
	
// HTML code für shortcode
return '<div class="addthis-container margin-bottom-16">
<div class="addthis_inline_share_toolbox"></div>
</div>';
}
// Register shortcode
add_shortcode('addthiscenter16', 'addthiscenter16_shortcode_func'); 


// Child Theme Pagination
if ( ! function_exists( 'tracomme2023child_pagination' ) ) {
	/**
	 * Displays the navigation to next/previous set of posts.
	 *
	 * @param array  $args {
	 *     (Optional) Array of arguments for generating paginated links for archives.
	 *
	 *     @type string $base               Base of the paginated url. Default empty.
	 *     @type string $format             Format for the pagination structure. Default empty.
	 *     @type int    $total              The total amount of pages. Default is the value WP_Query's
	 *                                      `max_num_pages` or 1.
	 *     @type int    $current            The current page number. Default is 'paged' query var or 1.
	 *     @type string $aria_current       The value for the aria-current attribute. Possible values are 'page',
	 *                                      'step', 'location', 'date', 'time', 'true', 'false'. Default is 'page'.
	 *     @type bool   $show_all           Whether to show all pages. Default false.
	 *     @type int    $end_size           How many numbers on either the start and the end list edges.
	 *                                      Default 1.
	 *     @type int    $mid_size           How many numbers to either side of the current pages. Default 2.
	 *     @type bool   $prev_next          Whether to include the previous and next links in the list. Default true.
	 *     @type bool   $prev_text          The previous page text. Default '&laquo;'.
	 *     @type bool   $next_text          The next page text. Default '&raquo;'.
	 *     @type string $type               Controls format of the returned value. Possible values are 'plain',
	 *                                      'array' and 'list'. Default is 'array'.
	 *     @type array  $add_args           An array of query args to add. Default false.
	 *     @type string $add_fragment       A string to append to each link. Default empty.
	 *     @type string $before_page_number A string to appear before the page number. Default empty.
	 *     @type string $after_page_number  A string to append after the page number. Default empty.
	 *     @type string $screen_reader_text Screen reader text for the nav element. Default 'Posts navigation'.
	 * }
	 * @param string $class                 (Optional) Classes to be added to the <ul> element. Default 'pagination'.
	 */
	function tracomme2023child_pagination( $args = array(), $class = 'pagination' ) {

		if ( ! $GLOBALS['wp_query'] instanceof WP_Query || ( ! isset( $args['total'] ) && $GLOBALS['wp_query']->max_num_pages <= 1 ) ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => _x( '&laquo;', 'previous set of posts', 'tracomme2023' ),
				'next_text'          => _x( '&raquo;', 'next set of posts', 'tracomme2023' ),
				'current'            => max( 1, get_query_var( 'paged' ) ),
				'screen_reader_text' => __( 'Posts navigation', 'tracomme2023' ),
			)
		);

		// Make sure we always get an array.
		$args['type'] = 'array';

		/**
		 * Array of paginated links.
		 *
		 * @var array<int,string>
		 */
		$links = paginate_links( $args );
		if ( empty( $links ) ) {
			return;
		}
		?>

		<!-- The pagination component -->
		<nav aria-labelledby="posts-nav-label">

			<h2 id="posts-nav-label" class="screen-reader-text">
				<?php echo esc_html( $args['screen_reader_text'] ); ?>
			</h2>

			<ul class="<?php echo esc_attr( $class ); ?>">

				<?php
				foreach ( $links as $link ) {
					?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php
						$search  = array( 'page-numbers', 'dots' );
						$replace = array( 'page-link', 'disabled dots' );
						echo str_replace( $search, $replace, $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</li>
					<?php
				}
				?>

			</ul>

		</nav>

		<?php
	}
}