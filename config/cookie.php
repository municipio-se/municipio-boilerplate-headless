<?php

/**
 * Tell WordPress to save the cookie on the domain
 * @var bool
 */
//$_SERVER['HTTP_HOST'] = 'astorp-intranat.dev';

//$_SERVER['HTTPS'] = 'off';
//$_SERVER[ 'HTTP_HOST'] = explode('/', $_ENV['WORDPRESS_URL'])[2];
//print_r($_SERVER['HTTP_HOST']);
//die();
if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])) {
  if ($_SERVER["HTTP_X_FORWARDED_PROTO"] == "https") {
    $_SERVER["HTTPS"] = "on";
    $_SERVER["SERVER_PORT"] = 443;
  }
}
if (isset($_SERVER["HTTP_X_FORWARDED_HOST"])) {
  $_SERVER["HTTP_HOST"] = $_SERVER["HTTP_X_FORWARDED_HOST"];
}

define("COOKIE_DOMAIN", "");
