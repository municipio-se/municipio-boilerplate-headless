<?php

add_action(
  "init",
  function () {
    if (function_exists("acf_remove_local_field_group")) {
      // Logotype
      acf_remove_local_field_group("group_56a0f1f7826dd");
      // Cookie consent
      acf_remove_local_field_group("group_56bc6b6466df1");
      // Favicon
      acf_remove_local_field_group("group_56cc39aba8782");
      // GDPR
      acf_remove_local_field_group("group_5ac334058cc33");
      // 2.0 Enabler
      acf_remove_local_field_group("group_5aa14b41551ae");
    }
  },
  20
);

add_action("acf/init", function () {
  acf_add_options_sub_page([
    "page_title" => __("Content types", "mu_plugins"),
    "menu_title" => __("Content types", "mu_plugins"),
    "menu_slug" => "acf-options-post-types",
    "parent_slug" => "options-general.php",
    "capability" => "manage_options",
    "position" => 6,
    "icon_url" => "dashicons-admin-generic",
    "post_id" => "acf-options-post-types",
    "autoload" => true,
  ]);
});

function get_togglable_post_types() {
  $post_types = get_post_types([], "objects");
  $post_types = array_filter($post_types, function ($post_type) {
    return ($post_type->menu_icon &&
      (!preg_match(
        "/^mod-|^wp_|^acf-|^page$|^attachment$/",
        $post_type->name
      ) &&
        !$post_type->_builtin)) ||
      $post_type->name == "post";
  });
  return $post_types;
}

function get_ui_enabled_post_types() {
  // Using `get_field` here is not possible because the options page is not guaranteed to have been registered yet. We have to use `get_option` instead.
  return get_option(
    "acf-options-post-types_post_type_settings_enabled_post_types"
  ) ?:
    [];
}

add_action(
  "init",
  function () {
    if (!function_exists("acf_add_local_field_group")) {
      return;
    }
    acf_remove_local_field_group("group_56b34353ef1eb");
    acf_remove_local_field_group("group_56c6ba934d682");
    acf_add_local_field_group([
      "key" => "group_mu_post_type_settings",
      "title" => __("Post type settings", "mu_plugins"),
      "location" => [
        [
          [
            "param" => "options_page",
            "operator" => "==",
            "value" => "acf-options-post-types",
          ],
        ],
      ],
    ]);
    $post_types = get_togglable_post_types();
    $field = [
      "parent" => "group_mu_post_type_settings",
      "key" => "field_mu_post_type_settings_enabled_post_types",
      "label" => __("Enabled post types", "mu_plugins"),
      "name" => "post_type_settings_enabled_post_types",
      "type" => "checkbox",
      "choices" => array_combine(
        array_keys($post_types),
        array_map(function ($post_type) {
          return $post_type->labels->name;
        }, $post_types)
      ),
    ];
    // echo '<pre>', var_export($field, true), '</pre>';exit;
    acf_add_local_field($field);
    // $taxonomies = get_taxonomies(["public" => true], "objects");
    // foreach ($post_types as $post_type) {
    //   $field = [
    //     "parent" => "group_mu_post_type_settings",
    //     "key" => "field_mu_post_type_settings_{$post_type->name}",
    //     "label" => __("Enabled taxonomies", "mu_plugins"),
    //     "name" => "post_type_settings_{$post_type->name}",
    //     "type" => "group",
    //     "sub_fields" => [
    //       [
    //         "key" => "field_mu_post_type_settings_{$post_type->name}_enabled",
    //         "label" => __("Enabled", "mu_plugins"),
    //         "name" => "enabled",
    //         "type" => "true_false",
    //       ],
    //       [
    //         "key" => "field_mu_post_type_settings_{$post_type->name}_taxonomies",
    //         "label" => __("Enabled taxonomies", "mu_plugins"),
    //         "name" => "taxonomies",
    //         "type" => "checkbox",
    //         "choices" => array_combine(
    //           array_keys($post_type->taxonomies),
    //           array_map(function ($taxonomy) {
    //             return get_taxonomy($taxonomy)->labels->name;
    //           }, $post_type->taxonomies)
    //         ),
    //       ],
    //     ],
    //   ];
    // echo '<pre>', var_export($field, true), '</pre>';exit;
    // acf_add_local_field($field);
    // $taxonomies = get_taxonomies(["public" => true], "objects");
    // foreach ($taxonomies as $taxonomy_name => $taxonomy) {
    //   if (taxonomy_disabled($taxonomy_name)) {
    //     continue;
    //   }
    //   $field = [
    //     "parent" => "group_mu_taxonomy_settings",
    //     "key" => "field_mu_taxonomy_settings_{$taxonomy_name}_post_types",
    //     "label" => sprintf(
    //       __("Enable %s on these post types", "mu_plugins"),
    //       $taxonomy->labels->name
    //     ),
    //     "name" => "taxonomy_settings_{$taxonomy_name}_post_types",
    //     "type" => "checkbox",
    //     "choices" => array_combine(
    //       array_keys($post_types),
    //       array_map(function ($post_type) {
    //         return $post_type->labels->name;
    //       }, $post_types)
    //     ),
    //   ];
    //   // echo '<pre>', var_export($field, true), '</pre>';exit;
    //   acf_add_local_field($field);
    // }
  },
  20
);

add_filter(
  "register_post_type_args",
  function ($args, $post_type_name) {
    $post_types = ["post"];
    $enabled_post_types = get_ui_enabled_post_types();
    if (
      in_array($post_type_name, $post_types) &&
      !in_array($post_type_name, $enabled_post_types)
    ) {
      $args["show_ui"] = false;
      $args["public"] = false;
    }
    return $args;
  },
  20,
  2
);

// add_action(
//   "init",
//   function () {
//     acf_add_local_field_group([
//       "key" => "group_mu_taxonomy_settings",
//       "title" => __("Taxonomy settings", "mu_plugins"),
//       "location" => [
//         [
//           [
//             "param" => "options_page",
//             "operator" => "==",
//             "value" => "acf-options-theme-options",
//           ],
//         ],
//       ],
//     ]);
//     $post_types = get_post_types(["public" => true], "objects");
//     $taxonomies = get_taxonomies(["public" => true], "objects");
//     foreach ($taxonomies as $taxonomy_name => $taxonomy) {
//       if (taxonomy_disabled($taxonomy_name)) {
//         continue;
//       }
//       $field = [
//         "parent" => "group_mu_taxonomy_settings",
//         "key" => "field_mu_taxonomy_settings_{$taxonomy_name}_post_types",
//         "label" => sprintf(
//           __("Enable %s on these post types", "mu_plugins"),
//           $taxonomy->labels->name
//         ),
//         "name" => "taxonomy_settings_{$taxonomy_name}_post_types",
//         "type" => "checkbox",
//         "choices" => array_combine(
//           array_keys($post_types),
//           array_map(function ($post_type) {
//             return $post_type->labels->name;
//           }, $post_types)
//         ),
//       ];
//       // echo '<pre>', var_export($field, true), '</pre>';exit;
//       acf_add_local_field($field);
//     }
//   },
//   20
// );

// add_filter(
//   "register_taxonomy_args",
//   function ($args, $taxonomy_name, $object_type) {
//     if (taxonomy_disabled($taxonomy_name)) {
//       return $args;
//     }
//     $post_types = get_field(
//       "field_mu_taxonomy_settings_{$taxonomy_name}_post_types",
//       "option"
//     );
//     if (empty($post_types)) {
//       $post_types = [];
//     }
//     $args["object_type"] = $post_types;
//     // echo "<pre>",
//     //   var_export([$taxonomy_name, $args["object_type"]], true),
//     //   "</pre>";
//     // exit();
//     return $args;
//   },
//   10,
//   3
// );

// add_filter(
//   "register_post_type_args",
//   function ($args, $post_type_name) {
//     $taxonomies = get_taxonomies(["public" => true], "objects");
//     $args["taxonomies"] = [];
//     foreach ($taxonomies as $taxonomy_name => $taxonomy) {
//       if (taxonomy_disabled($taxonomy_name)) {
//         continue;
//       }
//       $enabled_post_types =
//         get_field(
//           "field_mu_taxonomy_settings_{$taxonomy_name}_post_types",
//           "option"
//         ) ?:
//         [];
//       if (in_array($post_type_name, $enabled_post_types)) {
//         $args["taxonomies"][] = $taxonomy_name;
//       }
//     }
//     error_log(var_export($args, true));
//     return $args;
//   },
//   10,
//   3
// );
