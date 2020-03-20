<?php
/**
 * Template part for displaying an author byline.
 *
 * Works with or without https://wpvip.com/plugins/co-authors-plus/
 */
if ( function_exists( 'coauthors_posts_links' ) ) {
	// Co-Authors Plus plugin is active, so use it's renderer.
	coauthors_posts_links( null, null, null, null, true );
} else {
	// "Normal" author from parent theme. In a parent/child theme setup,
	// TEMPLATEPATH points to the root of the parent theme.
	load_template(
		TEMPLATEPATH . '/template-parts/meta/entry-meta-element-author.php'
	);
}
