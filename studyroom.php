<?php
	header('Content-Type: application/json');
	header('Cache-Control: public, max-age=3600');
	header('Access-Control-Allow-Origin: *');
  $apikey=;
	$url="https://api-na.hosted.exlibrisgroup.com/almaws/v1/bibs/9931931001867?expand=p_avail&apikey=" . $apikey;
	$connection = curl_init($url);
	curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($connection, CURLOPT_HEADER, false);
	$response = curl_exec($connection);
	$xml = new SimpleXMLElement($response);
	$status = $xml->xpath('//datafield[@tag="AVA"]/subfield[@code="e"]/text()');
	$total = $xml->xpath('//datafield[@tag="AVA"]/subfield[@code="f"]/text()');
	$checkedout = $xml->xpath('//datafield[@tag="AVA"]/subfield[@code="g"]/text()');
	echo  json_encode(array("Status"=>(string)$status[0],"Total"=>(string)$total[0],"CheckedOut"=>(string)$checkedout[0],'Available'=>$total[0]-$checkedout[0]));
?>
