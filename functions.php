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
	
	// New Button Styles
		$param['value'][__( 'Tracomme White - Dark Blue', 'tracomme2023-child' )] = 'btn-tracomme-white-darkblue';
		$param['value'][__( 'Tracomme White - Blue', 'tracomme2023-child' )] = 'btn-tracomme-white-blue';
		$param['value'][__( 'Tracomme Black - Blue', 'tracomme2023-child' )] = 'btn-tracomme-black-blue';
		$param['value'][__( 'Tracomme Blue - Dark Blue', 'tracomme2023-child' )] = 'btn-tracomme-blue-darkblue';
		$param['value'][__( 'Tracomme Dark Blue - Blue', 'tracomme2023-child' )] = 'btn-tracomme-darkblue-blue';
		$param['value'][__( 'Tracomme Light Grey - Blue', 'tracomme2023-child' )] = 'btn-tracomme-lightgrey-blue';
		$param['value'][__( 'Tracomme Light Grey - Dark Blue', 'tracomme2023-child' )] = 'btn-tracomme-lightgrey-darkblue';
	
	// Remove colors not needed
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


/* Events&Expertise Image */
/* Image Size for Custom Post Types */
add_image_size( 'newsevents-archive-image', 960, 540, true );
add_image_size( 'newsevents-single-image', 1920, 800, true );
add_image_size( 'produkte-featured-image', 960, 960, true );
add_image_size( 'fachwissen-archive-image', 200, 200, true );


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


/* Create Shortcode for ShareThis sharethisshortcode */
 function sharethisleft16_shortcode_func() { 
  
// HTML code für shortcode
return '<div class="sharethis-container margin-bottom-16 sharethisleft">
<div class="sharethis-inline-share-buttons"></div>
</div>';

}
// Register shortcode
add_shortcode('sharethisleft16', 'sharethisleft16_shortcode_func'); 

function sharethiscenter16_shortcode_func() { 
	
// HTML code für shortcode
return '<div class="sharethis-container margin-bottom-16">
<div class="sharethis-inline-share-buttons"></div>
</div>';
}
// Register shortcode
add_shortcode('sharethiscenter16', 'sharethiscenter16_shortcode_func'); 


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

/* Read More remove from excerpt  */
remove_filter('get_the_excerpt', 'wp_trim_excerpt');

/* TAXONOMIEN ausgeben als Button Intern und Externe Links  */

if ( ! function_exists( 'tracomme_get_the_term_buttons_intern' ) ) {

/**
 * Function to return list of the terms.
 * 
 * @param string 'taxonomy'
 * 
 * @return html Returns the list of elements.
 */

function tracomme_get_the_term_buttons_intern( $taxonomy ) {
	$terms = get_the_terms( get_the_ID(), $taxonomy );
	if ( $terms && ! is_wp_error( $terms ) ) : 
	
		$term_tag_objects = array();
		foreach ( $terms as $term ) {
			//$term_tag_objects[] = '<div class="produkte-tag-single-page">' . __( $term->name ) . '</div>';
			$term_tag_objects[] = '<div class="produkte-tag-single-page"><a href="' . __( $term->description ). '">' . __( $term->name ) . '</a></div>';
		}				
		$all_terms = join( '', $term_tag_objects );
		echo __( $all_terms );
	endif;
}
}

if ( ! function_exists( 'tracomme_get_the_term_buttons_extern' ) ) {

	/**
	 * Function to return list of the terms.
	 * 
	 * @param string 'taxonomy'
	 * 
	 * @return html Returns the list of elements.
	 */
	
	function tracomme_get_the_term_buttons_extern( $taxonomy ) {
		$terms = get_the_terms( get_the_ID(), $taxonomy );
		if ( $terms && ! is_wp_error( $terms ) ) : 
		
			$term_tag_objects = array();
			foreach ( $terms as $term ) {
				//$term_tag_objects[] = '<div class="produkte-tag-single-page">' . __( $term->name ) . '</div>';
				$term_tag_objects[] = '<div class="produkte-tag-single-page"><a href="' . __( $term->description ). '" target="_blank">' . __( $term->name ) . '</a></div>';
			}				
			$all_terms = join( '', $term_tag_objects );
			echo __( $all_terms );
		endif;
	}
	}

/* Sortierung Fachwissen Alphabetisch */
add_action( 'pre_get_posts', 'my_change_sort_order'); 
function my_change_sort_order($query){
	if(is_post_type_archive( 'fachwissen' )):
		//If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
		//Set the order ASC or DESC
		$query->set( 'order', 'ASC' );
		//Set the orderby
		$query->set( 'orderby', 'title' );
	endif;    
};


/* Pagination Fachwissen entfernen*/
function remove_pagination_from_post_type( $query ) {
    if ( is_post_type_archive( 'fachwissen' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'remove_pagination_from_post_type', 1 );

/* Ajax Filtering */

function assets() {

    wp_enqueue_script('tuts/js', get_stylesheet_directory_uri() . '/js/ajax-filter-post.js', ['jquery'], null, true);
    wp_enqueue_script('tuts/js', get_stylesheet_directory_uri() . '/js/jquery.ba-hashchange.js', ['jquery'], null, true);

    wp_localize_script( 'tuts/js', 'bobz', array(
        'nonce'    => wp_create_nonce( 'bobz' ),
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action('wp_enqueue_scripts', 'assets', 100);

/* Ajax Filtering */
function vb_filter_posts() {

    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'bobz' ) )
        die('Permission denied');

    /**
     * Default response
     */
    $response = [
        'status'  => 500,
        'message' => 'Something is wrong, please try again later ...',
        'content' => false,
        'found'   => 0
    ];

    $tax  = sanitize_text_field($_POST['params']['tax']);
    $term = sanitize_text_field($_POST['params']['term']);
    $page = intval($_POST['params']['page']);
    $qty  = intval($_POST['params']['qty']);

    /**
     * Check if term exists
     */
    if (!term_exists( $term, $tax) && $term != 'all-terms') :
        $response = [
            'status'  => 501,
            'message' => 'Term doesn\'t exist',
            'content' => 0
        ];

        die(json_encode($response));
    endif;

    if ($term == 'all-terms') : 

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
            'operator' => 'NOT IN'
        ];

    else :

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
        ];

    endif;

    /**
     * Setup query
     */
    $args = [
        'paged'          => $page,
        'post_type'      => 'fachwissen',
        'post_status'    => 'publish',
        'posts_per_page' => $qty,
        'tax_query'      => $tax_qry,
		'orderby'        => 'title',
   		'order'          => 'asc',

    ];

    $qry = new WP_Query($args);

    ob_start();
        if ($qry->have_posts()) :
            while ($qry->have_posts()) : $qry->the_post(); ?>
			<?php get_template_part( 'loop-templates/content', 'fachwissen' ); ?>
            <?php endwhile;

            /**
             * Pagination
             */
            //vb_ajax_pager($qry,$page);

            $response = [
                'status'=> 200,
                'found' => $qry->found_posts
            ];

            
        else :

            $response = [
                'status'  => 201,
                'message' => 'No posts found'
            ];

        endif;

    $response['content'] = ob_get_clean();

    die(json_encode($response));

}
add_action('wp_ajax_do_filter_posts', 'vb_filter_posts');
add_action('wp_ajax_nopriv_do_filter_posts', 'vb_filter_posts');


/**
 * Shortocde for displaying terms filter and results on page
 */
function vb_filter_posts_sc($atts) {

    $a = shortcode_atts( array(
        'tax'      => 'post_tag', // Taxonomy
        'terms'    => false, // Get specific taxonomy terms only
        'active'   => false, // Set active term by ID
        'per_page' => -1, // How many posts per page
		'orderby'  => 'title',
   		'order'    => 'asc'

    ), $atts );

    $result = NULL;
    $terms  = get_terms($a['tax']);

    if (count($terms)) :
        ob_start(); ?>
            <div id="container-async" data-paged="<?php echo $a['per_page']; ?>" class="sc-ajax-filter">
                <ul class="nav-filter">
					<li class="nav-filter-title"><?php esc_attr_e( 'Keywords', 'tracomme2023-child' ); ?>
					</li>
					<li>
                        <a href="#" data-filter="<?= $terms[0]->taxonomy; ?>" data-term="all-terms" data-page="1">
                            <?php esc_attr_e( 'Show all', 'tracomme2023-child' ); ?>
                        </a>
                    </li>
                    <?php foreach ($terms as $term) : ?>
                        <li<?php if ($term->term_id == $a['active']) :?> class="active"<?php endif; ?>>
                            <a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-filter="<?php echo $term->taxonomy; ?>" data-term="<?php echo $term->slug; ?>" data-page="1">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="status status-fachwissen"></div>
                <div class="content"></div>
            </div>
        
        <?php $result = ob_get_clean();
    endif;

    return $result;
}
add_shortcode( 'ajax_filter_posts', 'vb_filter_posts_sc');

 // contentboxen von Suche ausschliessen
 add_action( 'init', 'exclude_cpt_search_filter', 99 );
 function exclude_cpt_search_filter() {
     global $wp_post_types;
 
     if ( post_type_exists( 'content-boxen' ) ) {
 
         // exclude from search results
         $wp_post_types['content-boxen']->exclude_from_search = true;
     }
 }

//Featured Image 2 for Custom Post Type
add_action( 'after_setup_theme', 'custom_postimage_setup' );
function custom_postimage_setup(){
    add_action( 'add_meta_boxes', 'custom_postimage_meta_box' );
    add_action( 'save_post', 'custom_postimage_meta_box_save' );
}

function custom_postimage_meta_box(){

    //on which post types should the box appear?
    $post_types = array('news-events');
    foreach($post_types as $pt){
        add_meta_box('custom_postimage_meta_box',__( 'Single Page Featured Image', 'tracomme2023-child'),'custom_postimage_meta_box_func',$pt,'side','low');
    }
}

function custom_postimage_meta_box_func($post){

    //an array with all the images (ba meta key). The same array has to be in custom_postimage_meta_box_save($post_id) as well.
    $meta_keys = array('second_featured_image');

    foreach($meta_keys as $meta_key){
        $image_meta_val=get_post_meta( $post->ID, $meta_key, true);
        ?>
        <div class="custom_postimage_wrapper" id="<?php echo $meta_key; ?>_wrapper" style="margin-bottom:20px;">
            <img src="<?php echo ($image_meta_val!=''?wp_get_attachment_image_src( $image_meta_val)[0]:''); ?>" style="width:100%;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" alt="">
            <a class="addimage button" onclick="custom_postimage_add_image('<?php echo $meta_key; ?>');"><?php _e('add image','tracomme2023-child'); ?></a><br>
            <a class="removeimage" style="color:#a00;cursor:pointer;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" onclick="custom_postimage_remove_image('<?php echo $meta_key; ?>');"><?php _e('remove image','tracomme2023-child'); ?></a>
            <input type="hidden" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo $image_meta_val; ?>" />
        </div>
    <?php } ?>
    <script>
    function custom_postimage_add_image(key){

        var $wrapper = jQuery('#'+key+'_wrapper');

        custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php _e('select image','tracomme2023-child'); ?>',
            button: {
                text: '<?php _e('select image','tracomme2023-child'); ?>'
            },
            multiple: false
        });
        custom_postimage_uploader.on('select', function() {

            var attachment = custom_postimage_uploader.state().get('selection').first().toJSON();
            var img_url = attachment['url'];
            var img_id = attachment['id'];
            $wrapper.find('input#'+key).val(img_id);
            $wrapper.find('img').attr('src',img_url);
            $wrapper.find('img').show();
            $wrapper.find('a.removeimage').show();
        });
        custom_postimage_uploader.on('open', function(){
            var selection = custom_postimage_uploader.state().get('selection');
            var selected = $wrapper.find('input#'+key).val();
            if(selected){
                selection.add(wp.media.attachment(selected));
            }
        });
        custom_postimage_uploader.open();
        return false;
    }

    function custom_postimage_remove_image(key){
        var $wrapper = jQuery('#'+key+'_wrapper');
        $wrapper.find('input#'+key).val('');
        $wrapper.find('img').hide();
        $wrapper.find('a.removeimage').hide();
        return false;
    }
    </script>
    <?php
    wp_nonce_field( 'custom_postimage_meta_box', 'custom_postimage_meta_box_nonce' );
}

function custom_postimage_meta_box_save($post_id){

    if ( ! current_user_can( 'edit_posts', $post_id ) ){ return 'not permitted'; }

    if (isset( $_POST['custom_postimage_meta_box_nonce'] ) && wp_verify_nonce($_POST['custom_postimage_meta_box_nonce'],'custom_postimage_meta_box' )){

        //same array as in custom_postimage_meta_box_func($post)
        $meta_keys = array('second_featured_image','third_featured_image');
        foreach($meta_keys as $meta_key){
            if(isset($_POST[$meta_key]) && intval($_POST[$meta_key])!=''){
                update_post_meta( $post_id, $meta_key, intval($_POST[$meta_key]));
            }else{
                update_post_meta( $post_id, $meta_key, '');
            }
        }
    }
}

?>