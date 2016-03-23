<?php
function post($param,$post){			

	$customerObj=Mage::getModel('customer/customer')->load( $param->custid );

	foreach ($customerObj->getAddresses() as $address) {
			if($address->getId()==intval($param->addressid)) {
				$address->setIsDefaultBilling(true);
				$address->setIsDefaultShipping(true);
				$address->save();
				$customerObj->save();
				success('success2',$param);
				break;

			}
	}
	

}

function get($param){
	$customerObj=Mage::getModel('customer/customer')->load( $param->custid );
	$data=[];
	foreach ($customerObj->getAddresses() as $address) {
		$data[]=$address->getData();
	}
	success('success',$data);
}