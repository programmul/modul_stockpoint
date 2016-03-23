<?php

require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app();

$collection = Mage::getModel("multistockpoint/stockpoint")->getCollection();
foreach($collection as $stockpoint){
	print_r($stockpoint->getData());
}
echo json_encode($result);

 $prices=Mage::getModel('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
 echo "<pre/>";
 foreach($prices as $price){
	print_r($price->getData());
 }
 
?>