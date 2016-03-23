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
class Mamoku_PaymentConfirmation_Helper_Data extends Mage_Core_Helper_Abstract
{
	const PAYMENT_CONFIRMATION_CSO_ENABLE = 'payment_confirmation/csogroup/enable_feature';
	const PAYMENT_CONFIRMATION_CSO_GROUP_ID = 'payment_confirmation/csogroup/groupid';
	const PAYMENT_CONFIRMATION_CSO_TITLE = 'payment_confirmation/csogroup/title';
	const PAYMENT_CONFIRMATION_CSO_RECONFIRM_TITLE = 'payment_confirmation/csogroup/reconfirmtitle';
	const PAYMENT_CONFIRMATION_CSO_STATUS_TITLE = 'payment_confirmation/csogroup/statustitle';
	const PAYMENT_CONFIRMATION_OTHER_ENABLE = 'payment_confirmation/othergroup/enable_feature';
	const PAYMENT_CONFIRMATION_OTHER_TITLE = 'payment_confirmation/othergroup/title';
	const PAYMENT_CONFIRMATION_OTHER_RECONFIRM_TITLE = 'payment_confirmation/othergroup/reconfirmtitle';
	const PAYMENT_CONFIRMATION_OTHER_STATUS_TITLE = 'payment_confirmation/othergroup/statustitle';

	public function isPaymentConfirmationCSOEnable(){
		return Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_CSO_ENABLE);
	}

	public function getCSOGroupID(){
		return trim(Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_CSO_GROUP_ID));
	}

	public function getCSOTitle(){
		return trim(Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_CSO_TITLE));
	}

	public function getCSOReconfirmTitle(){
		return trim(Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_CSO_RECONFIRM_TITLE));
	}

	public function getCSOStatusTitle(){
		return trim(Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_CSO_STATUS_TITLE));
	}

	public function isPaymentConfirmationOtherEnable(){
		return Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_OTHER_ENABLE);
	}

	public function getOtherTitle(){
		return trim(Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_OTHER_TITLE));
	}

	public function getOtherReconfirmTitle(){
		return trim(Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_OTHER_RECONFIRM_TITLE));
	}

	public function getOtherStatusTitle(){
		return trim(Mage::getStoreConfig(self::PAYMENT_CONFIRMATION_OTHER_STATUS_TITLE));
	}

	public function isShowPrefix()
	{
		// Get Block Mage_Customer_Block_Widget_Name
		$prefixBlock = Mage::app()->getLayout()->createBlock('customer/widget_name');
		return $prefixBlock->showPrefix();
	}


}