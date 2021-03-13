<?php

if (defined("WP_CLI") && WP_CLI) {
  $_SERVER["HTTP_HOST"] = "host.local";
}

/**
 * Tell WordPress to load from local wp-content, and not vendor wp.
 */
define("WP_CONTENT_DIR", dirname(dirname(__FILE__)) . "/wp-content");

if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") {
  define("WP_CONTENT_URL", "https://" . $_SERVER["HTTP_HOST"] . "/wp-content");
} else {
  define("WP_CONTENT_URL", "http://" . $_SERVER["HTTP_HOST"] . "/wp-content");
}

/**
 * Use municipio as default theme.
 * @var string
 */
define("WP_DEFAULT_THEME", "municipio");

/**
 * Use municipio webfont loader
 * @var bool
 * @var string
 */
define("WEB_FONT", "Heebo");
define("THEME_FONTS", "Heebo,system,Segoe UI,Tahoma,-apple-system");

/**
 * Limit number of post revisions per post
 * @var integer
 */
define("WP_POST_REVISIONS", 10);

/**
 * Set the autosave interval
 * @default: 60 seconds
 * @var integer
 */
define("AUTOSAVE_INTERVAL", 120);

/**
 * Disable the WordPress theme/plugin editor
 */
define("DISALLOW_FILE_EDIT", true);

/**
 * Do not block author pages
 */
define("MUNICIPIO_BLOCK_AUTHOR_PAGES", false);
