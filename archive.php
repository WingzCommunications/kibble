<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage kibble
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div class="content">
		<div class="thumbs">

		<div class="title">
			<h2><?php if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'kibble' ), get_the_date() );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'kibble' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'kibble' ) ) );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'kibble' ), get_the_date( _x( 'Y', 'yearly archives date format', 'kibble' ) ) );
				else :
					_e( 'Archives', 'kibble' );
				endif;?></h2>
		</div>

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
