<?php

// Check if the function 'auto_theme_support' does not already exist
if (!function_exists('auto_theme_support')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     * @since auto
     * @return void
     */
    function auto_theme_support() {
        add_theme_support('wp-block-styles');
        add_editor_style('style.css');
        load_theme_textdomain('auto', get_template_directory() . '/languages');
    }

endif;
// Add the 'auto_theme_support' function to the 'after_setup_theme' action
add_action('after_setup_theme', 'auto_theme_support');

// Require the following PHP files
require_once get_template_directory() . '/quick-change.php';
require_once get_template_directory() . '/inc/api/index.php';
require_once get_template_directory() . '/inc/functions/index.php';
require_once get_template_directory() . '/inc/admin/index.php';
require_once get_template_directory() . '/inc/blocks/index.php';
require_once get_template_directory() . '/inc/frontend/index.php';
