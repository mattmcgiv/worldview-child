<?php
/*
Template Name: Member Activity Page (Custom)
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

<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
				<?php get_template_part( 'content', 'page' ); ?>
		
			<?php endwhile; endif; ?>		
	
			<?php getLoginLogsForMembers();?>
			
		</main><!-- #main -->
	</section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>

<?php
	function getLoginLogsForMembers() {	
			
			$result = doQuery();
			if ( $result ) {
			//var_dump($result);
				echo '<table style="width: 400px; margin-left: 70px; text-align: left;">
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
					
						if ($this_user->first_name == "") {
							continue;
						}
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
	}  //<!-- end getLoginLogsForHomepage -->
	
	function doQuery() {
		
		//Access WP DB
		global $wpdb;
		
		$memberActivity = $wpdb->get_results( 
				
				"
					SELECT distinct user_login, time
					FROM wp_simple_login_log
					WHERE id in (
						SELECT Max(id)
						FROM wp_simple_login_log
						GROUP by uid
					)
					ORDER BY time DESC
				"
				
		);
		return $memberActivity;
	}