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
 *
 * Create your own tei_dashboard_setup() function to override in a child theme.
 */
function tei_dashboard_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'theexpertinstitute', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	// add_theme_support( 'automatic-feed-links' );

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

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	// add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'tei_dashboard_setup' );


/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 */
function tei_dashboard_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tei_dashboard' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'tei_dashboard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'tei_dashboard' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'tei_dashboard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'tei_dashboard' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'tei_dashboard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tei_dashboard_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

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
		wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js', false, '1.9.1');
	}
}
add_action('init', 'replace_jquery');


function tei_scripts() {

	//underscore.js 
	 wp_enqueue_script( 'wp-util' );

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

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );


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