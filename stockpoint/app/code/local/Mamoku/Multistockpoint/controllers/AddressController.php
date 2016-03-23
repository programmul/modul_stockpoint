<?php
require_once(Mage::getModuleDir('controllers','Mage_Customer').DS.'AddressController.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerAddress
 *
 * @author IAMFLOOPEL
 */
class Mamoku_Multistockpoint_AddressController extends Mage_Customer_AddressController {

    //put your code here
 protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }
    
    public function formPostAction() {
        if (!$this->_validateFormKey()) {
            return $this->_redirect('*/*/');
        }
        // Save data
        if ($this->getRequest()->isPost()) {
            $customer = $this->_getSession()->getCustomer();
            /* @var $address Mage_Customer_Model_Address */
            $address = Mage::getModel('customer/address');
            $addressId = $this->getRequest()->getParam('id');
            if ($addressId) {
                $existsAddress = $customer->getAddressById($addressId);
                if ($existsAddress->getId() && $existsAddress->getCustomerId() == $customer->getId()) {
                    $address->setId($existsAddress->getId());
                }
            }

            $errors = array();

            /* @var $addressForm Mage_Customer_Model_Form */
            $addressForm = Mage::getModel('customer/form');
            $addressForm->setFormCode('customer_address_edit')
                    ->setEntity($address);
            $addressData = $addressForm->extractData($this->getRequest());
            $addressErrors = $addressForm->validateData($addressData);
            if ($addressErrors !== true) {
                $errors = $addressErrors;
            }

            try {

                $addressForm->compactData($addressData);
                $address->setCustomerId($customer->getId())
                        ->setIsDefaultBilling($this->getRequest()->getParam('default_billing', false))
                        ->setIsDefaultShipping($this->getRequest()->getParam('default_shipping', false));

                $addressErrors = $address->validate();
                if ($addressErrors !== true) {
                    $errors = array_merge($errors, $addressErrors);
                }

                if (count($errors) === 0) {
                    

                    $this->_redirectSuccess(Mage::getUrl('*/*/index', array('_secure' => true)));
                    $locationc = Mage::getModel('multistockpoint/locationcoverage')->getCollection();

                    foreach ($locationc as $loc) {
                        # code...
                        if ($loc->getPropinsi() == $addressData['region'] && $loc->getKota() == $addressData['city'] && $loc->getKecamatan() == $addressData['kecamatan'] && $loc->getKelurahan() == $addressData['kelurahan']) {
                            $code = $loc->getStockpoint_code();
                        }
                    }
                    
                     $address->setStockpointcode($code); /*insert attribut stockpoint code dari el*/
                   
                    $address->save();
                    $this->_getSession()->addSuccess($this->__('The address has been saved.' . $code));




                    return;
                } else {
                    $this->_getSession()->setAddressFormData($this->getRequest()->getPost());
                    foreach ($errors as $errorMessage) {
                        $this->_getSession()->addError($errorMessage);
                    }
                }
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->setAddressFormData($this->getRequest()->getPost())
                        ->addException($e, $e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->setAddressFormData($this->getRequest()->getPost())
                        ->addException($e, $this->__('Cannot save address.'));
            }
        }

        return $this->_redirectError(Mage::getUrl('*/*/edit', array('id' => $address->getId())));
    }

}
