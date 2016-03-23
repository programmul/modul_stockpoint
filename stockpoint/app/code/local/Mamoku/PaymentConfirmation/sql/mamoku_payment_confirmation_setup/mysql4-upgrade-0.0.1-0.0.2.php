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

$installer = $this;
$installer->startSetup();

/* ADD NEW Fields for regular payment confirmation */
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'customer_name', 'VARCHAR(150) DEFAULT NULL COMMENT "Customer Name"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'customer_email', 'VARCHAR(100) DEFAULT NULL COMMENT "Customer Email"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'bank_account_name', 'VARCHAR(150) DEFAULT NULL COMMENT "Bank Account Name"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'transfer_method', 'VARCHAR(100) DEFAULT NULL COMMENT "Transfer Method"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'confirmation_type', 'SMALLINT(5) DEFAULT 0 COMMENT "Confirmation Type"');
/* ADD NEW Fields for CSO payment confirmation */
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'shop_code', 'VARCHAR(50) DEFAULT NULL COMMENT "Shop Code"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'receipt_no', 'VARCHAR(100) DEFAULT NULL COMMENT "Receipt Number"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'cashier_name', 'VARCHAR(100) DEFAULT NULL COMMENT "Cashier Name"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'buyer_name', 'VARCHAR(100) DEFAULT NULL COMMENT "Buyer Name"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'buyer_email', 'VARCHAR(100) DEFAULT NULL COMMENT "Buyer Name"');
$installer->getConnection()->addColumn($installer->getTable('paymentconfirmation/confirmation'), 'buyer_phone', 'VARCHAR(50) DEFAULT NULL COMMENT "Buyer Name"');

$installer->endSetup();