<?php

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app('admin');
$param = (object) $_GET;
$post = (object) $_POST;
$method = strtolower($_SERVER['REQUEST_METHOD']);

function success($msg, $data,$result) {
    $obj['success'] = true;
    $obj['message'] = $msg;
    $obj['data'] = $data;
    $obj['result'] = $result;
    echo json_encode((object) $obj);
}

function error($msg) {
    $obj['error'] = true;
    $obj['message'] = $msg;
    echo json_encode((object) $obj);
}

function _get($model) {
    $models = mage::getModel($model)->getCollection()->addAttributeToSelect('*');
    ;

    foreach ($models as $item) {
        $result[] = $item->getData();
    }
    success('success', $result);
}

function _post($ikey, $model, $post) {
    $data = json_decode($post->data, true);

    foreach ($data as $cust) {
        # code...
        unset($cust['id']);

        $customers = mage::getModel($model)->getCollection();
        $customers->addFieldToFilter($ikey, $cust[$ikey]);

        if (count($customers->getData()) <= 0) {
            $customer = mage::getModel($model);
        } if ($data[0]['confirmation'] == "true") {
            $customer = Mage::getModel('customer/customer')->load($data[0]['id']);
            $customer->getData();
            $customer->setConfirmation(false);
            $customer->getData('confirmation');
            $customer->save();
            $result=$customers->getData();
            success('success', count($data) .' updated', $result);
            die();
          
           
        } else {

           $customer = $customers->getFirstItem();
        
           $result[]= $customer->getData();
        }
        foreach ($cust as $key => $value) {
            # code...
            $customer->setData($key, $value);
            $result=$customer->getData();
        }

        try {
            $customer->save();
            $result=$customer->getData();
        
        } catch (Exception $e) {
           $result[]= error($e->getMessage());
            $result=$customer->getData();
        }
    }
    success('success', count($data) .' updated', $result);
}

function _delete($key, $param, $model) {
    $customers = mage::getModel($model)->getCollection();
    $p = (array) $param;
    $customers->addFieldToFilter($key, $p[$key]);
    $customer = $customers->getFirstItem();
    $customer->delete();
    $result=$customer->getData();
    success('success', ' deleted',$result);
}
