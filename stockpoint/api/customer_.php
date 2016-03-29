
<?php
function get($param) {
    $i = 0;
    $j=0;
$alamat=[];
    $result=[];
    $models = mage::getModel('customer/customer')->getCollection()->addAttributeToSelect('*')
            ->addAttributeToFilter('updated_at', array('gt' => $param->date));
    foreach ($models as $item) {
        $result[$i]['entity_id'] = $item['entity_id'];
        $result[$i]['entity_type_id'] = $item['entity_type_id'];
        $result[$i]['attribute_set_id'] = $item['attribute_set_id'];
        $result[$i]['website_id'] = $item['website_id'];
        $result[$i]['email'] = $item['email'];
        $result[$i]['group_id'] = $item['group_id'];
        $result[$i]['increment_id'] = $item['increment_id'];
        $result[$i]['store_id'] = $item['store_id'];
        $result[$i]['created_at'] = $item['created_at'];
	$result[$i]['updated_at'] = $item['updated_at'];
        $result[$i]['alamat_npwp'] = $item['npwp_address'];
        $result[$i]['firstname'] = $item['firstname'];
        $result[$i]['middlename'] = $item['middlename'];
        $result[$i]['lastname'] = $item['lastname'];
        $result[$i]['nama_outlet'] = $item['nama_outlet'];
        $result[$i]['pemilikl_outlet'] = $item['outlet_owner'];
        $result[$i]['nomor_id'] = $item['ktp_number'];
        $result[$i]['nomor_npwp'] = $item['npwp_number'];
        $result[$i]['nama_npwp'] = $item['npwp_name'];
        $result[$i]['no_hp'] = $item['mobile_number'];
        $result[$i]['no_telp'] = $item['telephone'];
        $result[$i]['no_fax'] = $item['no_fax'];
        $result[$i]['confirmation'] = $item['confirmation'];
        $result[$i]['outlet_type'] = $item['outlet_type'];
        $result[$i]['tipe_npwp'] = $item['npwp_type'];
        $result[$i]['is_verified'] = $item['is_verified'];
        $result[$i]['default_billing'] = $item['default_billing'];
        $result[$i]['default_shipping'] = $item['default_shipping'];
   
        $address =Mage::getModel('customer/customer')->load($result[$i]['entity_id']);
	
	foreach ($address ->getAddresses() as $address) {
		$alamat[$i][]=$address->getData();
                

	}
$result[$i]['outlet_delivery_address']=$alamat[$i];
//        $address = Mage::getModel('customer/address')->load($item['default_shipping']);
//        $result[$i]['shipping_address_detail'] = [
//            'shipping_address' => $address->getStreetFull(),
//            'name' => $address->getCompany(),
//            'phone' => $address->getTelephone(),
//            'fax' => $address->getFax(),
//            'provinsi' => $address->getRegion(),
//            'kota' => $address->getCity(),
//            'kecamatan' => $address->getKecamatan(),
//            'kelurahan' => $address->getKelurahan(),
//            'country' => $address->getCountry(),
//            'postcode' => $address->getpostcode(),
//            'stockpoint_code' => $address->getStockpointcode()
//        ];

        $i++;
    }
    success('success', $result);
}

function post($param, $post) {
    _post('email', 'customer/customer', $post);
}

function delete($param) {
    _delete('email', $param, 'customer/customer');
}
