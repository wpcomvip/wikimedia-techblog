<?php
/**
 * Plugin Name: Techblog Analytics
 * Description: Analytics for techblog.wikimedia.org
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

function techblog_analytics_load() {
	wp_enqueue_script(
		'techblog-analytics-script',
		plugin_dir_url(__FILE__) . 'assets/js/matomo.js'
	);
}
add_action( 'wp_enqueue_scripts', 'techblog_analytics_load' );
