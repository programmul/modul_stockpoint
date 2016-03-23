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
 * @package     Mamoku_BankTransferAccount
 * @copyright   Copyright (c) 2015 Mamoku Services (http://www.mamoku.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Installer to create table ks_bank_transfer_account
 *
 * @author      Team Mamoku <info@mamoku.com>
 */

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('banktransferaccount/bank'))
    ->addColumn('bank_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Bank Id')
    ->addColumn('bank_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
        ), 'Bank Name')
    ->addColumn('account_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
        ), 'Bank Account Name')
    ->addColumn('account_no', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'  => false,
        ), 'Bank Account Number')
    ->addColumn('bank_logo', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        ), 'Logo of Bank')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'default'   => '1',
        ), 'Is Active')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created At');
$installer->getConnection()->createTable($table);

$installer->run("ALTER TABLE {$installer->getTable('sales/quote_payment')} ADD COLUMN bank_transfer_account VARCHAR( 255 ) DEFAULT NULL COMMENT 'Bank Transfer Account Number'");
$installer->run("ALTER TABLE {$installer->getTable('sales/order_payment')} ADD COLUMN bank_transfer_account VARCHAR( 255 ) DEFAULT NULL COMMENT 'Bank Transfer Account Number'");

$installer->endSetup();