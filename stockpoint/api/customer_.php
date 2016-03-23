<?php

function get($param) {

    if ($param->status == "unpaid") {
        $order = Mage::getModel('sales/order')->getCollection()
                ->addAttributeToFilter('status', ['status' => 'pending'])
                ->addAttributeToFilter('created_at', array('gt' => $param->date));
        $orderpaid = array();
        $i = 0;
        foreach ($order->getData() as $value) {
            $orderpaid[$i]['no_order'] = $value['increment_id'];
            $orderpaid[$i]['entity_id'] = $value['entity_id'];
            $orderpaid[$i]['created_at'] = $value['created_at'];
            $orderpaid[$i]['status'] = $value['status'];
            $orderpaid[$i]['base_shipping_incl_tax'] = $value['base_shipping_incl_tax'];
            $orderpaid[$i]['customer_id'] = $value['customer_id'];
            //$orderpaid[$i]['outletnama'] = $value['nama_outlet'];
            $orderpaid[$i]['customer_firstname'] = $value['customer_firstname'];
            $orderpaid[$i]['customer_lastname'] = $value['customer_lastname'];
            $payment = new Mage_Sales_Model_Order();
            $payment->loadByIncrementId($value['increment_id']);
            $orderpaid[$i]['payment_method'] = $payment->getPayment()->getMethodInstance()->getTitle();

            $address = Mage::getModel('customer/address')->load($value['shipping_address_id']);
            $orderpaid[$i]['shipping_address_detail'] = [
                'shipping_address' => $address->getStreetFull(),
            'name' => $address->getCompany(),
            'phone' => $address->getTelephone(),
            'fax' => $address->getFax(),
            'region' => $address->getRegion(),
            'kota' => $address->getCity(),
            'kecamatan' => $address->getKecamatan(),
            'kelurahan' => $address->getKelurahan(),
            'country' => $address->getCountry(),
            'postcode' => $address->getpostcode(),
            'stockpoint_code' => $address->getStockpointcode()
            ];
            $billing = Mage::getModel('customer/address')->load($value['billing_address_id']);
            $orderpaid[$i]['billing_address_detail'] = [
                'billing_address' => $billing->getStreetFull(),
            'name' => $address->getCompany(),
            'phone' => $address->getTelephone(),
            'fax' => $address->getFax(),
            'region' => $address->getRegion(),
            'kota' => $address->getCity(),
            'kecamatan' => $address->getKecamatan(),
            'kelurahan' => $address->getKelurahan(),
            'country' => $address->getCountry(),
            'postcode' => $address->getpostcode(),
            'stockpoint_code' => $address->getStockpointcode()
            ];

            $order = Mage::getModel('sales/order')->loadByIncrementId($orderpaid[$i]['no_order']);
            $items = $order->getAllVisibleItems();
            $itemcount = count($items);
            $orderpaid[$i]['productdetail'] = array();
            $j = 0;

            foreach ($items as $item) {
                $orderpaid[$i]['productdetail'][$j]['product_id'] = $item->get;
                $orderpaid[$i]['productdetail'][$j]['product_id'] = $item->getProductId();
                $orderpaid[$i]['productdetail'][$j]['product_sku'] = $item->getSku();
                $orderpaid[$i]['productdetail'][$j]['product_name'] = $item->getName();
                $orderpaid[$i]['productdetail'][$j]['price'] = $item->getPrice();
                $orderpaid[$i]['productdetail'][$j]['product_order_quantity'] = $item->getQtyOrdered();
                $j++;
            }
            $orderpaid[$i]['base_tax_amount'] = $value['base_tax_amount'];
            $orderpaid[$i]['base_shipping_amount'] = $value['base_shipping_amount'];
            $orderpaid[$i]['base_subtotal_incl_tax'] = $value['base_subtotal_incl_tax'];
            $orderpaid[$i]['discount'] = $value['base_discount_amount'];
            $orderpaid[$i]['grand_total'] = $value['base_grand_total'];
            $i++;
        }
    }if ($param->status == "paid") {
          $order = Mage::getModel('sales/order')->getCollection()
              
                 ->addAttributeToFilter('status', ['in' => ['processing', 'complete']]);
        $orderpaid = array();
        $i = 0;
        foreach ($order->getData() as $value) {
            $orderpaid[$i]['no_order'] = $value['increment_id'];
            $orderpaid[$i]['entity_id'] = $value['entity_id'];
            $orderpaid[$i]['created_at'] = $value['created_at'];
            $orderpaid[$i]['status'] = $value['status'];
            $orderpaid[$i]['base_shipping_incl_tax'] = $value['base_shipping_incl_tax'];
            $orderpaid[$i]['customer_id'] = $value['customer_id'];
            //$orderpaid[$i]['outletnama'] = $value['nama_outlet'];
            $orderpaid[$i]['customer_firstname'] = $value['customer_firstname'];
            $orderpaid[$i]['customer_lastname'] = $value['customer_lastname'];
            $payment = new Mage_Sales_Model_Order();
            $payment->loadByIncrementId($value['increment_id']);
            $orderpaid[$i]['payment_method'] = $payment->getPayment()->getMethodInstance()->getTitle();
   $address = Mage::getModel('customer/address')->load($value['default_billing']);
        $result[$i]['billing_address_detail'] = [
            'billing_address' => $address->getStreetFull(),
            'name' => $address->getCompany(),
            'phone' => $address->getTelephone(),
            'fax' => $address->getFax(),
            'region' => $address->getRegion(),
            'kota' => $address->getCity(),
            'kecamatan' => $address->getKecamatan(),
            'kelurahan' => $address->getKelurahan(),
            'country' => $address->getCountry(),
            'postcode' => $address->getpostcode(),
            'stockpoint_code' => $address->getStockpointcode()
        ];
        $address = Mage::getModel('customer/address')->load($value['default_shipping']);
        $result[$i]['shipping_address_detail'] = [
            'shipping_address' => $address->getStreetFull(),
            'name' => $address->getCompany(),
            'phone' => $address->getTelephone(),
            'fax' => $address->getFax(),
            'region' => $address->getRegion(),
            'kota' => $address->getCity(),
            'kecamatan' => $address->getKecamatan(),
            'kelurahan' => $address->getKelurahan(),
            'country' => $address->getCountry(),
            'postcode' => $address->getpostcode(),
            'stockpoint_code' => $address->getStockpointcode()
        ];



            $order = Mage::getModel('sales/order')->loadByIncrementId($orderpaid[$i]['no_order']);
            $items = $order->getAllVisibleItems();
            $itemcount = count($items);
            $orderpaid[$i]['productdetail'] = array();
            $j = 0;

            foreach ($items as $item) {
                $orderpaid[$i]['productdetail'][$j]['product_id'] = $item->get;
                $orderpaid[$i]['productdetail'][$j]['product_id'] = $item->getProductId();
                $orderpaid[$i]['productdetail'][$j]['product_sku'] = $item->getSku();
                $orderpaid[$i]['productdetail'][$j]['product_name'] = $item->getName();
                $orderpaid[$i]['productdetail'][$j]['price'] = $item->getPrice();
                $orderpaid[$i]['productdetail'][$j]['product_order_quantity'] = $item->getQtyOrdered();
                $j++;
            }
            $orderpaid[$i]['base_tax_amount'] = $value['base_tax_amount'];
            $orderpaid[$i]['base_shipping_amount'] = $value['base_shipping_amount'];
            $orderpaid[$i]['base_subtotal_incl_tax'] = $value['base_subtotal_incl_tax'];
            $orderpaid[$i]['discount'] = $value['base_discount_amount'];
            $orderpaid[$i]['grand_total'] = $value['base_grand_total'];
            $i++;
        }
    }


    success('success', $orderpaid);
}

function post($param, $post) {
    _post('entity_id', 'sales/order', $post);
}

function delete($param) {
    _delete('email', $param, 'customer/customer');
}
