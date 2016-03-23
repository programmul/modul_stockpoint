<?php
function get($param){

	$models = mage::getModel('multistockpoint/locationcoverage')->getCollection();
	if($param->filter){
		$filter=explode(',',$param->filter);
	}
	foreach($models as $item){
		$idata=$item->getData();
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
			$result[]=$item->getData();
		}else
		$result[]=$item->getData();
	}
	success('success',$result);
}


function post($param,$post){
	_post('id','multistockpoint/locationcoverage',$post);
}

function delete($param){
	_delete('id',$param,'multistockpoint/locationcoverage')	;
}
