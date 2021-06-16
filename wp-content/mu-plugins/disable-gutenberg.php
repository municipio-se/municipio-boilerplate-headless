<?php
/*
Plugin Name: Disable Gutenberg
Description: Disables Gutenberg for all posts
*/

// Disable Gutenberg for all posts
add_filter('use_block_editor_for_post_type', '__return_false', 10);
