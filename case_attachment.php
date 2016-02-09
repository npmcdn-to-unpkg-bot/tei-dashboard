<?php

$IDU=$_GET['IDU'];
$WP=$_GET['WP'];
$IDO=$_GET['IDO'];
$na=$_POST['na'];
$name=$_GET['name'];
$aid=$_GET['aid'];
?>

<img class="logo" id="logo" border="0" alt="Logo" src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/c_thumb,g_face:center/e_grayscale,c_scale,h_80/v40/logos/<? echo "$aid"; ?>.jpg">

<h2><? echo "$name"; ?></h2>

<?

if ($na=='upload')
{
	$desc=$_POST['desc'];
	
define("SOAP_CLIENT_BASEDIR", "../../Force.com-Toolkit-for-PHP-master/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');

require_once ('../../Force.com-Toolkit-for-PHP-master/samples/userAuth.php');

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
	
 echo "<h3>Upload Complete</h3>";
 
 
 
echo "<META http-equiv=\"refresh\" content=\"0;URL=https://theexpertinstitute.secure.force.com/CaseDetails/?IDO=$IDO&IDU=$IDU&WP=$WP\">";
  
 
}
	
	
	
	
	
}
else
{

?>

   <form class="form-horizontal validate-form" name="opp_attachment" method="post"  action="?IDO=<? echo "$IDO"; ?>&IDU=<? echo "$IDU"; ?>&name=<? echo "$name"; ?>&aid=<? echo "aid"; ?>&WP=<? echo "$WP"; ?>" enctype="multipart/form-data">
  
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
            <label for="inputDesc" class="control-label col-sm-4 col-xs-12 ">Descriptions</label>
            <div class="col-xs-12 col-sm-8">
              <textarea type="textarea" class="desc" name="desc" placeholder="Enter any additional information about the File (optional)"></textarea>
            </div>
          </div>
		    </fieldset>
		    <div class="clearfix mb"></div>


            <div class="col-sm-8 col-sm-offset-4 mb">
              <button type="submit" class="submit send">Upload</button>
            </div>
		</form>

<? } ?>