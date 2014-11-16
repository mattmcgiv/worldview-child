<?php
/*
Template Name: Login Page
Author:  Matt McGivney (http://antym.com)
*/
?>


<?php add_action('wp_head','hook_css'); ?>

<?php get_header(); ?>
	
		<!--<h1>Welcome to Middle Village Memories</h1>-->
		
		<div id="mm-container">
			<div id="mm-img-container">		
				<img src="http://mvmem.com/wp-content/uploads/2014/07/MVMEM-WEBSITE-FRONT-PAGE-HEADER.gif" style="height:auto;max-width:600px; margin-bottom: -7px;">
				<img src="http://mvmem.com/wp-content/uploads/2014/05/Car-Wow-Home-Page.jpg" style="height:auto;max-width:600px;">
			</div>
		
			<div id="mm-right-side">
				<p style="font-size: 20px;">
				
				<?php //begin loop ?>
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php the_content(); ?>
				<?php endwhile; endif; ?>
				</p>
			
	 

			<?php
			
			if(isset($_GET['redirect_to'])) {
				$redirect_url = $_GET["redirect_to"];
			}
			else {
				$redirect_url = 'http://mvmem.com';
			}
			
					$args = array(
			        'echo' => true,
			        'form_id' => 'loginform',
			        'redirect' => $redirect_url,
			        'label_username' => __( 'Username' ),
			        'label_password' => __( 'Password' ),
			        'label_remember' => __( 'Remember Me' ),
			        'label_log_in' => __( 'Log In' ),
			        'id_username' => 'user_login',
			        'id_password' => 'user_pass',
			        'id_remember' => 'rememberme',
			        'id_submit' => 'wp-submit',
			        'value_username' => NULL,
			        'value_remember' => false ); 
			        
			        //$args = array('redirect' => $_SERVER['HTTP_REFERER']);
					
					
									if(isset($_GET['idle']) && $_GET['idle'] == 1)
					{
						?>
							<div id="login-error" style="background-color: #FFEBE8;border:1px solid #C00;padding:5px;">
								<p>You were idle or away from the site and have been logged out.  Please log in to continue.</p>
							</div>
						<?php
					}
					
					
									if(isset($_GET['login']) && $_GET['login'] == 'failed')
					{
						?>
							<div id="login-error" style="background-color: #FFEBE8;border:1px solid #C00;padding:5px;">
								<p>Login failed: You have entered an incorrect username or password, please try again.</p>
							</div>
						<?php
					}
					//wp_login_form( $args );
			?>
			
			<?php //echo $_SERVER['HTTP_REFERER']; ?> 
			<form name="loginform" id="loginform" action="http://mvmem.com/wp-login.php" method="post">
			
				<p class="login-username">
					<label for="user_login">Username</label>
					<input type="text" name="log" id="user_login" class="input" value="" size="20" />
				</p>
				<p class="login-password">
					<label for="user_pass">Password</label>
					<br><input type="password" name="pwd" id="user_pass" class="input" value="" size="35" />
				</p>
				<p class="login-submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In" />
					<input type="hidden" name="redirect_to" value="<?php echo $redirect_url; ?>" />
				</p>
			
			</form>
			
			<!--a href="http://mvmem.com/contact" style="font-size: large;"> Contact Spencer </a>
			</div>
		</div> <!--mm-container-->

	
<?php 
	get_footer(); 
?>

<?php


	
	function hook_css() {
	
		$output='<style> 
		header { display:none !important; } 
		#main-content-area {position:absolute !important; top: 10px; left: 50px; width: 1200px !important;}
		div.footertext {display: none;} 
		#mm-right-side {height:200px;width:400px;float:left; position:absolute !important; top: 10px; right: 100px;}
		form {border-style: solid; border-color: #5DBCD2; border-width: 3px; padding: 5px;}
		a {text-decoration: underline;}
		#user_login.input {color: black !important;}
		#user_pass.input {color: black !important;}
		</style>';
		echo $output;
	
	}
?>

