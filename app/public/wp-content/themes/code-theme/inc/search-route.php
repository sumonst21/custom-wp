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
                    'post_type' => get_post_type(),
                    'author_name' => get_the_author()
                ));
            }

            if (get_post_type() == 'professor') {
                array_push($university_data['professors'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'id' => get_the_id(),
                    'post_type' => get_post_type(),
                    'image' => get_the_post_thumbnail_url(0, 'professor_landscape')
                ));
            }

            if (get_post_type() == 'program') {
                array_push($university_data['programs'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'post_type' => get_post_type(),
                    'id' => get_the_id()
                ));
            }

            if (get_post_type() == 'event') {

                $the_event_date = new DateTime(get_field('event_date'));
                $description = null;
                if (has_excerpt()) {
                    $description = get_the_excerpt();
                } else {
                    $description = wp_trim_words(get_the_content(), 18);
                }

                array_push($university_data['events'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'post_type' => get_post_type(),
                    'author_name' => get_the_author(),
                    'month' => $the_event_date->format('M'),
                    'day' => $the_event_date->format('d'),
                    'description' => $description
                ));
            }

            if (get_post_type() == 'campus') {
                array_push($university_data['campuses'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'post_type' => get_post_type(),
                    'author_name' => get_the_author()
                ));
            }
            
        }

        if ($university_data['programs']) {
            
            $programs_meta_query = array('relation' => 'OR');

            foreach($university_data['programs'] as $program) {
                array_push($programs_meta_query, array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . $program['id'] . '"'
                ));
            }
    
            $program_relationship_query = new WP_Query(array(
                'post_type' => 'professor',
                'meta_query' => $programs_meta_query
            ));
    
            while($program_relationship_query->have_posts()) {
                $program_relationship_query->the_post();
    
                if (get_post_type() == 'professor') {
                    array_push($university_data['professors'], array(
                        'title' => get_the_title(),
                        'permalink' => get_the_permalink(),
                        'id' => get_the_id(),
                        'post_type' => get_post_type(),
                        'author_name' => get_the_author(),
                        'image' => get_the_post_thumbnail_url(0, 'professor_landscape')
                    ));
                }
            }
    
            // Remove duplicate results     
            $university_data['professors'] = array_values(array_unique($university_data['professors'], SORT_REGULAR));
        }

        return $university_data;
    }


?>