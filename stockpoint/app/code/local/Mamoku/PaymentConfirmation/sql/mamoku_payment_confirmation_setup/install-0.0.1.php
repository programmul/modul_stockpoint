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

$table = $installer->getConnection()
    ->newTable($installer->getTable('paymentconfirmation/confirmation'))
    ->addColumn('confirmation_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Confirmation Id')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50, array(
        'unsigned'  => true,
        ), 'Order Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        ), 'Customer Id')
    ->addColumn('transfer_date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        ), 'Transfer Date')
    ->addColumn('transfer_from', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
        ), 'Transfer to')
    ->addColumn('transfer_to', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
        ), 'Transfer to')
    ->addColumn('transfer_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,0', array(
        ), 'Amount of Transfer')
    ->addColumn('notes', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Notes of Payment Confirmation')
    ->addColumn('confirmation_status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'default'   => '0',
        ), 'Current Status of Confirmation')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created At');
$installer->getConnection()->createTable($table);

$installer->endSetup();