<?php

function disable_taxonomy($taxonomy) {
  add_action("init", function () use ($taxonomy) {
    register_taxonomy($taxonomy, []);
  });
  add_filter("disabled_taxonomies", function ($disabled_taxonomies) use (
    $taxonomy
  ) {
    $disabled_taxonomies[] = $taxonomy;
    return $disabled_taxonomies;
  });
}

function get_disabled_taxonomies() {
  return apply_filters("disabled_taxonomies", []);
}

function taxonomy_disabled($taxonomy) {
  return in_array($taxonomy, get_disabled_taxonomies());
}
