<?php
/**
 * The page template file.
 *
 * This is the template file for generic pages in WordPress.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package worldview
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
		<?php $mvmem_gallery_array = explode(',',mvmem_get_gallery_ids()); ?>
		<?php //var_dump($mvmem_gallery_array);?>
		<?php //echo count($mvmem_gallery_array);?>
			<?php get_template_part( 'content', 'page' ); ?>

			<?php 
			for ($i=0; $i<count($mvmem_gallery_array); $i++) {
				
				$wpdb->query('UPDATE `mvmemcom_wo7109`.`wp_qfav_posts` SET `menu_order` = '.$i.' WHERE `wp_qfav_posts`.`ID` ='.$mvmem_gallery_array[$i].';');
			}
			
		?>

		<?php endwhile; endif; ?>

		</main><!-- #main -->
		

	</section><!-- #primary -->

		<div id="masthead2">
			<?php echo '<br><!--mmm 53 '.$paramStr.'-->'; ?>
					<div class="widgets">
						<div id="text-6" class="widget widget_text">
						<br>
								
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

