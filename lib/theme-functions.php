<?php

/**
 * Post Meta information
 *
*/

function kibble_entry_meta() {
	$date = sprintf( 'posted <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'kibble' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( human_time_diff(get_post_time()) . ' ago')
	);

	echo $date;

	$cats = get_the_category($post->ID);
	$mycategory = get_category_link($cats[0]->term_id);
	echo ' in <a href="'.$mycategory.'" class="cat">'.$cats[0]->cat_name.'</a>';

	$tags = get_the_tags();

	if($tags) {
		foreach ($tags as $tag){
			$tag_link = get_tag_link($tag->term_id);
			$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
			$html .= "{$tag->name}</a>, ";
		}
		echo ' and tagged with ' . substr($html,0,-2);;
	}

	printf( ' by <a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'kibble' ), get_the_author() ) ),
		get_the_author()
	);
}

/**
 * Attachment Meta Information
 *
*/

function kibble_attachment_meta() {
	global $post;
	$post_title = get_the_title( $post->post_parent );

	$date = sprintf( 'posted <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a> in <a href="%1$s" rel="bookmark">%2$s</a>',
		esc_url( get_permalink($post->post_parent)),
		esc_attr(get_the_title($post->post_parent)),
		esc_attr( human_time_diff(get_post_time()) . ' ago')

	);

	echo $date;

	printf( ' by <a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'kibble' ), get_the_author() ) ),
		get_the_author()
	);

}

/**
 * Pagination with 1,2,3,4 links
 *
*/

function kibble_paging($before = '', $after = '') {
	global $wpdb, $wp_query;

	if ( !is_single() && $wp_query->max_num_pages > 1 ) {

	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<div class="pagination"><ul class="clearfix">'."";
	if ($paged > 1) {
		$first_page_text = "«";
		echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
	}
		
	$prevposts = get_previous_posts_link('← Previous');
	if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
	else { echo '<li class="disabled"><a href="#">← Previous</a></li>'; }
	
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next →');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "»";
		echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
	}
	echo '</ul></div>'.$after."";
	}
}


