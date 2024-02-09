# wikimedia-wordpress-security-plugin

Plugin for use implementing security enhancements to the Wikimedia Foundation's sites hosted on WordPress VIP.

## Available filters

### `wmf/security/csp/allowed_origins`

Some values, such as allowed script origins, may need to be customized on a per-site basis: for example, perhaps one site in the network needs to be able to use a different video provider than YouTube or Vimeo, but most do not.

Filter on the custom `allowed_origins` hook to register any necessary site-specific origins.

```php
add_filter( 'wmf/security/csp/allowed_origins', __NAMESPACE__ . '\\permit_custom_video_provider', 10, 2 );

/**
 * Customize CSP origin allow-list for this site.
 *
 * @param string[] $allowed_origins List of origins to allow in this CSP.
 * @param string   $policy_type     CSP type.
 * @return string[] Filtered list of permitted origins.
 */
function permit_custom_video_provider( array $allowed_origins, string $policy_type ) : array {
	if ( in_array( $policy_type, [ 'script-src', 'frame-src' ], true ) {
		$allowed_origins[] = 'https://player.necessary-video-service.com';
	}
	return $allowed_origins;
}
```

### `wmf/security/rest_api/public_endpoint`

By default this plugin prevents unauthenticated access to the REST API. While the API is monitored by the WordPress Security Team and commonly-reported issues like enumeration of users with published posts are not commonly regarded as a significant risk, this team's security policy is that you don't need to be able to crawl the API anonymously.

However, some plugins and theme modules may require certain endpoints to work without authentication. As an example, the [vega-lite wordpress plugin](https://github.com/wikimedia/vega-lite-wordpress-plugin) exposes visualization data as CSVs delivered through a REST API endpoint, and these datasets need to be publicly accesible for that plugin's visualizations to work as expected.

This security plugin therefore provides a filter which a site can use to selectively enable public access to certain REST requests by filtering on the custom `public_endpoint` hook.

```php
add_filter( 'wmf/security/rest_api/public_endpoint', __NAMESPACE__ . '\\allow_anonymous_access_to_specific_endpoint', 10, 2 );

/**
 * Enable a specific REST API endpoint to be accessed without authentication.
 *
 * @param bool            $is_allowed Whether the endpoint is publicly accessible, false by default.
 * @param WP_REST_Request $request    Active REST Request object.
 * @return bool Whether the anonymous request should be permitted.
 */
function allow_anonymous_access_to_specific_endpoint( bool $is_allowed, WP_REST_Request $request ) : bool {

}
```

## Bundling Plugins

Certain plugins may be bundled into this theme to simplify install and activation. For example, the [`disable-emojis`](https://wordpress.org/plugins/disable-emojis/) plugin is included to remove dependencies on third-party services ([phabricator ticket](https://phabricator.wikimedia.org/T259421#7082791)).

To install a plugin,

1. Include the plugin in the `composer.json` as a **require-dev** dependency referencing a `wpackagist-plugin/` package.
2. Add a mapping the the Composer file's `extra.installer-paths` configuration to install the plugin into `inc/bundled-plugins/`.
3. Run `composer update wpackagist-plugin/plugin-name` to install the plugin locally.
4. Run `composer lint` to evaluate the plugin for errors.
    - If there are security-related errors, they should be reported upstream to the plugin author and the plugin should not be bundled. Because we directly commit these plugins into this repository we have the ability to customize the plugin code to resolve any issues, but the policy of the plugin is that we should not 'fork' the dependency plugins in that way.
    - If all PHPCS errors are purely stylistic (array syntax, docblocks, etc; even translator comments, anything non-security and non-performance), copy the output from `composer lint` and then proceed to the next step.
5. Add an exception for the plugin to the bundled plugins section of [`phpcs.dist.xml`](./phpcs.dist.xml), and then commit that PHPCS ruleset change, copying the flagged PHPCS issues into the commit message. (See dbc17ee9 for an example).
6. Add a require for the plugin's entrypoint file to `plugin.php`.

As a general rule we have not committed the dependency plugins' `composer.*` files; they are ignored in `inc/bundled-plugins/.gitignore`. If a plugin requires their composer file to function, add an exclusion to that nested gitignore with an explanatory comment.
