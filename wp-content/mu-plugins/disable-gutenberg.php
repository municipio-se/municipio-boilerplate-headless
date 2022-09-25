<?php

/**
 * Disable Gutenberg for all posts
 */
add_filter("use_block_editor_for_post_type", "__return_false", 10);
