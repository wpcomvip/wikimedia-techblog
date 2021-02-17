<?php
/*
 * We recommend all plugins for your site are
 * loaded in code, either from a file like this
 * one or from your theme (if the plugins are 
 * specific to your theme and do not need to be
 * loaded as early as this in the WordPress boot
 * sequence.
 * 
 * @see https://vip.wordpress.com/documentation/vip-go/understanding-your-vip-go-codebase/
 */

// wpcom_vip_load_plugin( 'plugin-name' );
/**
 * Note the above requires a specific naming structure: /plugin-name/plugin-name.php
 * You can also specify a specific root file: wpcom_vip_load_plugin( 'plugin-name/plugin.php' );
 *
 * wpcom_vip_load_plugin only loads plugins from the `WP_PLUGIN_DIR` directory.
 * For client-mu-plugins `require __DIR__ . '/plugin-name/plugin-name.php'` works.
 */
add_filter( 'use_block_editor_for_post', '__return_true' );

/**
 * Disable New Relic browser monitoring.
 *
 * See mu-plugins/vip-helpers/vip-newrelic.php for implementation of
 * the hook handler.
 */
add_action( 'template_redirect', 'wpcom_vip_disable_new_relic_js' );

/**
 * Short circuit the ridiculous is_multi_author() function before it tries to
 * query the database.
 *
 * @param string $transient Transient name
 * @return bool True, always true
 */
function cmu_always_multi_author( $transient ) {
	return true;
}
add_filter( 'pre_transient_is_multi_author',  'cmu_always_multi_author' );
