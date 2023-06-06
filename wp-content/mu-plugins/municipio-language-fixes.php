<?php

add_action("plugins_loaded", function () {
  load_muplugin_textdomain(
    "modularity",
    plugin_basename(MODULARITY_PATH) . "/languages"
  );
});
