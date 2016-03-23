<?php
function get($param){

	$models = mage::getModel('multistockpoint/stockpoint')->getCollection();

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
	_post('code','multistockpoint/stockpoint',$post);
}

function delete($param){
	_delete('code',$param,'multistockpoint/stockpoint')	;
}
