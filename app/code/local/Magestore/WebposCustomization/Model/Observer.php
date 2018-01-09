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
 * @package     Magestore_WebposCustomization
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */


class Magestore_WebposCustomization_Model_Observer extends Magestore_Webpos_Model_Observer_Abstract{

    const IS_CUSTOM_GIFT_VOUCHER = 1;


    /**
     * @var bool|Magestore_WebposCustomization_Model_Service_Customization
     */
    protected $_service = false;

    /**
     * Magestore_WebposCustomization_Model_Observer constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->_service = Mage::getSingleton('webposcustomization/service_customization');
    }

    /**
     * @param $observer
     */
    public function orderPlaceAfter($observer) {
        $order = $observer->getEvent()->getOrder();
        if($order && $this->_service){
            $items = $order->getAllVisibleItems();
            if(!empty($items)){
                foreach ($items as $item){
                    if($item->getIsCustomGiftVoucher() == self::IS_CUSTOM_GIFT_VOUCHER){
                        $this->_service->processCustomGiftVoucherItem($item);
                    }
                }
            }
        }
    }

    /**
     * @param $observer
     */
    public function webposSaveCartAfter($observer) {
        $quote = $observer->getEvent()->getData("quote");
        if($quote && $this->_service){
            $items = $quote->getAllVisibleItems();
            if(!empty($items)){
                foreach ($items as $item){
                    if($item->getIsCustomGiftVoucher() == self::IS_CUSTOM_GIFT_VOUCHER){
                        $isNew = $this->_service->isNewCustomGiftVoucher($item);
                        if($isNew !== true){
                            Mage::throwException(
                                $this->getHelper()->__("The Gift Code \"%s\" has been existed", $isNew)
                            );
                        }
                    }
                }
            }
        }
    }

}
