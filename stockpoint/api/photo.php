<?php


function get($param){
	$customerObj=Mage::getModel('customer/customer')->load( $param->custid );
	$data=[];
	foreach ($customerObj->getAddresses() as $address) {
		$data[]=$address->getData();
	}
	success('success',$data);
}

function post($param,$post){			
	
	$product= Mage::getModel('catalog/product')->load($param->id);
        try {
         
        $product->setMediaGallery(array('images' => array(), 'values' => array())) //media gallery initialization
            ->addImageToMediaGallery('media/catalog/product/'.$post->image, array('image'), false, false)
            ->addImageToMediaGallery('media/catalog/product/'.$post->small_image, array('small_image'), false, false)
            ->addImageToMediaGallery('media/catalog/product/'.$post->thumbnail, array('thumbnail'), false, false);

    } catch (Exception $exc) {
        
        $product->setMediaGallery(array('images' => array(), 'values' => array())) //media gallery initialization
            ->addImageToMediaGallery('media/catalog/product/'.$post->image, array('image'), false, false)
            ->addImageToMediaGallery('media/catalog/product/'.$post->small_image, array('small_image'), false, false)
            ->addImageToMediaGallery('media/catalog/product/'.$post->thumbnail, array('thumbnail'), false, false);

    }
    try {
        $product->save();
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    success('success',$product);

	

}