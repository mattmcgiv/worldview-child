<?php
/*
Template Name: Thanks Page
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
	
		$output="<style> 
		#g688-name {color: black !important; }
		#g688-email {color: black !important; }
		#g688-phonenumber {color: black !important; }
		#g688-comment {color: black !important; }
		#contact-form-comment-g688-comment {color: black !important;}
		div.menu-button {display:none;}
		.entry-content a {color:blue !important; text-decoration:underline !important;}
		</style>";
		echo $output;
	}
?>

<script>
function closeThanksPage() {
	open(location, '_self').close();
}
</script>