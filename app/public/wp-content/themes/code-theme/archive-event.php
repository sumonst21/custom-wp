<?php

get_header();

page_banner(array(
        'title' => 'All Events',
    'subtitle' => 'Get involved in the coding community!'
));

?>

  <div class="container container--narrow page-section">

    <?php 

      while(have_posts()) {
        the_post();
        get_template_part('template-parts/content', 'event');

      }

        echo paginate_links();
        
    ?>
        <hr class="section-break"/>

        <p>Looking for a recap of our past events? <a href="<?php echo site_url('/past-events') ?>">Check out our past events archive!</a></p>

  </div>

<?php get_footer();

?>