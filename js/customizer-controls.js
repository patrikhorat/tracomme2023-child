/**
 * Scripts within the customizer controls window.
 *
 * Adds a warning to the Theme Layout Settings section.
 */

 (function() {
	wp.customize.bind( 'ready', function() {
		// Only show the navbar type setting when running Bootstrap 5.
		wp.customize.section( 'tracomme2023_theme_layout_options').notifications.add( 'example-warning', new wp.customize.Notification(
			'example-warning',
			{
				type: 'warning',
				message: 'You are currently using an Tracomme2023 child theme, which may override some of these settings.'
			}
		) );
	});
})();
