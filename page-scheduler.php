<?php
/*
Template Name: Dashboard Scheduler Template
*/
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
    <title><?php if (is_front_page()) { bloginfo('name'); } else { wp_title(''); } ?></title>
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
   <script src="https://use.typekit.net/wht0akz.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php // wordpress head functions ?>
    <?php wp_head(); ?>
    <?php // end of wordpress head ?>
    <?php // drop Google Analytics Here ?>
    <?php // end analytics ?>
    <script type="text/javascript">
    var templateDir = "<?php bloginfo('template_directory') ?>";
    </script>
</head>
<body <?php body_class(); ?>>

<?php
// check for logged in
if ($login!= 1) { ?>
    
  
    <nav class="navbar navbar-static-top dash-navbar-top dnl-visible">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo get_site_url(); ?>/" style="margin-left:0;"><img src="<?php echo get_template_directory_uri(); ?>/assets/dashboard-assets/images/login-logo-inverse.svg" alt="tei-logo" class="header-tei-logo" ><span class="beta-tag hidden-xs">beta</span></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="dnt-collapse">

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav> <!-- /.navbar -->

<?} else { ?>
    <script>
        $(document).ready(function() {
            //check if running inside iframe 
            function inIframe () {
                try {
                    return window.self !== window.top;
                } catch (e) {
                    return true;
                }
            }
            console.log("inIframe is " + inIframe());
            
            if (!inIframe()){
                
                window.location.replace('<?php echo get_site_url(); ?>/?return_url='+encodeURIComponent(window.location.href));

            } else {
                console.log('scheduler running in iframe');
                //hide overlay from inner iframe page 
                $('#loading-overlay', window.parent.document).hide();
                //display page contents
                $('.main-container').show();
            }
    
        });
    </script>
<? } ?>



<div class="container main-container mt" >
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <h1 class="ListHeading">
            <!-- TITLE GOES HERE -->
            <?php
                if ($Opp_name!=''){
                    echo $Opp_name ;        
                } else {
                    echo "Set Your Availability";
                }
             

             ?>
            </h1>
            <h3 class="page-subheader">Schedule Your Conference Call</h3>
            <div class="content">
            <div class="alert alert-info alert-tei">
                <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                <? echo $greeting; ?>
            </div>
                
            </div>

        </div>
    </div>
    <div class="row">
        <!-- TEI-SCHEDULER CARD -->    
        <div class="col-sm-10 col-sm-offset-1">
            <?php echo do_shortcode('[tei-scheduler]'); ?>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-10">
            <div id="cachedEvents"></div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.1/iframeResizer.contentWindow.min.js"></script>

<?php wp_footer(); ?>

</body>
</html>
