<?php 

    function careerdevs_files() {
        wp_enqueue_style('careerdevs_main_styles', get_stylesheet_uri());
    }

    add_action('wp_enqueue_scripts', 'careerdevs_files');