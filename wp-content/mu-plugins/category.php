<?php

/**
 * Removes category taxonomy from posts
 */
add_action(
  "init",
  function () {
    global $wp_taxonomies;
    $wp_taxonomies["category"]->object_type = [];
  },
  10
);

/**
 * Allows removing the prefix for category permalinks via
 * /wp-admin/options-permalink.php
 */
add_filter(
  "pre_term_link",
  function ($termlink, $term) {
    $taxonomy = $term->taxonomy;
    if ($taxonomy == "category" && empty(get_option("category_base"))) {
      $termlink = "%category%";
    }
    return $termlink;
  },
  10,
  2
);
