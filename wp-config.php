<?php
/**
 * The base configurations of the WordPress.
 *
 * This file is a custom version of the wp-config file to help
 * with setting it up for multiple environments. Inspired by
 * Leevi Grahams ExpressionEngine Config Bootstrap
 * (http://ee-garage.com/nsm-config-bootstrap)
 *
 * @package WordPress
 * @author Abban Dunne @abbandunne
 * @link http://abandon.ie/wordpress-configuration-for-multiple-environments
 */


// Define Environments here except for production
// Update this according to your needs
$environments = array(
	'local'       => '.local',
	'development' => '.dev',
	'staging'     => 'stage.',
	'preview'     => 'preview.'
);

// Get Server name
$server_name = $_SERVER['SERVER_NAME'];

foreach($environments AS $key => $env){

	if(strstr($server_name, $env)){

		define('ENVIRONMENT', $key);

		break;
	}
}

// If no environment is set, default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'production');

define('ABSPATH', dirname(__FILE__) . '/');

$env_config = ABSPATH . sprintf('wp-config-%s.php', ENVIRONMENT);

// Terminate if file doesn't exist
if(!file_exists(($env_config)))	exit("$env_config doesn't exist");

/** Sets up WP config based on environment. */
require_once($env_config);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');