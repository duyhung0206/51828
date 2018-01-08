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
 * @package     Magestore_Webposdeca
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Class Magestore_WebposCustomization_Block_WebposCustomization
 */
class Magestore_WebposCustomization_Block_WebposCustomization extends Magestore_Webpos_Block_AbstractBlock
{
    public function getGiftVoucherStatusList(){
        return Magestore_Giftvoucher_Model_Status::getOptions();
    }

    public function getJsData(){
        return array(
            'status_list' => $this->getGiftVoucherStatusList()
        );
    }
}
