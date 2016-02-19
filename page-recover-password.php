<?php
/**
 *
 *  Template: Recover Password
 *
 *
 */



$return_url=$_GET['return_url'];
if ($return_url!='')
{$return_url=urlencode($return_url);
  $redirect="redirect_url=\"$return_url\"";}





if (is_user_logged_in()){
	echo "$return_url";
  $user_id=get_current_user_id( );
  $user_info = get_userdata($user_id);
  $role=$user_info->roles[0];

  // print_r($role);
  if($role == "Client"){
    wp_redirect(home_url("/client-dashboard/?$redirect"));  
  } elseif ($role == "Expert") {
    wp_redirect(home_url("/expert-dashboard/?$redirect"));  
  }
 
}



include 'header-login.php';

 ?>


<div class="content dnl-visible" data-effect="dnl-push">
  <div class="container">
    <div id="content">
        
        <div class="jumbotron login-box">
        <div class="text-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/dashboard-assets/images/login-logo-dark.svg" class="img img-responsive login-logo">
        </div> 
           
         
           <div id="recover-password-form" class="">
            <h2 class="text-center">Recover Password</h2>
               <? 
                echo do_shortcode('[wppb-recover-password] ' );
               ?>
           </div>


        </div>


    </div>

  </div>
</div> <!-- /.content-wrap -->
 

	

    <?php wp_footer(); ?>
    </body>
    </html>