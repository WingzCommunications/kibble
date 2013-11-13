<?php
/**
 * The template for displaying Tag pages.
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div class="content">
		<div class="thumbs">

			<?php $mytags = get_query_var('tag');?>
			<?php $mytags = str_replace('+',' and ', $mytags);?>
			<?php $mytags = str_replace(',',' or ', $mytags);?>

			<div class="title"><h2>Tag Archives for: <?php echo $mytags;?></h2></div>

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

