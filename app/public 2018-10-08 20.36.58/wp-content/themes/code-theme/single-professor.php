<?php get_header();


    while(have_posts()) {
        the_post(); ?>

        <div class="page-banner">
                <div class="page-banner__bg-image" style="background-image: url(<?php $page_banner_image = get_field('page_banner_background_image'); echo $page_banner_image['sizes']['page_banner']; ?>);"></div>
                <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php the_title(); ?></h1>

                <div class="page-banner__intro">
                    <p><?php the_field('page_banner_subtitle') ?></p>
                </div>
                </div>  
        </div>

        <div class="container container--narrow page-section">
            <div class="generic-content">
                <div class="row group">
                    <div class="one-third">
                        <?php the_post_thumbnail('professor_portrait');?>
                    </div>
                    <div class="two-thirds">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php

                $related_programs = get_field('related_programs');
//                print_r($related_programs);

            if ($related_programs) {

                echo '<hr class="section-break"/>';
                if (count($related_programs) == 1) {
                    echo '<h2 class="headline headline--medium">Subject Taught</h2>';
                } else {
                    echo '<h2 class="headline headline--medium">Subjects Taught</h2>';
                }

                echo '<ul class="link-list min-list">';

                foreach ($related_programs as $program) { ?>

                    <li>
                        <a href="<?php the_permalink($program) ?>">
                            <?php echo get_the_title($program); ?>
                        </a>
                    </li>

                <?php }

                echo '</ul>';

            }
            ?>
        </div>
    <?php }

get_footer(); ?>