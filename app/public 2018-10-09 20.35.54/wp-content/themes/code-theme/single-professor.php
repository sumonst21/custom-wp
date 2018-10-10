<?php get_header();


    while(have_posts()) {
        the_post();
        page_banner();
        ?>

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