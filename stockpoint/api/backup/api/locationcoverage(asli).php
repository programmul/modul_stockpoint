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


function post($param, $post) {
    $data = json_decode($post->data);
    $models = mage::getModel('multistockpoint/locationcoverage')->load($param->loc_id);
    if (!empty($models)) {
        foreach ($data as $data) {
            $models->setPropinsi($data->propinsi);
            $models->setKota($data->kota);
            $models->setKecamatan($data->kecamatan);
            $models->setKelurahan($data->kelurahan);
            $models->setStockpoint_code($data->stockpoint_code);
            $models->save();
            $result= $models->getData();
              success('success', count($data) . ' updated', $result);
        }
    } else {
        $result= "Location is not defined";
          success('success', count($data) . ' created', $result);
    }



  
    //_post('stockpoint_code','multistockpoint/locationcoverage',$post);
}

function delete($param){
	_delete('stockpoint_code',$param,'multistockpoint/locationcoverage')	;
}
