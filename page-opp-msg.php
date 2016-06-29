<?php
/*
Template Name: Message Research 
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


<?php 


$IDU=$_GET['IDU'];
$IDO=$_GET['IDO'];
$UID=$_GET['UID'];
$LCMT_First=$_GET['UFIRST'];
$LCMT_Last=$_GET['ULAST'];
$OID=$_GET['OID'];
$na=$_POST['na'];
$name=$_GET['case']; 
$aid=$_GET['aid'];
$msg=$_POST['msg'];
$WP=$_GET['WP'];
?>
<?php

$case_manage_img ="<img class='case-manager-img text-center' src=\"https://res.cloudinary.com/theexpertinstitute-com/image/upload/c_thumb,g_face:center,h_60,w_60/v40/users/$UID.jpg\">";

if ($na=='send')
{
define("SOAP_CLIENT_BASEDIR", "./wp-content/Force.com-Toolkit-for-PHP-master/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('./wp-content/Force.com-Toolkit-for-PHP-master/samples/userAuth.php');
ini_set("soap.wsdl_cache_enabled", "0");
$mySforceConnection = new SforceEnterpriseClient();
$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

 



    
  $sObject = new stdclass();
  $sObject->Contact__c = $IDU;
  $sObject->Message__c = $msg;
  $sObject->Opportunity__c=$IDO;
  $createResponse = $mySforceConnection->create(array($sObject), 'Opportunity_Messages__c');
  $id=$createResponse[0];
  $id_msg=$id->id;    


 
 
echo "<META http-equiv=\"refresh\" content=\"0;URL=https://theexpertinstitute.secure.force.com/Client/ClientCaseDetail?IDO=$IDO&IDU=$IDU&WP=$WP#chatter\">";
  
?>
  </head> 
<?}
else
{ ?>
  



<div class="container main-container" style="display: none;">

  <div class=" sec-intro mb">
<img class="logo" id="logo" border="0" alt="Logo" src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/c_thumb,g_face:center/e_grayscale,c_scale,h_80/v40/logos/<? echo "$aid"; ?>.jpg">

<h2 class="CaseTitle mb"><? echo "$OID: $name"; ?></h2>




  
  
   <form class="form-horizontal validate-form" name="opp_attachment" method="post"  action="?IDO=<? echo "$IDO"; ?>&WP=<? echo "$WP"; ?>&IDU=<? echo "$IDU"; ?>&case=<? echo "$name"; ?>&aid=<? echo "aid"; ?>" enctype="multipart/form-data">
  
   <input type="hidden" name="na" value="send">
	<input type="hidden" name="IDO" value="<? echo "$IDO"; ?>">
  <div class="row">
    <div class="col-sm-2 col-sm-offset-2 mb text-center"><?php echo $case_manage_img; ?></div>  
      <div class="col-sm-6">
        <textarea type="textarea" class="msg" name="msg" placeholder="Message"></textarea>
        </div>
  </div>
  <div class="row">
      <div class="col-sm-6 col-sm-offset-4 mb">
        <button type="submit" class="btn btn-submit  send">Send Message to <? echo "$LCMT_First"; ?></button>
      </div>
  </div>
  

		    <div class="clearfix mb"></div>



		</form>
	
<? } ?>

</div>
</div>
<body <?php body_class(); ?>>
 <script>
   
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
            $('.main-container').show();
        }

        //init iframe 
        window.iFrameResizer = {
          readyCallback: function(){
               window.parentIFrame.sendMessage('loading-hide');
          },
          messageCallback: function(message){
            console.dir(message);
          }
        };

        //on page change - show loading 
        $(window).on('beforeunload ',function() { 
          //show overlay from inner iframe page 
          $('#loading-overlay', window.parent.document).show();
        }); 
 </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.1/iframeResizer.contentWindow.min.js"></script>
<?php wp_footer(); ?>
</body>
</html>
