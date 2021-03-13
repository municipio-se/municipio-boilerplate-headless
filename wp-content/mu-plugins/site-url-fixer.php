<?php
/*
Plugin Name: Site URL fixer
Description: Fixes site URLs and home URLs for installs with a subdirectory for the WordPress core files. Works with multisite installs.
*/

define("WORDPRESS_INSTALL_DIR", "/wp");

define("WORDPRESS_INSTALL_DIR_NAME_LENGTH", strlen(WORDPRESS_INSTALL_DIR));

add_filter("option_home", function ($value) {
  if (
    substr($value, -WORDPRESS_INSTALL_DIR_NAME_LENGTH) === WORDPRESS_INSTALL_DIR
  ) {
    $value = substr($value, 0, -WORDPRESS_INSTALL_DIR_NAME_LENGTH);
  }
  return $value;
});

add_filter("option_siteurl", function ($url) {
  if (
    substr($url, -WORDPRESS_INSTALL_DIR_NAME_LENGTH) === WORDPRESS_INSTALL_DIR
  ) {
    $url = substr($url, 0, -WORDPRESS_INSTALL_DIR_NAME_LENGTH);
  }
  return $url;
});

add_filter(
  "network_site_url",
  function ($url, $path, $scheme) {
    $path = ltrim($path, "/");
    $url = substr($url, 0, strlen($url) - strlen($path));

    if (
      substr($url, -WORDPRESS_INSTALL_DIR_NAME_LENGTH) === WORDPRESS_INSTALL_DIR
    ) {
      $url = substr($url, 0, -WORDPRESS_INSTALL_DIR_NAME_LENGTH);
    }

    return $url . $path;
  },
  10,
  3
);
