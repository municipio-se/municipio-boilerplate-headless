<?php

function add_upgrade($name, $callback) {
  add_action("init", function () use ($name, $callback) {
    if (get_option("upgrade_{$name}_done")) {
      return;
    }
    $callback();
    update_option("upgrade_{$name}_done", 1);
  });
}

add_upgrade("add_frontpage", function () {
  $post_id = wp_insert_post([
    "post_title" => __("Home"),
    "post_type" => "page",
    "post_status" => "publish",
    "post_content" =>
      "<h1>" .
      __("Welcome to Whitespace Municipio") .
      "</h1>\n" .
      __("This is your new front page. Edit it according to your needs.") .
      "",
    "post_author" => 1,
    "menu_order" => -99,
  ]);
  update_option("show_on_front", "page");
  update_option("page_on_front", $post_id);
});
