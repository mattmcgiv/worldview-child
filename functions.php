<?php

add_filter( 'auth_cookie_expiration', 'mvmem_logged_in_for_1_year' );

function mvmem_logged_in_for_1_year( $expirein ) {
    return 31556926; // 1 year in seconds
}

add_action( 'wp_login_failed', 'mm_login_failed' ); // hook failed login

function mm_login_failed( $user ) {
  	// check what page the login attempt is coming from
  	$referrer = $_SERVER['HTTP_REFERER'];

  	// check that were not on the default login page
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
		// make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '?login=failed' )) {
			// Redirect to the login page and append a querystring of login failed
	    	wp_redirect( $referrer . '?login=failed');
	    } else {
	      	wp_redirect( $referrer );
	    }

	    exit;
	}
}

add_action( 'authenticate', 'mm_blank_login');

function mm_blank_login( $user ){
  	// check what page the login attempt is coming from
  	$referrer = $_SERVER['HTTP_REFERER'];

  	$error = false;

  	if($_POST['log'] == '' || $_POST['pwd'] == '')
  	{
  		$error = true;
  	}

  	// check that we're not on the default login page
  	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $error ) {

  		// make sure we don't already have a failed login attempt
    	if ( !strstr($referrer, '?login=failed') ) {
    		// Redirect to the login page and append a querystring of login failed
        	wp_redirect( $referrer . '?login=failed' );
      	} else {
        	wp_redirect( $referrer );
      	}

    exit;

  	}
}

//add_action('get_header', 'login_or_die');

function login_or_die() {
	get_currentuserinfo();
	global $user_ID;
	if (!is_user_logged_in()) { 
		if ((get_permalink()!='http://mvmem.com/login/') and (get_permalink() !='http://mvmem.com/contact/') ) {
			auth_redirect();
		}
	}
}

function mmm_login_page( $login_url, $redirect ) {
    $new_login_url = 'http://mvmem.com/login/?redirect_to=' . $redirect;
    return $new_login_url;
}

//add_filter( 'login_url', 'mmm_login_page', 10, 2 );