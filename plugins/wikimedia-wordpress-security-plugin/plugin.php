<?php
/**
 * Plugin Name: Wikimedia WordPress Security Plugin
 * Description: Deploys security related code to Wikimedia Foundation sites hosted on WordPress VIP.
 * Author: The Wikimedia Foundation and Human Made
 * Author URI: https://github.com/wikimedia/wikimedia-wordpress-security-plugin/graphs/contributors
 * Version: 1.0.0
 * Text Domain: wikimedia-security
 */

declare( strict_types=1 );

namespace WMF\Security;

require_once __DIR__ . '/inc/http-headers.php';
require_once __DIR__ . '/inc/plugin-integration/jetpack.php';
require_once __DIR__ . '/inc/csp.php';
require_once __DIR__ . '/inc/rest-api.php';

CSP\bootstrap();
HTTP_Headers\bootstrap();
Plugin_Integration\Jetpack\bootstrap();
REST_API\bootstrap();

// Activate bundled plugins.
require_once __DIR__ . '/inc/bundled-plugins/disable-emojis/disable-emojis.php';
