<?php
/*
Template Name: Home Page (Custom)
Author:  Matt McGivney (http://antym.com)
*/
?>

<?php
// Require login for site
get_currentuserinfo();
global $user_ID;
if ($user_ID == '') { 
	header('Location: /login'); exit(); 
}
?>

<?php add_action('wp_head','hook_css_masthead2'); ?>
<?php function hook_css_masthead2() {
		$output='<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/css/userTracking.css">';
		echo $output;
	
	}
?>

<?php get_header(); ?>


	<header id="masthead2">

								<div class="widgets">
						<div id="text-6" class="widget widget_text">
						<br>
							<h1 class="widgettitle" id="member-activity">Member Activity</h2>
								<div class=""> 
									<?php 
										getLoginLogsForHomepage();
									?>
								</div>
						</div>
					</div><!-- end class="widgets" -->
	
</header>

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
	function getLoginLogsForHomepage() {	
			
			$result = doQuery();
			if ( $result ) {
			//var_dump($result);
				echo '<table>
					<tr>
					  <th>Member</th>
					  <th>Last Visit</th> 
					</tr>';			
				foreach ( $result as $value )	{
					$this_user = get_user_by('login', $value->user_login);
					$this_dateTime = strtotime($value->time);
					
					$this_date = date('n/j', $this_dateTime);
					$this_time = date('g:i A', $this_dateTime);
					
					echo '<tr>';
						echo '<td>'. $this_user->first_name . ' ' . $this_user->last_name . '</td>';
						if ($this_date == date('n/j') ) { //date is today
							//show h:mm [AM||PM]
							echo '<td>'. $this_time .'</td>';
						}
						
						else {
							//show m/d
							echo '<td>'. $this_date .'</td>';
						}
						//echo '<td>'. date('n/j', $this_date) .'</td>';
						
					echo '</tr>';
				}	
				echo '</table>';
			}

			else {
				echo '<h2>Not Found</h2>';
			}
			
			echo '<a href="http://mvmem.com/wp-admin/users.php?page=login_log">See More</a>';
	}  //<!-- end getLoginLogsForHomepage -->
	
	function doQuery() {
		
		//Access WP DB
		global $wpdb;
		
		$memberActivity = $wpdb->get_results( 
				"
					SELECT DISTINCT user_login, 
					time FROM wp_simple_login_log 
					ORDER BY time DESC
					LIMIT 30
				"
		);
		return $memberActivity;
	}
?>