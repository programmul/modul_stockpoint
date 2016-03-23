<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Mamoku
 * @package     Mamoku_PaymentConfirmation
 * @copyright   Copyright (c) 2015 mamoku
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Installer to create table mamoku_payment_confirmation
 *
 * @author      mamoku <info@mamoku.com>
 */

class Mamoku_PaymentConfirmation_Model_Confirmation extends Mage_Core_Model_Abstract
{
    /**
     * Initialize resource model
     *
     */
    public function _construct()
    {
        $this->_init('paymentconfirmation/confirmation');
    }

    public function getStatusLabel($confirmationStatus)
    {
    	switch((int) $confirmationStatus){
    		case 0:
    			$status = Mage::helper('paymentconfirmation')->__('Pending');
    			break;
    		case 1:	
    			$status = Mage::helper('paymentconfirmation')->__('Accepted');
    			break;
    		case 2:
    			$status = Mage::helper('paymentconfirmation')->__('Rejected');
    			break;
    		default:
				$status = '';
    	}
    	return $status;
    }

    protected function _getStatusLabelForFrontend($confirmationStatus)
    {
        if($confirmationStatus == '') return 'Not confirmed yet';
        switch((int) $confirmationStatus){
            case 0:
                $status = Mage::helper('paymentconfirmation')->__('Being verified');
                break;
            case 1: 
                $status = Mage::helper('paymentconfirmation')->__('Accepted');
                break;
            case 2:
                $status = Mage::helper('paymentconfirmation')->__('Rejected');
                break;
            default:
                $status = 'Not confirmed yet';
        }
        return $status;
    }

    public function getStatusLabelForFrontend($orderId){
        $status = $this->getCollection()->loadByOrder($orderId)->getLastItem()->getStatus();
        $statusLabel = $this->_getStatusLabelForFrontend($status);
        return $statusLabel;
    }

    public function isOrderInRejectedStatus($orderId){
        $status = $this->getCollection()->loadByOrder($orderId)->getLastItem()->getStatus();
        return $status == 2 ? true : false;
    }

    public function getActivPaymentMethods($showedPayment = null)
    {
        $middot = '&middot&middot&middot';
        $payments = Mage::getSingleton('payment/config')->getActiveMethods();
        $methods = array(array('value'=>'', 'label'=> $middot.' '.Mage::helper('paymentconfirmation')->__('Please Select').' '.$middot));
    
        if($showedPayment == null){
            foreach ($payments as $paymentCode=>$paymentModel) {
                $paymentTitle = Mage::getStoreConfig('payment/'.$paymentCode.'/title');
                $methods[$paymentCode] = array(
                    'label'   => $paymentTitle,
                    'value' => $paymentCode,
                );
            }
        }
        elseif(is_array($showedPayment)){
            foreach ($showedPayment as $paymentCode) {
                $paymentTitle = Mage::getStoreConfig('payment/'.$paymentCode.'/title');
                $methods[$paymentCode] = array(
                    'label'   => $paymentTitle,
                    'value' => $paymentCode,
                );
            }
        }
        
        return $methods;
    }



}
