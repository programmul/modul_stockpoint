<?php
require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app();

$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
if (!empty($_GET['prop']) and !empty($_GET['city']) and !empty($_GET['kecamatan'])){	
		$query = "SELECT distinct kelurahan FROM locationcoverage where propinsi='$_GET[prop]' AND kota='$_GET[city]' AND kecamatan='$_GET[kecamatan]'";
		$rows = $connection->fetchAll($query);
		echo"<option selected value=''>Pilih Kelurahan</option>";
		foreach ($rows as $key => $row){
			echo "<option value='$row[kelurahan]'>$row[kelurahan]</option>";
		}	
}
elseif (!empty($_GET['prop']) and !empty($_GET['city'])){	
		$query = "SELECT distinct kecamatan FROM locationcoverage where propinsi='$_GET[prop]' AND kota='$_GET[city]'";
		$rows = $connection->fetchAll($query);
		echo"<option selected value=''>Pilih Kecamatan</option>";
		foreach ($rows as $key => $row){
			echo "<option value='$row[kecamatan]'>$row[kecamatan]</option>";
		}	
}
else{
		$query = "SELECT distinct kota FROM locationcoverage where propinsi='$_GET[prop]'";
		$rows = $connection->fetchAll($query);
		echo"<option selected value=''>Pilih Kota/Kab</option>";
		foreach($rows as $row){
			echo "<option value='$row[kota]'>$row[kota]</option>";
		}
	
} 
?>
