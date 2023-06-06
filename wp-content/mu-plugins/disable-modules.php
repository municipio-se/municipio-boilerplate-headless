<?php

// TODO: Move this to Municipio Gatsby plugin

/**
 * Return an array of post types that are supported in Gatsby
 */
function modularity_get_gatsby_supported_modules() {
  $gatsby_supported_modules = [
    "mod-image",
    "mod-fileslist",
    // "mod-gallery",
    // "mod-iframe",
    "mod-posts",
    "mod-contacts",
    // "mod-menu",
    // "mod-notice",
    // "mod-table",
    "mod-text",
    // "mod-video",
  ];
  $gatsby_supported_modules = apply_filters(
    "Modularity/gatsby_supported_modules",
    $gatsby_supported_modules
  );
  return $gatsby_supported_modules;
}

add_filter(
  "register_post_type_args",
  function ($args, $post_type_name) {
    $gatsby_supported_modules = modularity_get_gatsby_supported_modules();
    if (
      strpos($post_type_name, "mod-") === 0 &&
      !in_array($post_type_name, $gatsby_supported_modules)
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
//   "Modularity/Init",
//   function () {
//     $supported_modules = ["mod-image", "mod-text"];
//     $post_types = get_post_types([], "objects");
//     foreach ($post_types as $post_type_name => $post_type_object) {
//       if (
//         strpos($post_type_name, "mod-") === 0 &&
//         !in_array($post_type_name, $supported_modules)
//       ) {
//         // unregister_post_type($post_type_name);
//         // \Modularity\ModuleManager::$available;
//         unset(\Modularity\ModuleManager::$available[$post_type_name]);
//         // echo "<pre>",
//         //   var_export(array_keys(\Modularity\ModuleManager::$available), true),
//         //   "</pre>";
//       }
//     }
//     // exit();
//   },
//   20
// );

add_filter(
  "Modularity/module_is_available",
  function ($is_available, $post_type_name) {
    $gatsby_supported_modules = modularity_get_gatsby_supported_modules();
    if (
      strpos($post_type_name, "mod-") === 0 &&
      !in_array($post_type_name, $gatsby_supported_modules)
    ) {
      $is_available = false;
    }
    return $is_available;
  },
  10,
  2
);
