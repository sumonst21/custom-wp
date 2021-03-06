<?php 

	function page_banner($args = NULL) {

        if (!$args['title']) {
            // if no custom title is provided, use wordpress
            // page title as fallback
            $args['title'] = get_the_title();
        }

        if (!$args['subtitle']) {
            $args['subtitle'] = get_field('page_banner_subtitle');
        }

        if (!$args['photo']) {
            if (get_field('page_banner_background_image')) {
                $args['photo'] = get_field('page_banner_background_image')['sizes']['page_banner'];
            } else {
                $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
            }

        }

		?>

		<div class="page-banner">
			<div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
			<div class="page-banner__content container container--narrow">
				<h1 class="page-banner__title">
                    <?php echo $args['title']; ?>
                </h1>

				<div class="page-banner__intro">
					<p><?php echo $args['subtitle']; ?></p>
				</div>
			</div>
		</div>

<?php	}

    function code_university_files() {
        wp_enqueue_script('google_map', '//maps.googleapis.com/maps/api/js?key=AIzaSyCkcCStInG-48Pej7loTDwbyoU7L5xfOV0', NULL, '1.0', true);
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

        add_theme_support('post-thumbnails');

        add_image_size('professor_landscape', 400, 260, true);
        add_image_size('professor_portrait', 480, 650, true);
        add_image_size('page_banner', 1500, 350, true);
    }

    add_action('after_setup_theme', 'code_university_features');

    function university_adjust_queries($query) {

	    if (!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query() ) {
		    $query->set('posts_per_page', -1);

	    }

        if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query() ) {
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', -1);

        }
        
        if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
            
            $today = date('Ymd');

            $query->set('meta_key', 'event_date');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'ASC');
            $query->set('meta_query', array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric'
                )
                ));
        }
    }

    add_action('pre_get_posts', 'university_adjust_queries');

    function university_map_key($api) {
        $api['key'] = 'AIzaSyCkcCStInG-48Pej7loTDwbyoU7L5xfOV0';
        return $api;
    }

    add_filter('acf/fields/google_map/api', 'university_map_key');