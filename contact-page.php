<?php
/*
Template Name: Contact Page
Author:  Matt McGivney (http://antym.com)
*/
?>

<?php
/**
 * The contact page template file.
 *
 * This is the template file for generic pages in WordPress.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package worldview
 */
?>

<?php add_action('wp_head','hook_css'); ?>
<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>

<?php
	function hook_css() {
	
		$output='<style> 
		#g688-name {color: black !important; }
		#g688-email {color: black !important; }
		#g688-phonenumber {color: black !important; }
		#g688-comment {color: black !important; }
		#contact-form-comment-g688-comment {color: black !important;}
		div.menu-button {display:none;}
		input[type="text"], input[type="search"], input[type="password"], input[type="email"], input[type="date"], input[type="url"], input[type="phone"], select, textarea { outline: 1px solid gray; width: 100%; height: 40px; margin-top: 10px; display: block; border: 1px solid gray !important; vertical-align: middle; font-size: 1em; background-color: #fff; color: #333; padding: 8px 10px; font-family: "Lato", sans-serif; -webkit-border-radius: 4px; -moz-border-radius: 4px; -ms-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; -webkit-appearance: none; -moz-appearance: none; appearance: none; text-indent: 0.01px; text-overflow: ""; }
input[type="text"]:focus, input[type="search"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="date"]:focus, input[type="url"]:focus, input[type="phone"]:focus, select:focus, textarea:focus { background-color: #fff; border: 1px solid gray; }
		</style>';
		echo $output;
	}
?>