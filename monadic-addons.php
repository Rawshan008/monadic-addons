<?php 
/**
 * Plugin Name:         Monadic Addons For Elementor
 * Description:         This is Elementor Custom Addons
 * Plugin URI:          #
 * Version:             1.0.0
 * Author:              Rawshan
 * Author URI:          #
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         monadic-addons
 * Domain Path:         /languages
 * 
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MONADIC_ADDONS_VERSION', '1.0.0' );

/**
 * Define Necessary Constant
 */
define('MONADIC_ADDONS_FILE', __FILE__);
define('MONADIC_ADDONS_DIR_PATH', plugin_dir_path(MONADIC_ADDONS_FILE));
define('MONADIC_ADDONS_DIR_URL', plugin_dir_url(MONADIC_ADDONS_FILE));
define('MONADIC_ADDONS_ASSETS', trailingslashit(MONADIC_ADDONS_DIR_URL . 'assets'));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-monadic-addons-activator.php
 */
function activate_monadic_addons() {
	require_once MONADIC_ADDONS_DIR_PATH . 'includes/admin/class-monadic-addons-activator.php';
	Monadic_Addons_Activator::activate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-monadic-addons-deactivator.php
 */
function deactivate_monadic_addons() {
	require_once MONADIC_ADDONS_DIR_PATH . 'includes/admin/class-monadic-addons-deactivator.php';
	Monadic_Addons_Deactivator::deactivate();
}


register_activation_hook( MONADIC_ADDONS_FILE, 'activate_monadic_addons' );
register_deactivation_hook( MONADIC_ADDONS_FILE, 'deactivate_monadic_addons' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require MONADIC_ADDONS_DIR_PATH . 'includes/admin/class-monadic-addons.php';



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_monadic_addons() {

	$plugin = new Monadic_Addons();
	$plugin->run();

}
run_monadic_addons();