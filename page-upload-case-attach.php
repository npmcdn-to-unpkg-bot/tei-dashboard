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
    <title><?php if (is_front_page()) { bloginfo('name'); } else { wp_title(''); } ?></title>
    <?php // mobile meta (hooray!) ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, shrink-to-fit=no">
    <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png?v=1">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/assets/css/vf-caseDetails.css">
    <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <![endif]-->
    <?php // or, set /favicon.ico for IE10 win ?>
    <meta name="msapplication-TileColor" content="#2a5781">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
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

<?php 

$WP=$_GET['WP'];
$IDU=$_GET['IDU'];
$IDO=$_GET['IDO'];
$OID=$_GET['OID'];
$na=$_POST['na'];
$name=$_GET['case']; 
$aid=$_GET['aid'];
$desc=$_POST['desc'];
?>

<?php


if ($na=='upload')
{
define("SOAP_CLIENT_BASEDIR", "./wp-content/Force.com-Toolkit-for-PHP-master/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('./wp-content/Force.com-Toolkit-for-PHP-master/samples/userAuth.php');
ini_set("soap.wsdl_cache_enabled", "0");
$mySforceConnection = new SforceEnterpriseClient();
$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

 
  $file = $_FILES["filebutton"]["tmp_name"];
  $fileName = $_FILES["filebutton"]["name"];

if ($fileName!="")
{
	
		
  $sObject = new stdclass();
  $sObject->Name = $fileName;
  $sObject->Opportunity__c = $IDO;
  $sObject->Description__c = $desc;
  $createResponse = $mySforceConnection->create(array($sObject), 'Opportunity_Attachment__c');
  $id=$createResponse[0];
  $id_attach_header=$id->id;		


	
  $handle = fopen($file,'rb');
  $file_content = fread($handle,filesize($file));
  fclose($handle);

  $encoded = chunk_split(base64_encode($file_content));
  $sObject = new stdclass();
  $sObject->Name = $fileName;
  $sObject->ParentId = $id_attach_header;
  $sObject->body = $encoded;

  $createResponse = $mySforceConnection->create(array($sObject), 'Attachment');
  $id=$createResponse[0];
  $IDattach=$id->id;
  
 
  
  
  
          $sObject1 = new stdClass();

	$sObject1->Id =$id_attach_header ;
	$sObject1->	Attachment__c = $IDattach;
    $response = $mySforceConnection->update(array($sObject1), 'Opportunity_Attachment__c');
	
 #echo "<h3>Upload Complete</h3>";
 
  $msg="New File Upload $fileName";
 $sObject3 = new stdclass();
  $sObject3->Contact__c = $IDU;
  $sObject3->Message__c = $msg;
  $sObject3->Opportunity__c=$IDO;
  $createResponse = $mySforceConnection->create(array($sObject3), 'Opportunity_Messages__c');
  $id=$createResponse[0];
 


// echo "<META http-equiv=\"refresh\" content=\"0;URL=https://theexpertinstitute.secure.force.com/CaseDetails/?IDO=$IDO&IDU=$IDU&WP=$WP#attachments\">";

echo "<script>
  window.location.href=\"https://theexpertinstitute.secure.force.com/Client/ClientCaseDetail?IDO=$IDO&IDU=$IDU&WP=$WP#attachments\";
                  //hide overlay from inner iframe page 
                $('#loading-overlay', window.parent.document).hide();

  </script>";
 
}
	
	
	
	
	
}
else
{
 
?>

  <div class="container main-container" style="display: none;">

  <div class="row sec-intro mb">

  <div class="col-md-12 text-center">
    <img class="logo" id="logo" border="0" alt="Logo" src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/c_thumb,g_face:center/e_grayscale,c_scale,h_80/v40/logos/<? echo "$aid"; ?>.jpg">

    <h2 class="CaseTitle"><? echo "$OID: $name"; ?></h2>

  </div>
  <div class="col-md-12">
  
  
   <form class="form-horizontal validate-form" name="opp_attachment" method="post"  action="?IDO=<? echo "$IDO"; ?>&WP=<? echo "$WP"; ?>&IDU=<? echo "$IDU"; ?>&case=<? echo "$name"; ?>&aid=<? echo "aid"; ?>" enctype="multipart/form-data">
  
   <input type="hidden" name="na" value="upload">
	<input type="hidden" name="IDO" value="<? echo "$IDO"; ?>">
	
  <fieldset>
  <!-- Form Name -->
          <legend>Case Documents</legend>
          <!-- File Button -->
          <div class="form-group">
            <label class="control-label col-sm-4 col-xs-12 " for="filebutton">Upload  <em> (doc/pdf/txt)</em></label>
            <div class="col-xs-12 col-sm-8 col-md-8">
              <input id="filebutton" name="filebutton" class="input-file pt" type="file">
            </div>
          </div>
      
		<div class="form-group">
            <label for="inputDesc" class="control-label col-sm-4 col-xs-12 ">Description</label>
            <div class="col-xs-12 col-sm-8">
              <textarea type="textarea" class="desc" name="desc" placeholder="Enter any additional information about the File (optional)"></textarea>
            </div>
          </div>
		    </fieldset>
		    <div class="clearfix mb"></div>


            <div class="col-sm-8 col-sm-offset-4 mb">
              <button type="submit" class="btn btn-submit submit send">Upload</button>
            </div>
		</form>
<? } ?>

	</div></div>
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
