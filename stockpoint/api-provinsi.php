<?php

require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app();
$url = 'http://api.ruangpanji.com/provinsi.php';
$contents = file_get_contents($url);
echo "<pre>";
$new_contents = json_decode($contents);
$rows= array();
foreach($new_contents as $con){
	$rows[] = array('id'=>$con->id,'name'=>$con->name);
}
print_r($rows);

