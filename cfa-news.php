<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.example.com/unknown
 * @since             1.0.0
 * @package           Cfa_News
 *
 * @wordpress-plugin
 * Plugin Name:       CFA News
 * Plugin URI:        https://www.example.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.3
 * Author:            Developer Junayed
 * Author URI:        https://www.example.com/unknown
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cfa-news
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/OpenGraph.php';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CFA_NEWS_VERSION', '1.0.3' );


function get_image_to_base64($url){
	$image_url = $url;
	try {
		$context = stream_context_create(array(
			'http' => array('ignore_errors' => true),
		));
		$image = file_get_contents($image_url, false, $context);
		preg_match('/([0-9])\d+/',$http_response_header[0],$matches);
		$responsecode = intval($matches[0]);

		if ($responsecode === 200){
			$image_url = base64_encode($image);
		}
	} catch (\Throwable $th) {
		//throw $th;
	}
	return $image_url;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cfa-news-activator.php
 */
function activate_cfa_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cfa-news-activator.php';
	Cfa_News_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cfa-news-deactivator.php
 */
function deactivate_cfa_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cfa-news-deactivator.php';
	Cfa_News_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cfa_news' );
register_deactivation_hook( __FILE__, 'deactivate_cfa_news' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cfa-news.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cfa_news() {

	$plugin = new Cfa_News();
	$plugin->run();

}
run_cfa_news();
