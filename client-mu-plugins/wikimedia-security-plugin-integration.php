<?php
/**
 * Plugin Name: Wikimedia Security Plugin Integration
 *
 * Description: Adjusts Content Security Policy to include additional sources
 * for stylesheets, scripts, and frames. This requires the
 * Wikimedia Security Plugin to be installed and activated, which can be found
 * @https://github.com/wikimedia/wikimedia-wordpress-security-plugin
 */

namespace Security_Plugin_Integration;

/**
 * Adjusts the Content Security Policy for stylesheets, scripts, and frames.
 *
 * @param string[] $allowed_origins List of origins to allow in this CSP.
 * @param string   $policy_type     CSP type.
 * @return string[] Filtered policy allowed origins array.
 */
function adjust_content_security_policy( array $allowed_origins, string $policy_type ): array {
	if ( 'style-src' === $policy_type ) {
		$allowed_origins[] = 'https://s0.wp.com';
	}

	if ( 'script-src' === $policy_type ) {
		$allowed_origins[] = 'https://s0.wp.com';
	}

	if ( 'default-src' === $policy_type ) {
		$allowed_origins[] = 'https://widgets.wp.com';
	}

	return $allowed_origins;
}
add_filter( 'wmf/security/csp/allowed_origins', __NAMESPACE__ . '\\adjust_content_security_policy', 10, 2 );
