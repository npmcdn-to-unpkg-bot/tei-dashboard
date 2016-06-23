<?php
/*
  Login Page Header 
 */



/*SALESFORCE VARIABLES*/
$user_id= get_current_user_id();
$user_info= get_userdata($user_id);
$field_meta="user_".$user_id;
$id_sf= get_field('id_sf_contact', $field_meta);
$cid= get_field('cid', $field_meta);
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico?v=1">
    <script src="https://use.typekit.net/wht0akz.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <title>The Expert Institute - Dashboard</title>
        <?php wp_head(); ?>



    <style type="text/css" media="screen">

      <?php 
        if ( is_admin() ) { ?>
             /* ADMIN BAR SPACING - REMOVE THIS */
             html { margin-top: 32px !important; }
             * html body { margin-top: 32px !important; }
             @media screen and ( max-width: 782px ) {
               html { margin-top: 0 !important; }
               *  body { margin-top: 46px !important; }
        }
       <?php } else {
             
        }

      ?>

    </style>
                
</head>
<body  class="login-page" <?php body_class(); ?> >






