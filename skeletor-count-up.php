<?php

/**
 * Plugin Name:           QB - Count Up
 * Plugin URI:            https://github.com/mandytechnologies/skeletor-count-up
 * Description:           Enqueue Javascript to process .count-up elements
 * Version:               1.0.0
 * Requires PHP:          7.0
 * Requires at least:     6.1.0
 * Tested up to:          6.8.2
 * Author:                Quick Build
 * Author URI:            https://www.quickbuildwebsite.com/
 * License:               GPLv2 or later
 * License URI:           https://www.gnu.org/licenses/
 * Text Domain:           qb-count-up
 * 
 */

namespace Skeletor;

class Count_Up
{
	public static function plugins_loaded()
	{
		if (is_admin()) {
			return;
		}

		add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
	}

	public static function enqueue_scripts()
	{
		$asset = require_once(__DIR__ . '/build/index.asset.php');
		wp_enqueue_script(
			'count_up',
			plugin_dir_url(__DIR__ . '/build/index.js') . 'index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);
	}
}

add_action('plugins_loaded', ['Skeletor\Count_Up', 'plugins_loaded']);

define('MANDY_COUNT_UP', '`1.0.0');

require 'plugin-update-checker/plugin-update-checker.php';

$update_checker = \Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/mandytechnologies/skeletor-count-up',
	__FILE__,
	'skeletor-count-up'
);

require_once( 'includes/class-plugin.php' );