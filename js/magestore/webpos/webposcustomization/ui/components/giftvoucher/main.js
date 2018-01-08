/*
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

define(
    [
        'jquery',
        'ko',
        'posComponent',
        'webposcustomization/model/customization',
        'helper/general',
        'lib/bootstrap/bootstrap-switch'
    ],
    function ($, ko, Component, CustomizationModel, Helper) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'webposcustomization/ui/giftvoucher/main'
            },
            code: CustomizationModel.code,
            amount: CustomizationModel.amount,
            shipAble: CustomizationModel.shipAble,
            status: CustomizationModel.status,
            statusList: CustomizationModel.statusList,
            taxClass: CustomizationModel.taxClass,
            taxClasses: CustomizationModel.taxClasses,
            initialize: function(){
                this._super();
            },
            setShipAble: function(data,event){
                var shipAble = (event.target.checked)?true:false;
                CustomizationModel.shipAble(shipAble);
            },
            afterRender: function () {
                if($(".custom-gift-voucher-container .ios-ui-select").length <= 0){
                    $('#custom_gift_voucher_shipable').iosCheckbox();
                }
            },
            addToCart: function(){
                CustomizationModel.addToCart();
            }
        });
    }
);