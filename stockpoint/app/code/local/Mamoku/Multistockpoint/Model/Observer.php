<?php

class Mamoku_Multistockpoint_Model_Observer
{
    /**
     * Flag to stop observer executing more than once
     *
     * @var static bool
     */
    static protected $_singletonFlag = false;

    /**
     * This method will run when the product is saved from the Magento Admin
     * Use this function to update the product model, process the
     * data or anything you like
     *
     * @param Varien_Event_Observer $observer
     */
    public function saveProductTabData(Varien_Event_Observer $observer)
    {
        if (!self::$_singletonFlag) {
            self::$_singletonFlag = true;

            $product = $observer->getEvent()->getProduct();




            try {
                /**
                 * Perform any actions you want here
                 *
                 */
                $price_qty =  $this->_getRequest()->getPost('price_qty');
                // $obj=json_decode($price_qty,true);
                // if(count($obj)>0){
                //     $product->setPrice($obj[0]['price']):
                // }

                $product->setPrice_qty($price_qty);
                // /**
                //  * Uncomment the line below to save the product
                //  *
                //  */
                $product->getResource()->save($product);
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
    }
    
    public function updatePriceSaveAjax(Varien_Event_Observer $observer) {                
        $cart=$observer->cart;
        $id=Mage::app()->getRequest()->getParam('id');
        if($id>0){
            $quote_item = $cart->getQuote()->getItemById($id);
            $qty=Mage::app()->getRequest()->getParam('qty');
            
            $product=Mage::getModel('catalog/product')->load($quote_item->getProduct()->getId());        
            $prices=Mage::getModel('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
            foreach ($prices as $pritem) {
                # code...
                
                if($qty>=$pritem->getMinqty()){
                    $prname=$pritem->getTypename();
                    break;
                }
            }
            

            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            $address=Mage::getModel('customer/address')->load($customerAddressId);
            $locationc=Mage::getModel('multistockpoint/locationcoverage')->getCollection();
            $code='';
            foreach ($locationc as $loc) {
                # code...
                if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
                    $code=$loc->getStockpoint_code();
                }
            }


            $location=Mage::getModel('multistockpoint/stockpoint')->getCollection();
            $id=0;
            foreach ($location as $l) {
                # code...   
                        
                if($l->getCode()==$code){
                    $id=$l->getData()['id'];
                }
            }
            
            $obj=json_decode(str_replace("'", '"', $product->getPrice_qty()),true);
            
            
            if($code!=''){
                
                $new_price = $obj[$prname][$id];
              
                
                if(intval($new_price)>0){
                    $quote_item->setOriginalCustomPrice($new_price);
                    $quote_item->save();
                }
            }

        }

    }
  
    public function updatePriceAll(Varien_Event_Observer $observer) {                
        $data=$observer->info;
        foreach ($data as $itemId => $itemInfo) {
            $quote_item = $observer->cart->getQuote()->getItemById($itemId);
            $qty=$itemInfo['qty'];
            $product=Mage::getModel('catalog/product')->load($quote_item->getProduct()->getId());        
            $prices=Mage::getModel('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
            foreach ($prices as $pritem) {
                # code...
                
                if($qty>=$pritem->getMinqty()){
                    $prname=$pritem->getTypename();
                    break;
                }
            }
            

            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            $address=Mage::getModel('customer/address')->load($customerAddressId);
            $locationc=Mage::getModel('multistockpoint/locationcoverage')->getCollection();
            $code='';
            foreach ($locationc as $loc) {
                # code...
                if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
                    $code=$loc->getStockpoint_code();
                }
            }


            $location=Mage::getModel('multistockpoint/stockpoint')->getCollection();
            $id=0;
            foreach ($location as $l) {
                # code...   
                        
                if($l->getCode()==$code){
                    $id=$l->getData()['id'];
                }
            }
            
            $obj=json_decode(str_replace("'", '"', $product->getPrice_qty()),true);
            
            
            if($code!=''){
                
                $new_price = $obj[$prname][$id];
                
                
                if(intval($new_price)>0){
                    $quote_item->setOriginalCustomPrice($new_price);
                    $quote_item->save();
                }
            }
        }
        
    }
    
    public function updatePrice2(Varien_Event_Observer $observer) {                
        
        $quote_item=$observer->quote_item;        
        $qty=Mage::app()->getRequest()->getParam('qty');

        if($quote_item){
            $product=Mage::getModel('catalog/product')->load($quote_item->getProduct()->getId());        
            $prices=Mage::getModel('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
            foreach ($prices as $pritem) {
                # code...
                
                if($qty>=$pritem->getMinqty()){
                    $prname=$pritem->getTypename();
                    break;
                }
            }
            

            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            $address=Mage::getModel('customer/address')->load($customerAddressId);
            $locationc=Mage::getModel('multistockpoint/locationcoverage')->getCollection();
            $code='';
            foreach ($locationc as $loc) {
                # code...
                if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
                    $code=$loc->getStockpoint_code();
                }
            }


            $location=Mage::getModel('multistockpoint/stockpoint')->getCollection();
            $id=0;
            foreach ($location as $l) {
                # code...   
                        
                if($l->getCode()==$code){
                    $id=$l->getData()['id'];
                }
            }
            
            $obj=json_decode(str_replace("'", '"', $product->getPrice_qty()),true);
            
            
            if($code!=''){
                
                $new_price = $obj[$prname][$id];
                
                
                if(intval($new_price)>0){
                    $quote_item->setOriginalCustomPrice($new_price);
                    $quote_item->save();
                }
            }
        }        
    }    
   
    public function updatePrice(Varien_Event_Observer $observer) {
        $event = $observer->getEvent();        
        $qty=Mage::app()->getRequest()->getParam('qty');
        $quote_item = $event->getQuoteItem();
        
        if($quote_item){
            //echo "id".$quote_item->getProduct()->getId();
            $product=Mage::getModel('catalog/product')->load($quote_item->getProduct()->getId());        
            $prices=Mage::getModel('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
            foreach ($prices as $pritem) {
                # code...

                if($qty>=$pritem->getMinqty()){
                    $prname=$pritem->getTypename();
                    break;
                }
            }
            //echo "FUUU".$prname;exit();

            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            $address=Mage::getModel('customer/address')->load($customerAddressId);
            $locationc=Mage::getModel('multistockpoint/locationcoverage')->getCollection();
            $code='';
            foreach ($locationc as $loc) {
                # code...
                if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
                    $code=$loc->getStockpoint_code();
                }
            }
            //echo "CODE".$code;exit();

            $location=Mage::getModel('multistockpoint/stockpoint')->getCollection();
            $id=0;
            foreach ($location as $l) {
                # code...   
                
                if($l->getCode()==$code){
                    $id=$l->getData()['id'];
                }
            }
            
            $obj=json_decode(str_replace("'", '"', $product->getPrice_qty()),true);
            
            if($code!=''){
                
                $new_price = $obj[$prname][$id];
                //echo "SUUUUU".$new_price;exit();
                
                if(intval($new_price)>0){
                    $quote_item->setOriginalCustomPrice($new_price);
                    $quote_item->save();
                }
            }
        }
    }    
    public function initProductTabData(Varien_Event_Observer $observer)
    {

        $product = $observer->getEvent()->getProduct();
        Mage::getSingleton("adminhtml/session")->setProductPriceqty($product->getPrice_qty());
        $product->setPrice(1); // SET YOUR PRICE HERE
        $product->setTaxClassId(0);
        $product->setData('qty',1);        
    }
    public function editProductTabData(Varien_Event_Observer $observer)
    {

        $product = $observer->getEvent()->getProduct();        
        Mage::getSingleton("adminhtml/session")->setProductPriceqty($product->getPrice_qty());

        
    }
    /**
     * Retrieve the product model
     *
     * @return Mage_Catalog_Model_Product $product
     */
    public function getProduct()
    {
        return Mage::registry('product');
    }

    /**
     * Shortcut to getRequest
     *
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }
    

}
