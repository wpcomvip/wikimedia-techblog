<?php
/**
 * Plugin Name: Techblog Fonts
 * Description: Webfonts for techblog.wikimedia.org
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

function techblog_fonts_styles() {
	wp_enqueue_style(
		'techblog_fonts_css',
		plugin_dir_url(__FILE__) . 'assets/css/techblog-fonts.css'
	);
}
add_action( 'wp_enqueue_scripts', 'techblog_fonts_styles' );

/**
 * Ensure that the Modern theme never loads fonts from Google directly.
 */
function techblog_fonts_dequeue_modern_google_fonts() {
	wp_dequeue_style( 'modern-google-fonts' );
}
add_action( 'wp_print_styles', 'techblog_fonts_dequeue_modern_google_fonts' );
