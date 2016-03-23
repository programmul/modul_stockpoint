<?php

function post($param, $post) {
    $i = 0;
    $data = json_decode($post->data, true);
    $customer = Mage::getModel('customer/customer')->load($param->custid);
    $customAddress = \Mage::getModel('customer/address');

    foreach ($data as $addr) {
        $data[$i] = $addr;
        $customAddress->setData($key, $addr)
                ->setCustomerId($customer->getId()) // this is the most important part
                ->setIsDefaultBilling('1')  // set as default for billing
                ->setIsDefaultShipping('1') // set as default for shipping
                ->setSaveInAddressBook('1')
                ->setCountry_id($data[$i]['country_id'])
                ->setRegion($data[$i]['region'])
                ->setCity($data[$i]['city'])
                ->setKecamatan($data[$i]['kecamatan'])
                ->setKelurahan($data[$i]['kelurahan'])
                ->setstreet($data[$i]['street'])
                ->setpostcode($data[$i]['postcode'])
                ->setstockpointcode($data[$i]['stockpointcode'])
                ->setfirstname($data[$i]['firstname'])
                ->setlastname($data[$i]['lastname'])
                ->setpostcode($data[$i]['postcode'])
                ->settelephone($data[$i]['telephone'])
                ->setfax($data[$i]['fax'])
                ->setcompany($data[$i]['company']);
        $i++;
    }
    $customAddress->save();
    $result=$customAddress->getData();
    success('success', count($customAddress) . ' updated', $result);
}

function delete($param) {
    _delete('entity_id', $param, 'customer/address');
}

function get($param) {
    $address = Mage::getModel('customer/address')->getCollection()->addAttributeToSelect('*');
    $data = [];
    $i = 0;
    foreach ($address as $item) {
        $data[$i]['entity_id'] = $item['entity_id'];
        $data[$i]['entity_type_id'] = $item['entity_type_id'];
        $data[$i]['attribute_set_id'] = $item['attribute_set_id'];
        $data[$i]['parent_id'] = $item['parent_id '];
        $data[$i]['parent_id'] = $item['parent_id'];
        $data[$i]['created_at'] = $item['created_at'];
        $data[$i]['updated_at'] = $item['updated_at'];
        $data[$i]['is_active'] = $item['is_active'];
        $data[$i]['firstname'] = $item['firstname'];
        $data[$i]['lastname'] = $item['lastname'];
        $data[$i]['outlet_name'] = $item['company'];
        $data[$i]['country_id'] = $item['country_id'];
        $data[$i]['provinsi'] = $item['region'];
        $data[$i]['kota'] = $item['city'];
        $data[$i]['kelurahan'] = $item['kelurahan'];
        $data[$i]['kecamatan'] = $item['kecamatan'];
        $data[$i]['postcode'] = $item['postcode'];
        $data[$i]['telephone'] = $item['telephone'];
        $data[$i]['fax'] = $item['fax'];
        $data[$i]['stockpointcode'] = $item['stockpointcode'];
        $data[$i]['street'] = $item['street'];
        $data[$i]['region_id'] = $item['region_id'];
        $data[$i]['customer_id'] = $item->getCustomerId();
        $i++;
    }
    success('success', $data);
}
