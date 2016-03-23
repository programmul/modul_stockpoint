<?php
function get($param){
	$prod=Mage::getModel('catalog/product')->load($param->productid);
	if(!$prod->getId()){
		error('productid not found');
	}
	$ob=str_replace("'",'"',$prod->getPrice_qty());
	$obj=json_decode($ob,true);
	//print_r($obj);
	$found=false;
	foreach ($obj as $oname => $o) {
		if(strtolower($oname)==strtolower($param->pricetype)){
			foreach ($o as $key => $value) {
				# code...

				if($key==$param->locationid){
					$found=true;
					success("success",$value);
				}

			}
		}
	}
	if(!$found){
		error('locationid not found');
	}

}


function post($param,$post){
	$prod=Mage::getModel('catalog/product')->load($param->productid);
	if(!$prod->getId()){
		error('productid not found');
	}
	$ob=str_replace("'",'"',$prod->getPrice_qty());
	$obj=json_decode($ob,true);
	//print_r($obj);
	$found=false;
	foreach ($obj as $oname => $o) {
		if(strtolower($oname)==strtolower($param->pricetype)){
			foreach ($o as $key => $value) {
				# code...

				if($key==$param->locationid){
					$found=true;
					$obj[$param->pricetype][$param->locationid]=$param->newprice;
					$prod->setPrice_qty(json_encode($obj));
					$prod->save();
					success("success");
				}

			}
		}
	}
	if(!$found){
		error('locationid not found');
	}

}
