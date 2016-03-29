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

			/* check warehouse stock start */
			$product_id = $quote_item->getProduct()->getId();
			$_resource = Mage::getSingleton('catalog/product')->getResource();
			$optionValue = $_resource->getAttributeRawValue($product_id,'price_qty',Mage::app()->getStore());
			$warehoustObj=json_decode(str_replace("'", '"', $optionValue),true);
			/* The folloing code is used to check whether customer is loggedin or not start */
			if(!Mage::getSingleton('customer/session')->isLoggedIn()){
				$currentStock = $warehoustObj['qty'][1];
			}else{
				$customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
				$address=Mage::getSingleton('customer/address')->load($customerAddressId);
				$locationc=Mage::getSingleton('multistockpoint/locationcoverage')->getCollection();
				$code='';
				$StockPointId = 0;
				foreach ($locationc as $loc) {
					if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
					   $code=$loc->getStockpoint_code();
					}
				}
				$location=Mage::getSingleton('multistockpoint/stockpoint')
											->getCollection()
											->addFieldToSelect('id')
											->addFieldToFilter('code',$code);
				$stokpointData = $location->getData();
				$StockPointId = $stokpointData[0]['id']; 
				$currentStock = $warehoustObj['qty'][$StockPointId];
			}
			/* The folloing code is used to check whether customer is loggedin or not start */
			$qtyOrdered = $qty;
			$remainingStock = (string)($currentStock - (int)$qtyOrdered);
			
			if((int)$remainingStock < 0){
				Mage::throwException('Stock is not enough');
				return $this;
			}
			/* check warehoust stock end */
            
			$product=Mage::getSingleton('catalog/product')->load($quote_item->getProduct()->getId());        
            $prices=Mage::getSingleton('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
            foreach ($prices as $pritem) {
                if($qty>=$pritem->getMinqty()){
                    $prname=$pritem->getTypename();
                    break;
                }
            }
            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            $address=Mage::getSingleton('customer/address')->load($customerAddressId);
            $locationc=Mage::getSingleton('multistockpoint/locationcoverage')->getCollection();
            $code='';
            foreach ($locationc as $loc) {
                if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
                    $code=$loc->getStockpoint_code();
                }
            }


            $location=Mage::getSingleton('multistockpoint/stockpoint')->getCollection();
            $id=0;
            foreach ($location as $l) {
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
	public function addToCartStockChecking($observer){ //Fired when add to cart button is pressed

		$product = $observer->getEvent()->getProduct();

		if(!Mage::getSingleton('customer/session')->isLoggedIn() && isset($product)){ // For not loggedin user
			
			/* check warehouse stock start */
			$product_id = $product->getId();
			$_resource = Mage::getSingleton('catalog/product')->getResource();
			$cartHelper = Mage::helper('checkout/cart');
			$items = $cartHelper->getCart()->getItems();
			if(count($items)){
				foreach ($items as $item) {
					if ($item->getProduct()->getId() == $product_id) {
						$optionValue = $_resource->getAttributeRawValue($product_id,'price_qty',Mage::app()->getStore());
						$warehoustObj=json_decode(str_replace("'", '"', $optionValue),true);
						$currentStock = $warehoustObj['qty'][1];
						$qtyOrdered = $item->getData('qty');
						$remainingStock = (string)($currentStock - (int)$qtyOrdered);
						if((int)$remainingStock < 0){
							Mage::throwException('Stock is not enough');
							return $this;
						}
					}
				}
			}else{
						$optionValue = $_resource->getAttributeRawValue($product_id,'price_qty',Mage::app()->getStore());
						$warehoustObj=json_decode(str_replace("'", '"', $optionValue),true);
						$currentStock = $warehoustObj['qty'][1];
						$qtyOrdered = 1;
						$remainingStock = (string)($currentStock - (int)$qtyOrdered);
						if((int)$remainingStock < 0){
							Mage::throwException('Stock is not enough');
							return $this;
						}
			}
			/* check warehoust stock end */
		}else{ // // For loggedin user
		
			$customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            $address=Mage::getSingleton('customer/address')->load($customerAddressId);
            $locationc=Mage::getSingleton('multistockpoint/locationcoverage')->getCollection();
            $code='';
			$StockPointId = 0;
            foreach ($locationc as $loc) {
                if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
                   $code=$loc->getStockpoint_code();
                }
            }
			$location=Mage::getSingleton('multistockpoint/stockpoint')
										->getCollection()
										->addFieldToSelect('id')
										->addFieldToFilter('code',$code);
			$stokpointData = $location->getData();
			$StockPointId = $stokpointData[0]['id']; 
			
			$product_id = $product->getId();
			$_resource = Mage::getSingleton('catalog/product')->getResource();
			$cartHelper = Mage::helper('checkout/cart');
			$items = $cartHelper->getCart()->getItems();
			foreach ($items as $item) {
				if ($item->getProduct()->getId() == $product_id) {
					$optionValue = $_resource->getAttributeRawValue($product_id,'price_qty',Mage::app()->getStore());
					$warehoustObj=json_decode(str_replace("'", '"', $optionValue),true);
					$currentStock = $warehoustObj['qty'][$StockPointId];
					$qtyOrdered = $item->getData('qty');
					$remainingStock = (string)($currentStock - (int)$qtyOrdered);
					if((int)$remainingStock < 0){
						Mage::throwException('Stock is not enough');
						return $this;
					}
				}
			}
			/* check warehoust stock end */
		}
		return $this;
	}
	public function managestock($observer){ // This function is get called when order is placed
		$orderId = $observer->getEvent()->getOrder();
		$order = Mage::getModel('sales/order')->loadByIncrementId($orderId->getIncrementId());
		/* The folloing code is used to check whether customer is loggedin or not start */
			if(!Mage::getSingleton('customer/session')->isLoggedIn()){
				$currentStockId = 1;
			}else{
				$customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
				$address=Mage::getSingleton('customer/address')->load($customerAddressId);
				$locationc=Mage::getSingleton('multistockpoint/locationcoverage')->getCollection();
				$code='';
				$StockPointId = 0;
				foreach ($locationc as $loc) {
					if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
					   $code=$loc->getStockpoint_code();
					}
				}
				$location=Mage::getSingleton('multistockpoint/stockpoint')
											->getCollection()
											->addFieldToSelect('id')
											->addFieldToFilter('code',$code);
				$stokpointData = $location->getData();
				$StockPointId = $stokpointData[0]['id']; 
				$currentStockId = $StockPointId;
			}
			/* The folloing code is used to check whether customer is loggedin or not start */
		foreach ($order->getAllItems() as $itemId => $item)
		{
			 $product_id = $item->getProductId();
			 $_resource = Mage::getSingleton('catalog/product')->getResource();
			 $optionValue = $_resource->getAttributeRawValue($product_id,'price_qty',Mage::app()->getStore());
			 $obj=json_decode(str_replace("'", '"', $optionValue),true);
			 $currentStock = $obj['qty'][$currentStockId];
			 $qtyOrdered = $item->getData('qty_ordered');
			 $remainingStock = (string)($currentStock - (int)$qtyOrdered);
			 $obj['qty'][$currentStockId] = "{$remainingStock}"; 
			 $productPricesAndStock = json_encode($obj,true);
			 $productPricesAndStock = str_replace('"',"'",$productPricesAndStock);
			 $productPricesAndStock = "\"{$productPricesAndStock}\"";
			
			 try{
				$resource = Mage::getSingleton('core/resource');
				$readConnection = $resource->getConnection('core_read');
				$query = "SELECT attribute_id from eav_attribute where attribute_code = 'price_qty' ";
				$attributeId = $readConnection->fetchOne($query);
				$query = 'UPDATE catalog_product_entity_varchar SET value = '.$productPricesAndStock.' WHERE entity_id = '.$product_id.' and attribute_id ='.$attributeId;
				$writeConnection = $resource->getConnection('core_write');
				$writeConnection->query($query);
			}catch(Exception $e){
					echo $e->getMessage();
			}
		} 
		return true;
	}	

}
