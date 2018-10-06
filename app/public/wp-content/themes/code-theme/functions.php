<?php 

    function code_university_files() {
        wp_enqueue_script('main_code_university_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
        wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('code_university_main_styles', get_stylesheet_uri(), NULL, microtime());
    }

    add_action('wp_enqueue_scripts', 'code_university_files');

    function code_university_features() {
        register_nav_menu('header_menu_location', 'Header Menu Location');
        register_nav_menu('footer_menu_location_1', 'Footer Menu Location 1');
        register_nav_menu('footer_menu_location_2', 'Footer Menu Location 2');

        add_theme_support('title-tag');
    }

    add_action('after_setup_theme', 'code_university_features');