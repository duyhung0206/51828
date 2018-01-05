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


class Magestore_WebposCustomization_Model_Api2_Shipping_Rest_Admin_V1 extends Magestore_Webpos_Model_Api2_Checkout_Abstract
{

    /**
     * Magestore_Webpos_Model_Api2_Checkout_Abstract constructor.
     */
    public function __construct() {
        $this->_service = Mage::getSingleton('webposcustomization/service_customization');
        $this->_helper = Mage::helper('webposcustomization');
    }

    /**
     * Dispatch actions
     */
    public function dispatch()
    {
        $this->_initStore();

        switch ($this->getActionType()) {
            default:
                $result = array();
                $this->_render($result);
                $this->getResponse()->setHttpResponseCode(Mage_Api2_Model_Server::HTTP_OK);
                break;
        }
    }
}
