<?php

add_action(
  "init",
  function () {
    global $wp_post_types;
    $wp_post_types["post"]->taxonomies = [];
  },
  90
);
