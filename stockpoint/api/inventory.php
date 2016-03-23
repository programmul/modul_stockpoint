<?php
function get($param){

	$prod=Mage::getModel('catalog/product')->load($param->productid);
	if(!$prod){
		error('productid not found');
	}
	$ob=str_replace("'",'"',$prod->getPrice_qty());
	if(empty($ob)){
		error('this product not exist or does not have correct price or qty');
	}
	$obj=json_decode($ob,true);
  $found=false;
	foreach ($obj['qty'] as $key => $value) {

			if($key==$param->locationid){
				$found=true;
				success("success",$value);
			}
	}
	if(!$found){
		error('locationid not found');
	}


}


function post($param,$post){
	$prod=Mage::getModel('catalog/product')->load($param->productid);
	$ob=str_replace("'",'"',$prod->getPrice_qty());
	$obj=json_decode($ob,true);
	foreach ($obj['qty'] as $key => $value) {
			if($key==$param->locationid){
				$obj['qty'][$param->locationid]=$param->newqty;

				$prod->setPrice_qty(json_encode($obj));
				$prod->save();
				success("success");
			}
	}

}

function delete($param){
	$prod=Mage::getModel('catalog/product')->load($param->productid);
	$ob=str_replace("'",'"',$prod->getPrice_qty());
	$obj=json_decode($ob,true);
	foreach ($obj['qty'] as $key => $value) {
			if($key==$param->locationid){
				$obj[$key]=0;
				$prod->setPrice_qty(json_encode($obj));
				$prod->save();
				success("success",$value);
			}
	}
}
