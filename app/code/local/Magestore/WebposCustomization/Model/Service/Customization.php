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
 * @package     WebposCustomization
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

class Magestore_WebposCustomization_Model_Service_Customization extends Magestore_Webpos_Service_Checkout_Checkout
{

    /**
     * @param $item
     */
    public function processCustomGiftVoucherItem($item){
        $order = $item->getOrder();
        $buyRequest = $item->getBuyRequest();
        if($buyRequest){
            $buyRequestData = $buyRequest->getData();
            if (
                isset($buyRequestData['custom_gift_voucher_status']) &&
                isset($buyRequestData['custom_gift_voucher_code']) &&
                isset($buyRequestData['custom_gift_voucher_amount'])
            ) {
                $code = $buyRequestData['custom_gift_voucher_code'];
                $amount = $buyRequestData['custom_gift_voucher_amount'];
                $status = $buyRequestData['custom_gift_voucher_status'];
                $currencyCode = $order->getOrderCurrencyCode();

                $giftVoucher = Mage::getModel('giftvoucher/giftvoucher')->loadByCode($code);
                if($giftVoucher->getId()){
                    return false;
                }

                $giftVoucher = Mage::getModel('giftvoucher/giftvoucher');
                $giftVoucher->setGiftCode($code);
                $giftVoucher->setBalance($amount)->setAmount($amount);
                $giftVoucher->setOrderAmount($item->getBasePrice());
                $giftVoucher->setCurrency($currencyCode);
                $giftVoucher->setStatus($status);
                $giftVoucher->setGiftcardTemplateId(1);

                $giftVoucher->setAction(Magestore_Giftvoucher_Model_Actions::ACTIONS_CREATE)
                    ->setComments(Mage::helper('giftvoucher')->__('Created for order %s', $order->getIncrementId()))
                    ->setOrderIncrementId($order->getIncrementId())
                    ->setOrderItemId($item->getId())
                    ->setExtraContent(Mage::helper('giftvoucher')->__('Created from POS'))
                    ->setIncludeHistory(true);

                $giftVoucher->save();
            }
        }
    }

    /**
     * @param $item
     * @return bool
     */
    public function isNewCustomGiftVoucher($item){
        $buyRequest = $item->getBuyRequest();
        if($buyRequest){
            $buyRequestData = $buyRequest->getData();
            if (isset($buyRequestData['custom_gift_voucher_code'])) {
                $code = $buyRequestData['custom_gift_voucher_code'];
                $giftVoucher = Mage::getModel('giftvoucher/giftvoucher')->loadByCode($code);
                if($giftVoucher->getId()){
                    return $code;
                }
            }
        }
        return true;
    }
}