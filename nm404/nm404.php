<?php

/*
Plugin Name:    nm404
Plugin URI:     https://www.affiliate-solutions.xyz/
Description:    Avoid any 404 errors on your WordPress-Site by redirecting the request to the closest match found in the sitemap.xml
Version:        2.0.9
Author:         Affiliate solutions SLU
Author URI:     https://www.affiliate-solutions.xyz/
Text Domain:    nm404
Domain Path:    /languages/
*/

defined( 'ABSPATH' ) or die();
define('NM404_WPDIR', ABSPATH);
define('NM404_DIR', plugin_dir_path(__FILE__));
define('NM404_URL', plugin_dir_url(__FILE__));
define('NM404_SLUG', plugin_basename(__FILE__));
define('NM404_TEXTDOMAIN_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages/');
define('NM404_TEXT_DOMAIN', 'nm404');
define('NM404_PLUG_FILE', __FILE__);
define('NM404_PREFIX', 'nm404_');

require_once(NM404_DIR.'/lib/classes/Redirector404.php');
require_once(NM404_DIR.'/lib/classes/SiteQueue.php');
require_once(NM404_DIR.'/lib/classes/Logger.php');

$Redirector404 = new Redirector404();

if(is_admin()) {
    require_once(NM404_DIR.'/lib/NM404_Admin.php');
    NM404_Admin::init();
}

function nm404_load_textdomain() {
    load_plugin_textdomain(NM404_TEXT_DOMAIN, false, NM404_TEXTDOMAIN_PATH);
}

add_action('plugins_loaded', 'nm404_load_textdomain');

?>
