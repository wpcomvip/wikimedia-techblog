<?php
/**
 * Theme Name:   Modern Child
 * Author:       Bryan Davis
 * License:      GPL-3.0-or-later
 * License URI:  https://www.gnu.org/licenses/gpl-3.0.html
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

function enqueue_parent_styles() {
	wp_enqueue_style(
		'parent-style',
		get_template_directory_uri().'/style.css'
	);
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

/**
 * Filter X-hacker output.
 */
add_filter( 'wp_headers', function( $headers ) {
    if ( isset( $headers['X-hacker'] ) ) {
        unset( $headers['X-hacker'] );
    }
    return $headers;
}, 999 );

/**
 * Show co-authors plus authors in RSS feed.
 */
add_filter( 'the_author', function( $display_name ) {
	if ( is_feed() && function_exists( 'coauthors' ) ) {
		$display_name = coauthors( null, null, null, null, false );
	}
	return $display_name;
} );
