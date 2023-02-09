<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Tracomme2023
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'tracomme2023_container_type' );
?>
<div class="languagebar">
	<div class="container">
		<?php
		/* Custom Language Switcher */
		do_action('wpml_add_language_selector');			
		?>
	</div>
</div>
<nav id="main-nav" class="navbar navbar-expand-lg navbar-light bg-primary" aria-labelledby="main-nav-label">
	
	<h2 id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'tracomme2023' ); ?>
	</h2>


	<div class="<?php echo esc_attr( $container ); ?>">

		<!-- Your site branding in the menu -->
		<?php get_template_part( 'global-templates/navbar-branding' ); ?>

		<button
			class="navbar-toggler"
			type="button"
			data-bs-toggle="collapse"
			data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle navigation', 'tracomme2023' ); ?>"
		>
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- The WordPress Menu goes here -->
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav ms-center',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new Tracomme2023_WP_Bootstrap_Navwalker(),
			)
		);

		wp_nav_menu(
			array(
				'theme_location'  => 'contact_menu',
				'container_class' => 'collapse navbar-collapse flexgrownull',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav ms-auto',
				'fallback_cb'     => '',
				'menu_id'         => 'contact_menu',
				'depth'           => 1,
				'walker'          => new Tracomme2023_WP_Bootstrap_Navwalker(),
			)
		);
		?>

	</div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->
