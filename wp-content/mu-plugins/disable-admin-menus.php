<?php

add_action(
  "admin_menu",
  function () {
    // Remove Appearence and move Appearence > Menus to top level
    remove_submenu_page("themes.php", "nav-menus.php"); // Menus
    remove_menu_page("themes.php"); // Appearance
    add_menu_page(
      __("Menus"),
      __("Menus"),
      "edit_theme_options",
      "nav-menus.php",
      "",
      "dashicons-list-view",
      61
    );
    // Remove Settings > Discussion because comments are not supported
    remove_submenu_page("options-general.php", "options-discussion.php"); // Comments
  },
  20
);
