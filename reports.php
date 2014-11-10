<?php
/**
 * Template Name: Reports (Custom)
 * Author:  Matt McGivney (http://antym.com)
*/
?>

<?php add_action('wp_head','hook_css_right_sidebar'); ?>
<?php function hook_css_right_sidebar() {
		$output='<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/css/right-sidebar.css">';
		echo $output;
	
	}
?>
<?php session_start(); ?>
<?php $_SESSION['referrer']=get_permalink();?>
<?php $paramStr = $_SESSION['referrer'];?>
<?php $paramStr = "'". site_url() . '/viewers/?referrer=' . $paramStr . "'";?>

<?php get_header(); ?>





	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<?php get_template_part( 'content', 'page' ); ?>
		<?php echo $html;?>

		<?php endwhile; endif; ?>
			

		</main><!-- #main -->
		

	</section><!-- #primary -->

		<div id="masthead2">
					<div class="widgets" style="margin-top:7px;">
						<div id="text-6" class="widget widget_text">
								<div id="member-activity-container">
									<div class="first-line">
										<span style="text-align: center; font-size: 20px">
											<a href="http://mvmem.com/announcements" title="See what's new on the site">What's New</a>
										</span>
									</div>
									<div class="second-line" style="font-size: 17px;">
										<span style="float:left;">
											<a href="http://www.calendarwiz.com/calendars/calendar.php?crd=mvmem&&jsenabled=1&winh=759&winw=1600&inifr=false" target="_blank" title="View the calendar">Calendar</a>
										</span>
										<span style="float:right;">
											<a href="http://mvmem.com/questions" title="Ask a question">Questions</a>
										</span>
									</div>
									<div class="third-line">
										<span style="text-align:center; font-size: 17px;">
											<a href="http://mvmem.com/whos-who" title="Learn about the people on this page">Who's Who</a>
										</span>
									</div>
									<div class="fourth-line" style="font-size: 17px;">
										<span style="float:left;">
											<a href="http://mvmem.com/suggest" title="Leave some feedback about our site">Suggest</a>
										</span>
										<span style="float:right;">
											<a href="http://mvmem.com/tell-me" title="Contact Spencer directly">Tell me</a>
										</span>
									</div>
									<div class="fifth-line">
										<br>
										<span style="text-align:center; font-size: 14px;"><a id="viewers-link" title="Click to see a list of users who have viewed this page." onclick="openWin(<?php echo  $paramStr; ?>); return false;" href="">Viewed This Page</a></span>
									</div>
								</div>
						</div>
					</div><!-- end class="widgets" -->
		</div>

<?php 
			//add_filter( 'the_content', 'mvmem_get_gallery_ids' );
			
			//returns a String containing the list of IDs in this post's gallery
			function mvmem_get_gallery_ids() {
			global $post;
			
			// Make sure the post has a gallery in it
			 	if(!has_shortcode($post->post_content,'gallery')) {
			 		return $post->post_content;
			 	}
			// Retrieve the first gallery in the post
			 	$gallery = get_post_gallery($post,false);
		
			 	return $gallery['ids'];
		 	}
?>

<?php get_footer(); ?>

