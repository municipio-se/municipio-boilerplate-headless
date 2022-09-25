<?php
/*
Plugin Name: Must-Use Plugins Handler
Description: Auto-loads regular plugins in mu-plugins and translations
Author: Whitespace
Author URI: https://www.whitespace.se/
Text Domain: mu-plugins
*/

use Roots\Bedrock\Autoloader;

/**
 * Allows placing regular plugins in mu-plugins.
 */
if (is_blog_installed() && class_exists(Autoloader::class)) {
  new Autoloader();
}

/**
 * Loads translation files in /wp-content/mu-plugins/languages.
 * Use "mu-plugins" text domain if you want to translate mu-plugins.
 * Generate a new .pot file using this command:
 * wp i18n make-pot wp-content/mu-plugins --domain="mu-plugins" wp-content/mu-plugins/languages/mu-plugins.pot
 */
add_action("plugins_loaded", function () {
  load_muplugin_textdomain("mu-plugins", "languages");
});
