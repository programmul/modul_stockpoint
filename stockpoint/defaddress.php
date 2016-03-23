<?php

require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app();
/*echo 'test';
$custid = 9;
$customer = Mage::getModel('customer/customer')->load($custid);


//$custid = Mage::getSingleton('customer/session')->getId();
$data = Mage::getModel('customer/customer')->load($custid);

$addreses = $data->getAddresses();
$anjing = array();
foreach ($addreses as $add){
  $anjing[] = $add->toArray();
}
echo "<pre>";
print_r($anjing);
print_r($data->getData());
echo "</pre>";
$defBill = Mage::getModel('customer/address')->load($data->getDefaultBilling());
print_r( $defBill->getData());*/


function getAllOptions($withEmpty = false){
        $attribute = Mage::getModel('eav/config')->getAttribute('customer','npwp_type');
                    $atid = $attribute->getId();
                    $is_visible = $attribute->getIsVisible();
                    $storeId = 0;
                    $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
                    $sql = "select distinct o.*,ov.* from eav_attribute_option o
                            left join eav_attribute_option_value ov 
                            ON o.option_id = ov.option_id
                            where o.attribute_id = ".$atid." 
                            AND ov.store_id = ".$storeId."
                            "; 
            $rows = $connection->fetchAll($sql);
            $options = array();            
            	foreach($rows as $row){
                $opt['label'] = $row['value'];
                $opt['value'] = $row['value'];
                $opt['visibility'] = $is_visible;
                $options[] = $opt;
            	}                       
            return $options;
    }

echo "<pre>";
  print_r (getAllOptions());
  $attribute = Mage::getSingleton('eav/config')->getAttribute('customer','outlet_type');

echo "<pre>";
print_r($attribute->getData());
  