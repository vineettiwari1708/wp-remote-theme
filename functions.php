<?php
// Define your license key (or fetch it from options, database, or constants)
define('REMOTE_THEME_LICENSE_KEY', 'demo-key-123');

// URL to your inject.php hosted on a remote server
define('REMOTE_INJECT_URL', 'https://yourserver.com/inject.php');

// Inject the remote JS via wp_head
add_action('wp_head', function () {
    $key = REMOTE_THEME_LICENSE_KEY;
    $inject_url = REMOTE_INJECT_URL . '?key=' . urlencode($key);

    echo '<script src="' . esc_url($inject_url) . '" async defer></script>';
});





add_action('admin_menu', function () {
    add_options_page('Remote Theme Settings', 'Remote Theme', 'manage_options', 'remote-theme', function () {
        ?>
        <div class="wrap">
            <h1>Remote Theme Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('remote_theme_settings');
                do_settings_sections('remote-theme');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    });
});

add_action('admin_init', function () {
    register_setting('remote_theme_settings', 'remote_theme_license_key');

    add_settings_section('main_section', 'Main Settings', null, 'remote-theme');

    add_settings_field(
        'license_key',
        'License Key',
        function () {
            $value = get_option('remote_theme_license_key', '');
            echo '<input type="text" name="remote_theme_license_key" value="' . esc_attr($value) . '" size="40">';
        },
        'remote-theme',
        'main_section'
    );
});
