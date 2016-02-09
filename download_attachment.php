<?
$id=$_GET['ID'];
$fn=$_GET['fn'];
$ln=$_GET['ln'];
$eid=$_GET['eid'];
$type=$_GET['type'];
$name=$_GET['name'];

define("SOAP_CLIENT_BASEDIR", "../../Force.com-Toolkit-for-PHP-master/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('../../Force.com-Toolkit-for-PHP-master/samples/userAuth.php');
 ini_set("soap.wsdl_cache_enabled", "0");

   
      $mySforceConnection = new SforceEnterpriseClient();
      $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');

      $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

$query1 = "SELECT Id,Body,Name,BodyLength from Attachment WHERE Id='$id'";
#echo "<br>$query1<br>";

  $response1 = $mySforceConnection->query(($query1));
  


  foreach ($response1->records as $attach) {
	  
	  $file = $attach->Body; 
	  
	$namea=explode('.',$attach->Name);
	$namecount=count($namea)-1;
	
	  
	  $filetype=$namea[$namecount];
	  
	  if ($name==''){
	  $name_output = "$eid $fn $ln, $type.$filetype"; 
	  }
	  else
	  {$name_output = "$name";}
	  

	  $length = $attach->BodyLength; 
	  header('Content-Type: application/force-download');
	  header('Content-Disposition: inline; filename="'.$name_output.'"'); 
	  header('Content-Length: '.$length); if($file) echo $file;
	 

  }
  ?>