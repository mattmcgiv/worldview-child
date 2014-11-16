<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and website header
 *
 * @package worldview
 */
?>

<?php add_action('wp_head','hook_css_2'); ?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->



<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/style.css';?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/mmm-window.js"></script>
	<?php wp_head(); ?>
</head>

<?php do_action('ase_theme_body_before'); // Aesop Universal Theme Hook ?>

<body <?php body_class(); ?>>

<?php do_action('ase_theme_body_inside_top'); // Aesop Universal Theme Hook ?>
<?php do_action('aesop_inside_body_top'); // Aesop Pre 1.0.5 Compatibility ?>

<header id="masthead">

	<?php do_action('ase_theme_header_inside_top'); // Aesop Universal Theme Hook ?>

	<div class="menu-button">
		<div class="menu-icon">
			<span class="top"></span>
			<span class="mid"></span>
			<span class="bot"></span>
		</div>
		<div class="menu-text">
			<?php _e('<span>Hide</span>Menu','worldview'); ?>
		</div>
	</div>

	<div class="split-columns">

		<div class="split-left">

			<?php get_sidebar('masthead'); ?>

		</div>

		<div class="split-right">

			<?php if( get_header_image() ): ?>
			<div id="author-avatar">
				<a href="<?php echo esc_url( 'http://mvmem.com/spencers-info' ); ?>"><img class="no-grav" src="<?php echo get_header_image(); ?>" alt=""></a>
			</div>
			<?php endif; ?>

			<h1 id="blog-title"><a href="<?php echo esc_url( 'http://mvmem.com/' ); ?>"><?php bloginfo('name'); ?></a></h1>
			<div class="desc"><?php bloginfo('description'); ?></div>

			
			<div class="widgets">
				<div id="text-6" class="widget widget_text">
				<br>
					<h2 class="widgettitle">Keep in touch!</h2>
						<div class="textwidget"> Spencer Wulwick<br>
							1901 N Andrews Ave Apt 107<br>
							Wilton Manors FL  33311-3928
							<p>
								(954) 900-2994
							<p>
							<a href= "mailto:spencer@mvmem.com">spencer@mvmem.com</a>
						</div>
				</div>
			</div>
			
			<?php get_template_part('menu','social'); ?>

		</div>

	</div>

	<?php do_action('ase_theme_header_inside_bottom'); // Aesop Universal Theme Hook ?>

</header>

<?php do_action('ase_theme_header_after'); // Aesop Universal Theme Hook ?>

<div id="main-content-area" class="content-wrapper">

<!--PJAX-->

<?php


	
	function hook_css_2() {
	
		$output="<style>
		.widgets {width: 225px; margin-left: auto !important; margin-right: auto !important;} 
		.widgettitle{text-align: left !important; color: rgba(255, 255, 255, 0.6); font-size: 1em !important;}
		.textwidget{line-height: 1.5 !important; color: rgba(255, 255, 255, 0.9); font-size: 60% !important; text-align: left !important;}
		.textwidget a {color: #f9d236 !important;}
		main a { color: blue !important; text-decoration: underline !important; border-bottom: none !important;}
		</style>";
		echo $output;
	
	}
?>
