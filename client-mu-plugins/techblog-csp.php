<?php
/**
 * Plugin Name: Techblog CSP
 * Description: Add Content-Security-Policy and related headers
 * Version: 1.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

defined( 'ABSPATH' ) || die( 'No user serviceable parts inside.' );

/**
 * Filters the HTTP headers before they're sent to the browser.
 *
 * @param array $headers
 * @param WP $instance
 * @return array Headers
 */
function techblog_csp_wp_headers( array $headers, WP $instance  ) {
	$allowedOrigins = [
		"'self'",
		'*.wikimedia.org',
	];
	if ( is_admin() ) {
		$allowedOrigins[] = '*.wp.com';
	}

	$defaultOrigins = implode( ' ', $allowedOrigins );
	$cspDirectives = [
		"default-src {$defaultOrigins}",
		"base-uri 'self'",
		"font-src data: {$defaultOrigins}",
		"img-src data: https://phab.wmfusercontent.org {$defaultOrigins}",
		"script-src 'unsafe-inline' {$defaultOrigins}",
		"style-src 'unsafe-inline' {$defaultOrigins}",
		"form-action 'self'",
		"frame-ancestors 'none'",
		"block-all-mixed-content",
	];

	$headers['Content-Security-Policy'] = implode( '; ', $cspDirectives );
	$headers['X-Frame-Options'] = 'deny';
	$headers['X-XSS-Protection'] = '1; mode=block';
	$headers['X-Content-Type-Options'] = 'nosniff';
	$headers['X-DNS-Prefetch-Control'] = 'off';
	$headers['Referrer-Policy'] = 'strict-origin-when-cross-origin';
	return $headers;
}
add_filter( 'wp_headers', 'techblog_csp_wp_headers', 900, 2 );
