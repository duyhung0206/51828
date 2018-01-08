<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Webpos
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

$installer = $this;

$installer->startSetup();

$webposHelper = Mage::helper("webpos");

if (!$webposHelper->columnExist($this->getTable('sales/quote_item'), 'is_custom_gift_voucher')) {
    $installer->run(" ALTER TABLE {$this->getTable('sales/quote_item')} ADD `is_custom_gift_voucher` smallint(1) default 0; ");
}

if (!$webposHelper->columnExist($this->getTable('sales/order_item'), 'is_custom_gift_voucher')) {
    $installer->run(" ALTER TABLE {$this->getTable('sales/order_item')} ADD `is_custom_gift_voucher` smallint(1) default 0; ");
}
$installer->endSetup();