<?php

// TODO: Move this to Municipio Gatsby plugin

/**
 * Return an array of modularity areas that are supported in Gatsby
 */
function modularity_get_gatsby_supported_areas() {
  $gatsby_supported_modules = [
    // "right-sidebar",
    "content-area",
    // "content-area-top",
    // "bottom-sidebar",
    // "footer-area",
    // "content-area-bottom",
    // "slider-area",
    // "top-sidebar",
    // "left-sidebar-bottom",
    // "left-sidebar",
  ];
  $gatsby_supported_modules = apply_filters(
    "Modularity/gatsby_supported_modules",
    $gatsby_supported_modules
  );
  return $gatsby_supported_modules;
}

/**
 * Unregister all modularity areas that are not supported in Gatsby
 */
add_action(
  "widgets_init",
  function () {
    global $wp_registered_sidebars;
    $gatsby_supported_areas = modularity_get_gatsby_supported_areas();
    foreach (array_keys($wp_registered_sidebars) as $sidebar) {
      if (!in_array($sidebar, $gatsby_supported_areas)) {
        unregister_sidebar($sidebar);
      }
    }
  },
  20
);
