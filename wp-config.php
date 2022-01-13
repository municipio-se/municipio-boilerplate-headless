<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

/**
 * Autoload packages
 */
require_once dirname(__FILE__) . "/vendor/autoload.php";

use function Env\env;

require_once "config/cookie.php";

require_once "config/content.php";

/**
 * Directory containing all of the site's files
 *
 * @var string
 */
$root_dir = __DIR__;

/**
 * Use Dotenv to set required environment variables and load .env file in root
 * We are loading this in after checking for other config files.
 *
 * That means that anything in a .env-file will take precedence over anything found in a config-file.
 */

$dotenv = Dotenv\Dotenv::createUnsafeImmutable($root_dir);

if (file_exists($root_dir . "/.env")) {
  $dotenv->load();
  $dotenv->required(["WP_HOME", "WP_SITEURL"]);
  if (!env("DATABASE_URL")) {
    $dotenv->required(["DB_NAME", "DB_USER", "DB_PASSWORD"]);
  }
}

// ** MySQL settings - You can get this info from your web host ** //

/**
 * Turn of admin panel for ACF.
 */
define("ACF_LITE", false);

/**
 * Share search notices across the network
 */
define("SEARCH_NOTICES_NETWORK", true);

/**
 * Recaptcha
 */
define("G_RECAPTCHA_KEY", "");
define("G_RECAPTCHA_SECRET", "");

define("AUTOMATIC_UPDATER_DISABLED", true);

define("WP_MEMORY_LIMIT", "64M");

define("DISABLE_WP_CRON", env("DISABLE_WP_CRON"));

if (file_exists(__DIR__ . "/config/cache.php")) {
  require_once "config/cache.php";
}

/**
 * Tell WordPress to be used as network
 */
define("WP_ALLOW_MULTISITE", true);

define("MULTISITE", (bool) env("MULTISITE"));

/**
 * Subdomain or subpath
 * Set to true for subdomain, false for subpath
 * Examples:
 * sub.domain.com (subdomain)
 * domain.com/sub (subpath)
 */
define("SUBDOMAIN_INSTALL", false);

/**
 * Default site config
 */
define("DOMAIN_CURRENT_SITE", env("DOMAIN_CURRENT_SITE"));
define("PATH_CURRENT_SITE", "/");
define("SITE_ID_CURRENT_SITE", 1);
define("BLOG_ID_CURRENT_SITE", 1);

define("WP_DEBUG", env("WP_DEBUG"));
define("WP_DEBUG_DISPLAY", env("WP_DEBUG_DISPLAY"));
define(
  "WP_DEBUG_LOG",
  env("WP_DEBUG_LOG") ? dirname(ABSPATH) . "/" . env("WP_DEBUG_LOG") : null
);
define("GRAPHQL_DEBUG", env("GRAPHQL_DEBUG"));

if (file_exists(__DIR__ . "/config/local-ip.php")) {
  require_once "config/local-ip.php";
}

/** Absolute path to the WordPress directory. */
if (!defined("ABSPATH")) {
  define("ABSPATH", dirname(__FILE__) . "/");
}

/**
 * Document Root
 *
 * @var string
 */
$webroot_dir = $root_dir . "/wp";

define("WP_ENV", env("WP_ENV"));

define("WP_HOME", env("WP_HOME"));

define("WP_PREFIX", env("WP_PREFIX"));
$table_prefix = WP_PREFIX;

define("WP_SITEURL", env("WP_SITEURL"));

/** The name of the database for WordPress */
define("DB_NAME", env("DB_NAME"));

/** MySQL database username */
define("DB_USER", env("DB_USER"));

/** MySQL database password */
define("DB_PASSWORD", env("DB_PASSWORD"));

/** MySQL hostname */
define("DB_HOST", env("DB_HOST"));

/** Database Charset to use in creating database tables. */
define("DB_CHARSET", "utf8mb4");

/** The Database Collate type. Don't change this if in doubt. */
define("DB_COLLATE", "");

define("GATSBY_BASE_URL", env("GATSBY_BASE_URL"));
define("GATSBY_REFRESH_ENDPOINTS", env("GATSBY_REFRESH_ENDPOINTS"));
define("GATSBY_PREVIEW_ENDPOINT", env("GATSBY_PREVIEW_ENDPOINT"));

define("CI_NOTIFY_URLS", env("CI_NOTIFY_URLS"));

// Salts
define("AUTH_KEY", env("AUTH_KEY"));
define("SECURE_AUTH_KEY", env("SECURE_AUTH_KEY"));
define("LOGGED_IN_KEY", env("LOGGED_IN_KEY"));
define("NONCE_KEY", env("NONCE_KEY"));
define("AUTH_SALT", env("AUTH_SALT"));
define("SECURE_AUTH_SALT", env("SECURE_AUTH_SALT"));
define("LOGGED_IN_SALT", env("LOGGED_IN_SALT"));
define("NONCE_SALT", env("NONCE_SALT"));

/** Sets up WordPress vars and included files. */
require_once ABSPATH . "wp-settings.php";
