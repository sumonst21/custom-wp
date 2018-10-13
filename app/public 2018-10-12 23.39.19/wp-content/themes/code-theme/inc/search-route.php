<?php 

    add_action('rest_api_init', 'university_register_search');

    function university_register_search() {
        register_rest_route('university/v1', 'search', array(
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => 'university_search_results'
        ));
    }

    function university_search_results($data) {
        $university_query = new WP_Query(array(
            'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
            's' => sanitize_text_field($data['term']) 
        ));

        $university_data = array(
            'general_info' => array(),
            'professors' => array(),
            'programs' => array(), 
            'events' => array(), 
            'campuses' => array()
        );

        while($university_query->have_posts()) {
            $university_query->the_post();

            if (get_post_type() == 'post' OR get_post_type() == 'page') {
                array_push($university_data['general_info'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }

            if (get_post_type() == 'professor') {
                array_push($university_data['professors'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }

            if (get_post_type() == 'program') {
                array_push($university_data['programs'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }

            if (get_post_type() == 'event') {
                array_push($university_data['events'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }

            if (get_post_type() == 'campus') {
                array_push($university_data['campuses'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }
            
        }

        return $university_data;
    }


?>