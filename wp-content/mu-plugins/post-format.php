<?php

add_action("muplugins_loaded", function () {
  disable_taxonomy("post_format");
});
