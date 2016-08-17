<?php
/**
 * TEI-Dashboard functions and definitions
 */
 
/**
 * Theme only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'tei_dashboard_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.

 */
function tei_dashboard_setup() {

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

}
endif; // tei_dashboard_setup
add_action( 'after_setup_theme', 'tei_dashboard_setup' );



/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * 
 */


// Load jquery cdn;
function replace_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4');		
	}
}
add_action('init', 'replace_jquery');


function tei_scripts() {

	//underscore.js 
	 #wp_enqueue_script( 'wp-util' );

	 // jquery mobile 
	 //wp_enqueue_script('jquery-mobile', 'https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js', array( 'jquery' ), '1.4.5', true);

	// Bootstrap 
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css',  '3.3.6' );
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/libs/bootstrap.min.js', array('jquery'), '', true );
	
	// Font Awesome 
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css',  '4.5.0' );
	// Dashboard styles 
	wp_enqueue_style( 'dash-css', get_template_directory_uri() . '/assets/dashboard-assets/dash.css',  '3.3.6' );
	wp_enqueue_script('dash-js', get_template_directory_uri() . '/assets/dashboard-assets/js/dash.js', array('jquery'), '1.0.0', true );

	// Sweet Alert  
	// wp_enqueue_style( 'sweetalert', get_template_directory_uri() . '/assets/css/sweetalert.min.css',  '3.3.6' );
	// wp_enqueue_script('sweetalert', get_template_directory_uri() . '/assets/js/libs/sweetalert.min.js', array('jquery'), '1.0.0', true );

	// Sweet Alert2
	wp_enqueue_style( 'sweetalert2', get_template_directory_uri() . '/assets/css/sweetalert2.css',  '2.0' );
	wp_enqueue_script('sweetalert2', get_template_directory_uri() . '/assets/js/libs/sweetalert2.min.js', array('jquery'), '2.0.0', true );

	// iframeResizer
	wp_enqueue_script( 'iframeResizer', get_template_directory_uri() . '/assets/js/libs/iframeResizer.min.js', array( 'jquery' ), '3.5.1', true );
	//jQuery Touch Swipe 
	wp_enqueue_script( 'jquery-touchSwipe', get_template_directory_uri() . '/assets/js/libs/jquery.touchSwipe.min.js', array( 'jquery' ), '3.5.1', true );
	// Theme stylesheet.
	wp_enqueue_style( 'tei-dashboard-style', get_template_directory_uri(). '/assets/css/style.css', array('bootstrap-css') );//Theme Javascript 
	wp_enqueue_script( 'tei-dashboard-script', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), '20151204', true );

	// owl carousel 
	// wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '20151205', true );
	// wp_enqueue_style('owl-carousel-style',get_template_directory_uri(). '/assets/css/owl.carousel.min.css', '20151205' );
	// wp_enqueue_style('owl-carousel-theme',get_template_directory_uri(). '/assets/css/owl.theme.default.min.css', '20151204' );
	

	// onboarding modal 
	//wp_enqueue_style( 'tei-dashboard-onboard-style', get_template_directory_uri(). '/assets/css/onboard.css', array('bootstrap-css') );

	wp_enqueue_script( 'tei-dashboard-onboard-script', get_template_directory_uri() . '/assets/js/onboard.js', array( 'jquery' ), '20151204', true );







	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'tei-dashboard-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'tei-dashboard-style' ), '20150930' );
	wp_style_add_data( 'tei-dashboard-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'tei-dashboard-ie8', get_template_directory_uri() . '/assets/css/ie8.css', array( 'tei-dashboard-style' ), '20151230' );
	wp_style_add_data( 'tei-dashboard-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'tei-dashboard-ie7', get_template_directory_uri() . '/assets/css/ie7.css', array( 'tei-dashboard-style' ), '20150930' );
	wp_style_add_data( 'tei-dashboard-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'tei-dashboard-html5', get_template_directory_uri() . '/assets/js/libs/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'tei-dashboard-html5', 'conditional', 'lt IE 9' );

	wp_localize_script( 'tei-dashboard-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'tei-dashboard' ),
		'collapse' => __( 'collapse child menu', 'tei-dashboard' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'tei_scripts' );



#### 
#### Login Stuff
#### 

add_role( "Expert", "Expert", array( 'read' => true, 'level_0' => true )  );  
add_role( "Client", "Client", array( 'read' => true, 'level_0' => true )  ); 

add_action( 'user_register', 'myplugin_registration_save', 0, 1 ); 

function myplugin_registration_save( $user_id ) {
	
 	$user_info = get_userdata($user_id);
	 
	  
	$email="$user_info->user_email";
	
	#$test=implode(" ",$user_info);
    	
	$role=$user_info->roles[0];
	$test=get_user_meta($user_id, 'role');
    $test=implode(" ",$test);

	

	
	  
 $server_base = $_SERVER['DOCUMENT_ROOT'];
        
        define("SOAP_CLIENT_BASEDIR", "$server_base/wp-content/Force.com-Toolkit-for-PHP-master/soapclient");
        require_once(SOAP_CLIENT_BASEDIR . '/SforceEnterpriseClient.php');
        require_once("$server_base/wp-content/Force.com-Toolkit-for-PHP-master/samples/userAuth.php");
        ini_set("soap.wsdl_cache_enabled", "0");
        $mySforceConnection = new SforceEnterpriseClient();
        $mySoapClient       = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR . '/enterprise.wsdl.xml');
        $mylogin            = $mySforceConnection->login($USERNAME, $PASSWORD);
$found=0;
if (($role=='Client')||($role=='Expert'))
{
    $query = "SELECT Id,C_ID__c,AccountId,Account_Name__c,Email,Phone,LastName,FirstName,IsDeleted,MailingCity,MailingState,MailingCountry,MailingPostalCode from Contact WHERE Email='$email' AND IsDeleted=False  LIMIT 1";
      $response = $mySforceConnection->query(($query));
     foreach ($response->records as $record) {
		$found=1; 


update_user_meta($user_id, 'first_name', $record->FirstName); 
update_user_meta($user_id, 'last_name', $record->LastName);
update_user_meta($user_id, 'account_name', $record->Account_Name__c);
update_user_meta($user_id, 'id_sf_account', $record->AccountId);
update_user_meta($user_id, 'id_sf_contact', $record->Id); 
update_user_meta($user_id, 'cid', $record->C_ID__c); 

wp_update_user(array(
    'ID' => $user_id,
    'role' => 'Client'
));
   

     
	 $sObject1 = new stdClass();

	$sObject1->Id =$record->Id ;
	$sObject1->WP_Login_ID__c = $user_id;
    $response = $mySforceConnection->update(array($sObject1), 'Contact');


	 }
	 
	 
	 
	 if ($found==0)
{

    $query = "SELECT Id,Firstname__c,Lastname__c,Ms_Mr_Dr_Nurse__c,E_ID__c from Expert__c WHERE Email__c='$email' LIMIT 1";

      $response = $mySforceConnection->query(($query));
     foreach ($response->records as $record) {
		 
		 $found=1;
	
update_user_meta($user_id, 'id_sf_expert', $record->Id); 
update_user_meta($user_id, 'eid', $record->E_ID__c); 
update_user_meta($user_id, 'first_name', $record->Firstname__c); 
update_user_meta($user_id, 'last_name', $record->Lastname__c);
update_user_meta($user_id, 'title', $record->Ms_Mr_Dr_Nurse__c);
update_user_meta($user_id, 'role_check', "Expert");
$update= wp_update_user( array( 'ID' => $user_id, 'role' => "Expert" ) );

     
	 $sObject1 = new stdClass();
	$sObject1->Id =$record->Id ;
	$sObject1->WP_Login_ID__c = $user_id; 
    $response = $mySforceConnection->update(array($sObject1), 'Expert__c');


	 }}
	 
	 }
	 
	 
	 

	 
}	 


add_action( 'wppb_activate_user', 'ChangeRoleExpert', 1, 1 );
function ChangeRoleExpert( $user_id ){
	
	 
	
	$role_check=get_user_meta($user_id, 'role_check',1);
	if ($role_check=='Expert')
	{
	$update= wp_update_user( array( 'ID' => $user_id, 'role' => "Expert" ) );
	}
}
 ###Autologin User after Email 
 /*
 * Auto Login After Email Confirmation. Tags auto login, email confirmation
 */
 
add_action( 'wppb_activate_user', 'wppb_custom_autologin_redirect', 10, 3 );
function wppb_custom_autologin_redirect( $user_id, $password, $meta ){
	// hack to fix conflict with WP Voting Contest in C:\www\pb20\wp-content\plugins\wp-voting-contest\includes\votes-save.php lines 420, 421, 422
	// basically WP Voting Contenst will login any email field that's submitted via POST. So we're overwriting the global $current_user for this particular instance.
	global $current_user;
	$current_user = 0;
 
	$token = wppb_create_onetime_token( 'pb_autologin_'.$user_id, $user_id );
	$location = home_url() . "/?pb_autologin=true&pb_uid=$user_id&pb_token=$token";
	echo "<script> window.location.replace('$location'); </script>";
}
 
add_action( 'init', 'wppb_custom_autologin' );
function wppb_custom_autologin(){
	if( isset( $_GET['pb_autologin'] ) && isset( $_GET['pb_uid'] ) &&  isset( $_GET['pb_token'] )  ){
		$uid = $_GET['pb_uid'];
		$token  = $_GET['pb_token'];
		require_once( ABSPATH . 'wp-includes/class-phpass.php');
		$wp_hasher = new PasswordHash(8, TRUE);
		$time = time();
 
		$hash_meta = get_user_meta( $uid, 'pb_autologin_' . $uid, true);
		$hash_meta_expiration = get_user_meta( $uid, 'pb_autologin_' . $uid . '_expiration', true);
 
		if ( ! $wp_hasher->CheckPassword($token . $hash_meta_expiration, $hash_meta) || $hash_meta_expiration < $time  ){
			//wp_redirect( $current_page_url . '?wpa_error_token=true' );
			die (' You are not allowed to do that. ');
			exit;
		} else {
			wp_set_auth_cookie( $uid );
			delete_user_meta($uid, 'pb_autologin' . $uid );
			delete_user_meta($uid, 'pb_autologin' . $uid . '_expiration');

	       $user_info = get_userdata($uid);
	 	   $role=$user_info->roles[0];
	  
    	if ($role=='Client')
    	{wp_redirect( home_url() . '/client-dashboard/' );}
		if ($role=='Expert')
    	{wp_redirect( home_url() . '/expert-dashboard/' );}
	
			
		   
			exit;
		}
	}
}
 
function wppb_create_onetime_token( $action = -1, $user_id = 0 ) {
	$time = time();
 
	// random salt
	$key = wp_generate_password( 20, false );
 
	require_once( ABSPATH . 'wp-includes/class-phpass.php');
	$wp_hasher = new PasswordHash(8, TRUE);
	$string = $key . $action . $time;
 
	// we're sending this to the user
	$token  = wp_hash( $string );
	$expiration = $time + 60*10;
	$expiration_action = $action . '_expiration';
 
	// we're storing a combination of token and expiration
	$stored_hash = $wp_hasher->HashPassword( $token . $expiration );
 
	update_user_meta( $user_id, $action , $stored_hash ); // adjust the lifetime of the token. Currently 10 min.
	update_user_meta( $user_id, $expiration_action , $expiration );
	return $token;
}

?>