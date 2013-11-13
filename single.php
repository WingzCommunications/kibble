<?php
/**
 * The Template for displaying all single posts.
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
			<div class="titles"><h2><?php the_title();?></h2></div>

			<br/>

			<?php kibble_entry_meta();?>

			<br/><br/>

			<?php

			global $post;

			if ( get_post_meta($post->ID,'_kibble_video',true) ) {
				$url = get_post_meta( $post->ID, '_kibble_video', true );
				$video = wp_oembed_get( $url, array( 'width' => AVO_WIDTH , 'height' => AVO_HEIGHT) );
				echo '<div class="video">';
				echo apply_filters('the_content', $url);
				echo '</div>';
			}

			if ( !get_post_gallery()) {
				echo '<div class="posts2">';
				$large = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
				echo '<a href="'. $large .'"><img title="'. get_the_title($post->ID).'" src="'. $thumb[0] .'"></a>';
				echo '</div>';
			}

			?>

			<div class="posts3">
				<?php the_content();?>
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
