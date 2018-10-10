<?php

get_header();

page_banner(array(
	'title' => 'Campus Locations',
	'subtitle' => 'We have campuses located throughout the top technology hubs in the world.',
))

?>



	<div class="container container--narrow page-section">

		<div class="acf-map">
			<?php

			while(have_posts()) {
				the_post();

				$map_location = get_field('map_location');

				?>

				<div class="marker" data-lat="<?php echo $map_location['lat']; ?>" data-lng="<?php echo $map_location['lng']; ?>">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php echo $map_location['address']; ?>

                </div>

			<?php } ?>
		</div>
	</div>

<?php get_footer();

?>