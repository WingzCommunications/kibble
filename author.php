<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

	<?php if ( have_posts() ) : the_post();?>

		<div class="content">
			<div class="thumbs">

				<div class="title"><h2><?php printf( __( 'All posts by %s', 'kibble' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h2></div>

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
