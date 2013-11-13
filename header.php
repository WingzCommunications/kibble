<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till the nav menu
 *
 * @package WordPress
 * @subpackage kibble
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body>

	<div id="wrapper">

	<?php if(!is_single()) { ?>
		<div id="header">

			<h1><?php bloginfo('name');?></h1>

			<p class="header">
				<?php wp_nav_menu(array ('depth' => 0, 'items_wrap' => '%3$s', 'menu' => 'primary', 'container' => false, 'fallback_cb' => 'kibble_custom_page_menu_fallback', 'walker' => new kibble_Menu_Walker()));?>
			</p>

		</div>

	<?php } ?>

	<?php if(is_single()) {?>
		<div class="content">

		<br/><br/>

		<center>
			<?php wp_nav_menu(array ('depth' => 0, 'items_wrap' => '%3$s', 'menu' => 'primary', 'container' => false, 'fallback_cb' => 'kibble_custom_page_menu_fallback', 'walker' => new kibble_Menu_Walker()));?>
		</center>

		<br/>

	<?php } ?>
