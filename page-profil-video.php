<?php
/*
Template Name: Upload Case Attach
*/

//  echo "</pre></div";
?>
<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <?php // Google Chrome Frame for IE ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>The Expert Institute | Profile Video </title>
    <?php // mobile meta (hooray!) ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, shrink-to-fit=no">
    <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png?v=1">
    <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <![endif]-->
    <?php // or, set /favicon.ico for IE10 win ?>
    <meta name="msapplication-TileColor" content="#2a5781">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/assets/css/vf-caseDetails.css">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php // wordpress head functions ?>
    <?php wp_head(); ?>
    <?php // end of wordpress head ?>
    <?php // drop Google Analytics Here ?>
    <?php // end analytics ?>
    <script type="text/javascript">
    var templateDir = "<?php bloginfo('template_directory') ?>";
    </script>

<script src='//cameratag.com/api/v7/js/cameratag.js' type='text/javascript'></script>
<?php


$IDE=$_GET['IDE'];

?>



  </head>





<div class="container main-container">

  <div class=" sec-intro mb">







	<div class="col-xs-12 col-sm-10">
    <h2 class="CaseTitle">Profile Video</h2>



   <camera id='MyFirstCamera'
    data-app-id='a-7b1e6e70-aebc-0133-b4b7-22000b789ce2'
    data-cssurl='<?php echo get_template_directory_uri();  ?>/assets/css/profile-video.css'
    style="width:80%;height: 100%;"
   ></camera>

   <div class="mt alert alert-info  text-center alert-tei">
       <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
     <p>
       Experts with profile videos have a greater chance of being retained on a case.
     </p>
     <p>
       Give a short summary of your qualifications without revealing your identity please.
     </p>
   </div>

  </div>
		    <div class="clearfix mb"></div>




</div>
</div>
<body <?php body_class(); ?>>







<div id="status-overlay"></div>







<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.1/iframeResizer.contentWindow.min.js"></script>
<?php wp_footer(); ?>
<script>
  $(document).ready(function() {
    $('button[type=submit]').click(function(e){
        var overlayMsg = "Sending Message.....";
        var overlay = jQuery('<div id="status-overlay" class="text-center"><h2 class="overlay-message">' + overlayMsg + '</h2></div>');
        overlay.appendTo(document.body);

        overlay.toggleClass('show');

        $(this).fadeOut();
    });
  });
</script>
</body>
</html>
