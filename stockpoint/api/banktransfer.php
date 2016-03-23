<?php
function get($param){
	$payments=Mage::getModel('paymentconfirmation/confirmation')->getCollection();
	if($param->filter){
		$filter=explode(',',$param->filter);
	}
	foreach ($payments as $pay) {
		# code...
		$idata=$pay->getData();
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
			$result[]=$pay->getData();
		}else
		$result[]=$pay->getData();
	}
	success('ok',$result);

}



function post($param){
	$payments=Mage::getModel('paymentconfirmation/confirmation')->getCollection();
	foreach ($payments as $pay) {
		# code...
		//echo $pay->getConfirmationId().'=='.$param->confirmation_id;
	if($pay->getConfirmationId()==$param->confirmation_id) {
		$data=$pay->getData();
		$newdata=json_decode($_POST['data'],true);

		foreach ($newdata as $key => $value) {
			# code...

			$data[$key]=$value;
		}

		$pay->setData($data);
		$pay->save();
		success('ok');
	}
	}
}
