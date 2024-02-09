<?php
/**
 * HTTP Header-related functionality, excluding CSP which gets its own namespace.
 */

declare( strict_types=1 );

namespace WMF\Security\HTTP_Headers;

/**
 * Connect namespace functions that set required headers.
 */
function bootstrap() {
	add_action( 'send_headers', __NAMESPACE__ . '\\enable_strict_transport_security' ); // Ensure HTTPS.
	add_action( 'send_headers', __NAMESPACE__ . '\\set_x_frame_options' ); // Prevent clickjacking by controlling frame embed options.
	add_action( 'send_headers', __NAMESPACE__ . '\\set_x_content_type_options' ); // Option of X Content Type.
	add_action( 'send_headers', __NAMESPACE__ . '\\set_referrer_policy' ); // Policy for referrer.
	add_action( 'send_headers', __NAMESPACE__ . '\\set_permissions_policy' ); // Policy for permissions.
}

/**
 * Functioning for HSTS, requirement of HTTPS for all connections.
 */
function enable_strict_transport_security() {
	header( 'Strict-Transport-Security: max-age=31536000' );
}

/**
 * Set the X-Frame-Options header to prevent clickjacking attacks by prohibiting
 * this site from being embedded elsewhere.
 */
function set_x_frame_options() {
	header( 'X-Frame-Options: SAMEORIGIN' );
}

/**
 * Setting the X-Content-Type-Options for no sniffing of MIME type.
 */
function set_x_content_type_options() {
	header( 'X-Content-Type-Options: nosniff' );
}

/**
 * Function for setting Referrer Policy. No referrer information.
 */
function set_referrer_policy() {
	header( 'Referrer-Policy: no-referrer' );
}

/**
 * Finally, function for setting the Permissions Policy.
 * We're allowing only the fullscreen feature from our domain.
 */
function set_permissions_policy() {
	header( 'Permissions-Policy: fullscreen=(self)' );
}
