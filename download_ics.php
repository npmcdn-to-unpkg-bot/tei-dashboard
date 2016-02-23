<?
$id=$_GET['ID'];
$IDU_Type=$_GET['IDU_Type'];



define("SOAP_CLIENT_BASEDIR", "../../Force.com-Toolkit-for-PHP-master/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('../../Force.com-Toolkit-for-PHP-master/samples/userAuth.php');
ini_set("soap.wsdl_cache_enabled", "0");

    $mySforceConnection = new SforceEnterpriseClient();
    $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');

    $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

    $query1 = "SELECT Id,Name,E_ID__c,Opportunity_Name__c,Time_end__c,Time_start__c from Conference_Call__c WHERE Id='$id'";$response1 = $mySforceConnection->query(($query1));
foreach ($response1->records as $cc) {

    $start=str_replace('-','',$cc->Time_start__c);
    $start=str_replace('.000','',$start);
    $start=str_replace(':','',$start);  
    $start2=str_replace('Z','',$start);  

    $end=str_replace('-','',$cc->Time_end__c);
    $end=str_replace('.000','',$end);
    $end=str_replace(':','',$end);  
    $end=str_replace('Z','',$end);  
    
    if ($IDU_Type == 'Attorney'){ 
        $cc_subject = "Expert $cc->E_ID__c";        
    } else { 
        $cc_subject = 'Attorney';
    };
	  
$file="BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//www.theexpertinstitute.com//Conference Call Scheduling//EN
X-WR-CALNAME:Conference Call
CALSCALE:GREGORIAN
BEGIN:VEVENT
DTSTAMP:$start
UID:$cc->Name
DTSTART;TZID=\"Etc/UTC\":$start2
DTEND;TZID=\"Etc/UTC\":$end
SUMMARY:Conference call with $cc_subject
DESCRIPTION:$cc->Opportunity_Name__c - Conference call with $cc_subject
END:VEVENT
END:VCALENDAR";
  
$name_output = "$cc->Name.ics"; 
 
  

$length = $attach->BodyLength; 
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$name_output.'"'); 
if($file) echo $file;


}
  ?>