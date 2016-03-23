<?php
function get($param){
	$customerObj=Mage::getModel('customer/customer')->load( $param->custid );
	$data=[];
	if($param->filter){
		$filter=explode(',',$param->filter);
	}
	foreach ($customerObj->getAddresses() as $address) {
		$idata=$address->getData();
		if($filter){
			$match=true;
			foreach ($filter as $fitem) {
				# code...
				$kval=explode(':', $fitem);
				if($idata[$kval[0]]!=$kval[1]){
					$match=false;
				}
			}
			if($match)
			$result[]=$address->getData();
		}else
		$result[]=$address->getData();
	}
	success('success',$result);
}

function post($param,$post){
	$customerObj=Mage::getModel('customer/customer')->load( $param->custid );
	$data=json_decode($post->data,true);
	foreach ($data as $addr) {
		# code...
		foreach ($customerObj->getAddresses() as $address) {
			if($address->getId()==intval($addr['entity_id'])) {
				$address->setData($addr);
				$address->save();
			}
		}
	}

	$customerObj->save();


}

function delete($param){
	$customerObj=Mage::getModel('customer/customer')->load( $param->custid );

	foreach ($customerObj->getAddresses() as $address) {
		if($address->getId()==intval($param->addressid)) {
			$address->delete();
		}
	}


	$customerObj->save();


}
