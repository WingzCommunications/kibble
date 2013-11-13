<?php
/**
 * Template Name: Category Image Index
 *
 * The template for displaying Category Images.
 *
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

	<div class="content">
		<div class="thumbs">

			<div class="title"><h2>Our Categories</h2></div>

				<div id="channel_container">

				<?php
				$terms = get_terms('category');
				foreach ( $terms as $term ) {
					$image = kibble_get_taxonomy_image_src($term,'full');
					echo '<div class="spot">' . PHP_EOL;
					echo '<a href="' . esc_url( get_term_link( $term ) ) . '"><img src="' . $image['src'] . '" width="'. $image['width'] .'" height="'. $image['height'] .'" /></a>' . PHP_EOL;
					echo '<small class="caption copyright"><span>'.$term->name.'</span></small>'. PHP_EOL;
					echo '</div>' . PHP_EOL . PHP_EOL;
				}
				?>

				</div>

		</div>
	</div>

<?php get_footer(); ?>
