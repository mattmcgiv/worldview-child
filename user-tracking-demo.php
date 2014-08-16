<?php
/*
Template Name: User Activity Demo 2 (Custom)
Author:  Matt McGivney (http://antym.com)
*/
?>

<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
				<?php get_template_part( 'content', 'page' ); ?>
		
			<?php endwhile; endif; ?>		
	
			<?php getUserActivity();?>
			
		</main><!-- #main -->
	</section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>

<?php
	function getUserActivity() {	
			
			$result = doQuery();
			if ( $result ) {
			//var_dump($result);
				echo '<table style="margin: 75px; width: 600px; text-align: left;">
					<tr>
					  <th>Name</th>
					  <th>Time</th>
					  <th>Page</th> 
					</tr>';			
				foreach ( $result as $value )	{
					$this_user = $value->name;//get_user_by('login', $value->user_login);
					$this_dateTime = strtotime($value->time);
					
					$this_date = date('M d, Y', $this_dateTime);
					//$this_time = date('g:i A', $this_dateTime);
					
					echo '<tr>';
						echo '<td>'. $this_user . '</td>';
						echo '<td>'. $this_date .'</td>';
						echo '<td>'. $value->url .'</td>';
						
						//echo '<td>'. date('n/j', $this_date) .'</td>';
						
					echo '</tr>';
				}	
				echo '</table>';
			}

			else {
				echo '<h2>Not Found</h2>';
			}
			echo '<br>';
	}  //<!-- end getUserActivity -->
	
	function doQuery() {
		
		//Access WP DB
		global $wpdb;
		
		$memberActivity = $wpdb->get_results( 
				"
					SELECT name, time, url
					FROM wp_user_activity
					WHERE id in (
						SELECT Max(id)
						FROM wp_user_activity
						WHERE url='" .get_the_title(). "'
						GROUP by id
					)
					ORDER BY time DESC
					LIMIT 30
				"
		);
		return $memberActivity;
	}