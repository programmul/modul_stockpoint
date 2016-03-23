<?php
class Mamoku_RegAddress_Model_Api_Provinsi extends Mage_Core_Model_Abstract{
	public function getAllOptions(){
		$url = 'http://api.ruangpanji.com/provinsi.php';
		$contents = file_get_contents($url);
		//echo "<pre>";
		$new_contents = json_decode($contents);
		$rows= array();
		foreach($new_contents as $con){
			$rows[] = array('label'=>$con->id,'value'=>$con->name);
		}
		return $rows;
	}
}
