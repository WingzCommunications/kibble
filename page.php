<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

	<div class="thumbs">

		<center>

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="titles"><h2><?php the_title();?></h2></div>

				<div class="clear"></div>
				<?php kibble_entry_meta();?>
				<div class="clear"></div>
				<?php the_content();?>
			<?php endwhile; ?>

	</div>
	<div class="clear"></div>

</div>

<?php get_footer(); ?>
