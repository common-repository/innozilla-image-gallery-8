<?php
/*
Plugin Name: Innozilla Image Gallery 8
Plugin URI: https://innozilla.com/wordpress-plugins/image-gallery-8/
Description: Very Simple Image Gallery with filter and load more
Author: Innozilla
Author URI: https://innozilla.com/
Text Domain: innozilla-image-gallery-8
Domain Path: /languages/
Version: 1.1.0
*/

define( 'IIG8_VERSION', '1.0.0' );

define( 'IIG8_REQUIRED_WP_VERSION', '3.0.0' );

define( 'IIG8_PLUGIN', __FILE__ );

define( 'IIG8_PLUGIN_BASENAME', plugin_basename( IIG8_PLUGIN ) );

define( 'IIG8_PLUGIN_NAME', trim( dirname( IIG8_PLUGIN_BASENAME ), '/' ) );

define( 'IIG8_PLUGIN_DIR', untrailingslashit( dirname( IIG8_PLUGIN ) ) );

define( 'IIG8_PLUGIN_URL', untrailingslashit( plugins_url( '', IIG8_PLUGIN ) ) );

require_once IIG8_PLUGIN_DIR . '/includes/init.php';