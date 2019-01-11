<?php
if (isset($_GET["road"])){
    $road = $_GET["road"];
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://140.118.102.44/api/traffic/".$road);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($params));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
$result = curl_exec($ch);
curl_close($ch);
//print_r($result);
$results = json_decode($result, true);
print_r($result);
//print_r($results);

?>


