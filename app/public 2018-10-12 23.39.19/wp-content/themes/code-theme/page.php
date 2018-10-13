<?php get_header();


    while(have_posts()) {
        the_post();
        page_banner(array(
                'title' => 'Hello, World.',
                'subtitle' => 'We\'re just getting started.',
                'photo' => 'https://images.unsplash.com/photo-1527427337751-fdca2f128ce5?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=7f0965bc37ef09044780baa8af91e2b3&auto=format&fit=crop&w=1050&q=80'
        ));

        ?>

        <div class="container container--narrow page-section">

            <?php

                $the_parent = wp_get_post_parent_id(get_the_ID());

                if ($the_parent) { ?>
                    <div class="metabox metabox--position-up metabox--with-home-link">
                    <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($the_parent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($the_parent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
                    </div>
                <?php }
            ?>

            <?php 
            
            $test_arr = get_pages(array(
                'child_of' => get_the_ID()
            ));
            
            if ($the_parent or $test_arr) { ?>

            <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($the_parent); ?>"><?php echo get_the_title($the_parent); ?></a></h2>
            <ul class="min-list">
                <?php
                
                if ($the_parent) {
                    // If page is a child page
                    // Find children of the parent
                    $find_children_of = $the_parent;

                } else {
                    // Otherwise, get the ID of the parent
                    // And print child pages
                    $find_children_of = get_the_ID();

                }

                wp_list_pages(array(
                    'title_li' => NULL,
                    'child_of' => $find_children_of,
                    'sort_column' => 'menu_order'

                )); ?>
            </ul>
            </div>

            <?php }?>

            <div class="generic-content">
            <?php the_content() ?>
            </div>

        </div>

    <?php }

get_footer(); ?>