<?php
/**
 * Plugin Name: Techblog Disable Resource Hints
 * Description: Disable wp_resource_hints output
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
 * Filters domains and URLs for resource hints of relation type.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array URLs
 */
function tbdrh_wp_resource_hints( $urls, $relation_type ) {
	return [];
}

add_filter( 'wp_resource_hints', 'tbdrh_wp_resource_hints', 999, 2 );
