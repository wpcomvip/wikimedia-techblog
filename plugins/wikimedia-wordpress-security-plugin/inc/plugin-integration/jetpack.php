<?php
/**
 * Customize behavior of Jetpack to Wikimedia's standards.
 */

declare( strict_types=1 );

namespace WMF\Security\Plugin_Integration\Jetpack;

/**
 * Connect namespace methods to actions and filters.
 */
function bootstrap(): void {
	// https://developer.jetpack.com/hooks/jetpack_blaze_enabled/
	add_filter( 'jetpack_blaze_enabled', '__return_false' );
}
