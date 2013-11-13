<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

<?php if(is_home() && !is_paged() ) {?>
	<div class="content">
		<div class="thumbs">

			<div class="title"><h2>Random Submissions</h2></div>

			<div class="posts">
				<ul>
					<?php $args = array('posts_per_page' => 7, 'orderby' => 'rand');?>
					<?php $random_home = new WP_query($args); ?>
						<?php while ($random_home->have_posts()) : $random_home->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail();?></a></li>
						<?php endwhile;?>
						<?php wp_reset_postdata();?>
				</ul>
			</div>

		</div>
	</div>
<?php } ?>
	<?php if ( have_posts() ) : ?>

		<div class="content">
			<div class="thumbs">

			<div class="title"><h2>Recent Submissions (<?php $count_posts = wp_count_posts(); echo $count_posts->publish;?> total submissions)</h2></div>

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
