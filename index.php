<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 *
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

include 'header-login.php'; ?>


<div class="content dnl-visible" data-effect="dnl-push">
  <div class="container">
    <div id="content">
        
        <div class="jumbotron login-box">
        <div class="text-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/dashboard-assets/images/login-logo-dark.svg" class="img img-responsive login-logo">
        </div> 
           
         
           <div id="login-form" class="">
            <h2 class="text-center">Log In</h2>
               <? echo do_shortcode( '[wppb-login]' );



               $user_id=get_current_user_id( );
               $user_info = get_userdata($user_id);
               $role=$user_info->roles[0];

               print_r($role);
               ?>
               <hr>
               <p class="mini">Don't have a login? <a class="mini register-switch"href="#">Register Here</a></p>
           </div>

            <div id="register-form" class="hidden">
                <h2 class="text-center">Register</h2>
                <?php echo do_shortcode('[wppb-register]' );

                ?>
                <hr>
                <p class="mini">Already registered? <a class=" mini register-switch"href="#">Login Here</a></p>
            </div>

        </div>


    </div>

  </div>
</div> <!-- /.content-wrap -->
 

	

    <?php wp_footer(); ?>
    </body>
    </html>