<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div class="content">
			<div class="thumbs">
				<div class="title"><h2><?php printf( __( 'Search Results for: %s', 'kibble' ), get_search_query() ); ?></h2></div>

				<div class="posts">

				<ul>
					<?php while ( have_posts() ) : the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail();?></a></li>
					<?php endwhile; ?>
				</ul>

	<?php endif; ?>

</div>

<?php kibble_paging();?>

<?php get_footer(); ?>
