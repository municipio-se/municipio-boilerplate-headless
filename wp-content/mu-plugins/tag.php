<?php

add_action("muplugins_loaded", function () {
  disable_taxonomy("post_tag");
});

/**
 * Allows removing the prefix for tag permalinks via
 * /wp-admin/options-permalink.php
 */
add_filter(
  "pre_term_link",
  function ($termlink, $term) {
    $taxonomy = $term->taxonomy;
    if ($taxonomy == "post_tag" && empty(get_option("tag_base"))) {
      $termlink = "%post_tag%";
    }
    return $termlink;
  },
  10,
  2
);
