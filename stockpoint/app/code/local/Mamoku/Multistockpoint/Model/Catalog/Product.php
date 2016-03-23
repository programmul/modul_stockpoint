<?php
class Mamoku_Multistockpoint_Model_Catalog_Product extends Mage_Catalog_Model_Product
{    /**
     * Get product price throught type instance
     *
     * @return unknown
     */
    public function getPrice()
    {
        $product=$this;
        $qty=1;
        if(Mage::getSingleton('customer/session')->isLoggedIn()){ // For loggedIn user
            $prices=Mage::getModel('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
            foreach ($prices as $pritem) {
                if($qty>=$pritem->getMinqty()){
                    $prname=$pritem->getTypename();
                    break;
                }
            }
            if(!isset($prname)){
              return 12345;
            }
            $customerAddressId = Mage::getSingleton('customer/session')->getCustomer()->getDefaultShipping();
            $address=Mage::getModel('customer/address')->load($customerAddressId);
            $locationc=Mage::getModel('multistockpoint/locationcoverage')->getCollection();
            $code='';
            foreach ($locationc as $loc) {
                if($loc->getPropinsi()==$address->getRegion() && $loc->getKota()==$address->getCity() && $loc->getKecamatan()==$address->getKecamatan() && $loc->getKelurahan()==$address->getKelurahan() ){
                    $code=$loc->getStockpoint_code();
                }
            }
            $location=Mage::getModel('multistockpoint/stockpoint')->getCollection();
            $id=0;
            foreach ($location as $l) {
                if($l->getCode()==$code){
                    $id=$l->getData()['id'];
                }
            }
			$tempPrices = Mage::getSingleton('catalog/product')->load($product->getId())->getPrice_qty();
			$obj=json_decode(str_replace("'", '"', $tempPrices),true);
            if($code!=''){
                $new_price = $obj[$prname][$id];
                if(intval($new_price)>0){
                    return $new_price;
                }
            }else{
                return 12345;
            }
        }else{ // For Not loggedIn user
			$prices=Mage::getModel('multistockpoint/pricetype')->getCollection()->setOrder('minqty', 'DESC');
            foreach ($prices as $pritem) {
                if($qty>=$pritem->getMinqty()){
                    $prname=$pritem->getTypename();
                    break;
                }
            }
            if(!isset($prname)){
              return 12345;
            }
			$tempPrices = Mage::getSingleton('catalog/product')->load($product->getId())->getPrice_qty();
			$obj=json_decode(str_replace("'", '"', $tempPrices),true);
			$new_price = $obj[$prname][1];
            if(intval($new_price)>0){
                    return $new_price;
            }
        }
    }


}
