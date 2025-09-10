<?php
// 1. Basic Theme Setup
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
});

// 2. Add Admin Menu for License Key
add_action('admin_menu', function () {
    add_menu_page('Theme License', 'Theme License', 'manage_options', 'theme-license', function () {
        ?>
        <div class="wrap">
            <h1>Theme License Key</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('theme_license_group');
                do_settings_sections('theme-license');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    });
});

// 3. Register Setting Field
add_action('admin_init', function () {
    register_setting('theme_license_group', 'my_theme_license_key');

    add_settings_section('theme_license_section', '', null, 'theme-license');

    add_settings_field('my_theme_license_key', 'License Key', function () {
        $value = get_option('my_theme_license_key');
        echo '<input type="text" name="my_theme_license_key" value="' . esc_attr($value) . '" style="width: 300px;" />';
    }, 'theme-license', 'theme_license_section');
});

// 4. Inject Remote CSS in <head>
add_action('wp_head', function () {
    $key = get_option('my_theme_license_key');
    if (!$key) return;

    $css_url = 'https://your-remote-server.com/api/styles.css?key=' . urlencode($key);
    echo '<link rel="stylesheet" href="' . esc_url($css_url) . '" />';
});

// 5. Inject Remote JS in <footer>
add_action('wp_footer', function () {
    $key = get_option('my_theme_license_key');
    if (!$key) return;

    $js_url = 'https://your-remote-server.com/api/script.js?key=' . urlencode($key);
    echo '<script src="' . esc_url($js_url) . '"></script>';
});

// 6. Optionally Load Remote JSON Message
add_action('wp_footer', function () {
    $key = get_option('my_theme_license_key');
    if (!$key) return;

    $remote_url = 'https://your-remote-server.com/api/data?key=' . urlencode($key);
    $response = wp_remote_get($remote_url);

    if (!is_wp_error($response)) {
        $data = json_decode(wp_remote_retrieve_body($response), true);
        if (!empty($data['message'])) {
            echo '<div class="remote-message" style="text-align:center; padding:1em;">' . esc_html($data['message']) . '</div>';
        }
    }
});
