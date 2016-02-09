<?
  $test=json_encode($HTTP_RAW_POST_DATA);
  #$url=$HTTP_RAW_POST_DATA["recorded_from"];

   $id_part=explode("?IDE=",$test);
   $id_part=$id_part[1];
   $id_part2=$id_part;
   $id_part=explode("\",",$id_part);
   $id=$id_part[0];
   $id=str_replace("\\","",$id);

   $idvideo=explode("uuid",$test);
   $idvideo=$idvideo[1];
   $idvideo=str_replace("\\","",$idvideo);
   $idvideo=str_replace("\",\"camera_","",$idvideo);
   $idvideo=str_replace("\":\"","",$idvideo);



define("SOAP_CLIENT_BASEDIR", "../../Force.com-Toolkit-for-PHP-master/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('../../Force.com-Toolkit-for-PHP-master/samples/userAuth.php');
 ini_set("soap.wsdl_cache_enabled", "0");

    try {
      $mySforceConnection = new SforceEnterpriseClient();
      $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
       $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

$sObject1 = new stdClass();
$sObject1->Id = $id;
$sObject1->ID_Video__c = $idvideo;

$response = $mySforceConnection->update(array($sObject1), 'Expert__c');

      } catch (Exception $e) {
      print_r($mySforceConnection->getLastRequest());
      echo $e->faultstring;
  }



# print_r("$HTTP_RAW_POST_DATA");
#$test=$_POST["recorded_from"];

$File = "YourFile.txt";
 $Handle = fopen($File, 'w');

  fwrite($Handle, $id);
 fclose($Handle);

?>