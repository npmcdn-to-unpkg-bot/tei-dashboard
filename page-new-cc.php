<?php
/*
Template Name: New CC
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
define("SOAP_CLIENT_BASEDIR", "./wp-content/Force.com-Toolkit-for-PHP-master/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('./wp-content/Force.com-Toolkit-for-PHP-master/samples/userAuth.php');
ini_set("soap.wsdl_cache_enabled", "0");
$mySforceConnection = new SforceEnterpriseClient();
$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

 $id_expert_opp=$_GET['IDOPPEXP'];
  $id_expert=$_GET['IDE'];
  $id_opp=$_GET['IDO'];
  $id_contact=$_GET['IDU'];  
  $WP=$_GET['WP'];

$id='';

  $query = "SELECT Id,Free_Json_Times__c From Contact  WHERE  Id='$id_contact' ";
$response = $mySforceConnection->query(($query));
foreach ($response->records as $record) {
	
		$json_times=$record->Free_Json_Times__c;
	
}


  $query = "SELECT Id,Contact__c From Conference_Call__c  WHERE  Contact__c='$id_contact' AND Expert__c='$id_expert' AND Opportunity__c='$id_opp' AND Opportunities_Expert__c='$id_expert_opp'";
$response = $mySforceConnection->query(($query));
foreach ($response->records as $record) {

  $id=$record->Id;
  $id_contact=$record->Contact__c;

}

if ($id==''){
  $sObject = new stdclass();
  $sObject->Contact__c = $id_contact;
  $sObject->Expert__c = $id_expert;
   $sObject->Json_Times__c = $json_times;
  	
  $sObject->Opportunity__c = $id_opp;
  $sObject->Opportunities_Expert__c = $id_expert_opp;
 $sObject->Status__c = 'New Request';
$sObject->Leading_Type__c = 'Attorney';
$sObject->Auto_Mode__c = 0;
 
  

  $createResponse = $mySforceConnection->create(array($sObject), 'Conference_Call__c');

  $response=$createResponse[0];
    $id=$response->id;
}

$site = get_site_url();

 // https://logintei.staging.wpengine.com/scheduler/?ID=006E0000004dajd&IDCC=a1lE0000000NboUIAS&IDU=003E000000HTeqLIAT

   echo "<META http-equiv=\"refresh\" content=\"0;URL=$site/scheduler/?ID=$id_opp&IDCC=$id&IDU=$id_contact&WP=$WP\">";

 

?>


</head>
<body <?php body_class(); ?>>















<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.1/iframeResizer.contentWindow.min.js"></script>
<?php wp_footer(); ?>
</body>
</html>
