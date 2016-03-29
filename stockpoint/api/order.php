<?php

function get($param) {
    $data = [];
    $i = 0;
    $j = 0;
    if ($param->status == "unpaid") {
        $order = Mage::getModel('sales/order')->getCollection()
                ->addAttributeToFilter('status', ['status' => 'pending'])
                ->addAttributeToFilter('created_at', array('gt' => $param->date));
        $orderpaid = array();

        foreach ($order as $value) {
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
            $orderpaid[$i]['shipping_address_id'] = $value['shipping_address_id'];
            $orderpaid[$i]['billing_address_id'] = $value['billing_address_id'];
            $orderpaid[$i]['shippingaddress_id'] = $value->getshipping_address_id();
            
            $addressshipping = Mage::getModel('sales/order_address')->load($value['shipping_address_id']);
            $address_shipping = Mage::getModel('customer/customer')->load($orderpaid[$i]['customer_id']);
            foreach ($address_shipping->getAddresses() as $alamat) {
                if ($addressshipping->getStreetFull() == $alamat->getStreetFull()) {
                    $orderpaid[$i]['shipping_address_detail'] = [
                        'outlet_name' => $alamat->getCompany(),
                        'firstname' => $alamat->getFirstname(),
                        'lastname' => $alamat->getLastname(),
                        'billing_address' => $alamat->getStreetFull(),
                        'telephone' => $alamat->getTelephone(),
                        'region' => $alamat->getRegion(),
                        'kota' => $alamat->getCity(),
                        'kecamatan' => $alamat->getKecamatan(),
                        'kelurahan' => $alamat->getKelurahan(),
                        'postcode' => $alamat->getPostcode(),
                        'email' => $alamat->getEmail(),
                        'stockpointcode' => $alamat->getStockpointcode()
                    ];
                    $j++;
                }
            }
            
            $addressbilling = Mage::getModel('sales/order_address')->load($value['billing_address_id']);
            $address_billing = Mage::getModel('customer/customer')->load($orderpaid[$i]['customer_id']);
            foreach ($address_billing->getAddresses() as $billing) {
                if ($addressbilling->getStreetFull() == $billing->getStreetFull()) {
                    $orderpaid[$i]['billing_address_detail'] = [
                        'outlet_name' => $billing->getCompany(),
                        'firstname' => $billing->getFirstname(),
                        'lastname' => $billing->getLastname(),
                        'billing_address' => $billing->getStreetFull(),
                        'telephone' => $billing->getTelephone(),
                        'region' => $billing->getRegion(),
                        'kota' => $billing->getCity(),
                        'kecamatan' => $billing->getKecamatan(),
                        'kelurahan' => $billing->getKelurahan(),
                        'postcode' => $billing->getPostcode(),
                        'email' => $billing->getEmail(),
                        'stockpointcode' => $billing->getStockpointcode()
                    ];
                    $j++;
                }
            }
            
            
           
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
        $collection = Mage::getModel('sales/order')->getCollection()
                ->addAttributeToFilter('status', ['in' => ['processing', 'complete']]);
        $orderpaid = array();

        $i = 0;
        foreach ($collection->getData() as $value) {
            $orderpaid[$i]['no_order'] = $value['increment_id'];
            $orderpaid[$i]['entity_id'] = $value['entity_id'];
            $orderpaid[$i]['created_at'] = $value['created_at'];
            $orderpaid[$i]['status'] = $value['status'];
            //$orderpaid[$i]['outletnama'] = $value['nama_outlet'];
            $orderpaid[$i]['base_shipping_incl_tax'] = $value['base_shipping_incl_tax'];
            $orderpaid[$i]['customer_id'] = $value['customer_id'];
            $orderpaid[$i]['customer_firstname'] = $value['customer_firstname'];
            $orderpaid[$i]['customer_lastname'] = $value['customer_lastname'];
            $payment = new Mage_Sales_Model_Order();
            $payment->loadByIncrementId($value['increment_id']);
            $orderpaid[$i]['payment_method'] = $payment->getPayment()->getMethodInstance()->getTitle();
            $address = Mage::getModel('customer/address')->load($value['shipping_address_id']);



            $addressshipping = Mage::getModel('sales/order_address')->load($value['shipping_address_id']);
            $address_shipping = Mage::getModel('customer/customer')->load($orderpaid[$i]['customer_id']);
            foreach ($address_shipping->getAddresses() as $alamat) {
                if ($addressshipping->getStreetFull() == $alamat->getStreetFull()) {
                    $orderpaid[$i]['shipping_address_detail'] = [
                        'outlet_name' => $alamat->getCompany(),
                        'firstname' => $alamat->getFirstname(),
                        'lastname' => $alamat->getLastname(),
                        'billing_address' => $alamat->getStreetFull(),
                        'telephone' => $alamat->getTelephone(),
                        'region' => $alamat->getRegion(),
                        'kota' => $alamat->getCity(),
                        'kecamatan' => $alamat->getKecamatan(),
                        'kelurahan' => $alamat->getKelurahan(),
                        'postcode' => $alamat->getPostcode(),
                        'email' => $alamat->getEmail(),
                        'stockpointcode' => $alamat->getStockpointcode()
                    ];
                    $j++;
                }
            }
            
            $addressbilling = Mage::getModel('sales/order_address')->load($value['billing_address_id']);
            $address_billing = Mage::getModel('customer/customer')->load($orderpaid[$i]['customer_id']);
            foreach ($address_billing->getAddresses() as $billing) {
                if ($addressbilling->getStreetFull() == $billing->getStreetFull()) {
                    $orderpaid[$i]['billing_address_detail'] = [
                        'outlet_name' => $billing->getCompany(),
                        'firstname' => $billing->getFirstname(),
                        'lastname' => $billing->getLastname(),
                        'billing_address' => $billing->getStreetFull(),
                        'telephone' => $billing->getTelephone(),
                        'region' => $billing->getRegion(),
                        'kota' => $billing->getCity(),
                        'kecamatan' => $billing->getKecamatan(),
                        'kelurahan' => $billing->getKelurahan(),
                        'postcode' => $billing->getPostcode(),
                        'email' => $billing->getEmail(),
                        'stockpointcode' => $billing->getStockpointcode()
                    ];
                    $j++;
                }
            }

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
