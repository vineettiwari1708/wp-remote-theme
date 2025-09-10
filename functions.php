<?php
// Enqueue remote CSS and JS from your server/git repo
function remote_control_enqueue_scripts() {
    $base_url = 'https://yourserver.com/data'; // Change to your real remote URL

    // Enqueue remote CSS
    wp_enqueue_style('remote-styles', $base_url . '/styles.css', array(), null);

    // Enqueue remote JS
    wp_enqueue_script('remote-scripts', $base_url . '/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'remote_control_enqueue_scripts');
