<?php
/**
 * The Template for displaying image attachments.
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

	<div class="thumbs">

	<center>

		<div class="left-column other">
			<ul>
				<?php $ids = array();?>
				<?php $args = array('posts_per_page' => 6, 'orderby' => 'rand');?>
				<?php $random_post = new WP_query($args); ?>
				<?php $i=1;?>

				<?php while ($random_post->have_posts()) : $random_post->the_post(); ?>
				<?php $ids[] = $post->ID;?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail();?></a></li>

				<?php if ($i == 3) {?>
			</ul>
		</div>

		<div class="right-column other">
			<ul>
				<?php }?>
				<?php $i++; endwhile;?>
				<?php //wp_reset_postdata();?>
			</ul>
		</div>

		<?php while ( have_posts() ) : the_post(); ?>
		<?php $ids[] = $post->ID;?>
			<div class="titles"><h2><?php echo get_the_title($post->post_parent);?></h2></div>

			<br/>

			<?php kibble_attachment_meta();?>

			<Br/><Br/>

			<?php kibble_the_attached_image(); ?>

			<br/><br/>
			<div class="imagenav">
			<?php previous_image_link( false, __( '<p style="float:left;">&larr; Previous</p>', 'kibble' ) ); ?>
			<?php next_image_link( false, __( '<p style="float:right;">Next &rarr;</p>', 'kibble' ) ); ?>
			</div>
		</div>
		<?php endwhile; ?>
	</div>

	<div class="clear"></div>

	<div class="bottom-row">

		<ul>
			<?php $args = array('posts_per_page' => 6, 'orderby' => 'rand', 'post__not_in' => $ids);?>
			<?php $random_bottom = new WP_query($args); ?>
			<?php while ($random_bottom->have_posts()) : $random_bottom->the_post(); ?>
			<?php if (!in_array($post->ID, $ids)) : ?>
				<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail();?></a></li>
			<?php endif; endwhile;?>
			<?php wp_reset_postdata();?>
		</ul>
	</div>

</div>

<?php get_footer(); ?>



