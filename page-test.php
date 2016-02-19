<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
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

        <title>The Expert Institute - Dashboard</title>
        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"/> -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/> -->
<!--         <link rel="stylesheet" type="text/css" href="https://www.theexpertinstitute.com/custom/feedback/css/expert.css"/> -->
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/dashboard-assets/dash.css"> -->
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/dashboard-assets/style.css">

        <?php #wp_head(); ?>
</head>
<body>


<?php 
  echo do_shortcode('[wppb-recover-password] ' );
 ?>
<!-- 

<iframe id="iframe-content" src="http://davidjbradshaw.com/iframe-resizer/example/frame.content.html" frameborder="2" scrolling="no">
<p>Your browser does not support iframes.</p>
</iframe>
<p id="callback"><b>Frame ID:</b> iframe-content <b>Height:</b> 410 <b>Width:</b> 2051 <b>Event type:</b> mutationObserver</p>

 -->





    <!-- end of page scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.1/iframeResizer.min.js" type="text/javascript" charset="utf-8"></script>
    <script>
    iFrameResize({
          checkOrigin: false,
          log                     : true,                  // Enable console logging
          enablePublicMethods     : true,                  // Enable methods within iframe hosted page
          resizedCallback         : function(messageData){ // Callback fn when resize is received
            $('p#callback').html(
              '<b>Frame ID:</b> '    + messageData.iframe.id +
              ' <b>Height:</b> '     + messageData.height +
              ' <b>Width:</b> '      + messageData.width + 
              ' <b>Event type:</b> ' + messageData.type
            );
          },
          messageCallback         : function(messageData){ // Callback fn when message is received
            $('p#callback').html(
              '<b>Frame ID:</b> '    + messageData.iframe.id +
              ' <b>Message:</b> '    + messageData.message
            );
            alert(messageData.message);
          },
          closedCallback         : function(id){ // Callback fn when iFrame is closed
            $('p#callback').html(
              '<b>IFrame (</b>'    + id +
              '<b>) removed from page.</b>'
            );
          }
        });
    </script>
</body>
</html>
 