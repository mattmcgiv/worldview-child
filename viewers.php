<?php
/**
 * Template Name: Viewers (Custom)
 *
 * @package worldview
 */

 

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Viewers</title>
	</head>

	<body>
		<h1 style="text-align: center;"> 
		<?php echo get_the_title(); ?> </h1>
		
		<?php //echo 'This page is currently under development. Please check back soon for the finished product!';?>
		
		<?php
			if(isset($_GET['referrer'])) {
					$queryURL = $_GET["referrer"];
					echo '<!--set queryURL to '.$queryURL.'-->';
			}
		?>
		<?php getUserActivity($queryURL); ?>
	</body>

</html>

<?php
	function getUserActivity($queryURL) {	
			echo '<!--in getUserActivity function: '.$queryURL.'-->';
			if (strlen($queryURL)>55) {
				//$queryURL=substr($queryURL, 0, 55);
			}
			echo '<!--prior to doQuery '.$queryURL.'-->';
			$result = doQuery($queryURL);
			if ($result ) {
			
				echo '<table margin="" style="width: 400px; text-align: left;">
					<tr>
					  <th style="text-align: left;">Name</th>
					  <th style="text-align: left;">Date</th>
					</tr>';			
				foreach ( $result as $value )	{
					$this_user = $value->name;//get_user_by('login', $value->user_login);
					$this_dateTime = strtotime($value->time);
					$this_date = date('M d, Y', $this_dateTime);
					//$this_time = date('g:i A', $this_dateTime);
					if ($this_user == "") {
						continue;
					}
					echo '<tr>';
						echo '<td>'. $this_user . '</td>';
						echo '<td>'. $this_date .'</td>';
					echo '</tr>';
				}	
				echo '</table>';
			}

			else {
				//echo '<h2>Not Found</h2>';
			}
			echo '<br>';
	}  //<!-- end getUserActivity -->
	
	function doQuery($queryURL) {
		
		//Access WP DB
		global $wpdb;
		echo '<!--in doQuery function: '.$queryURL.'-->';
		
		$memberActivity = $wpdb->get_results( 
				"
					SELECT *
					FROM
						(SELECT * 
						FROM wp_user_activity 
						WHERE url='".$queryURL."' 
						ORDER BY time DESC) 
					AS x 
					GROUP BY name 
					ORDER BY time DESC
				"
		);
		return $memberActivity;
	}
?>