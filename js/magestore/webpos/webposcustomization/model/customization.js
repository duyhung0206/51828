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
        'helper/general',
        'webposcustomization/model/resource-model/magento-rest/customization',
        'model/checkout/cart/customsale',
        'model/checkout/cart',
        'helper/price',
        'model/container'
    ],
    function ($, ko, Helper, CustomizationResource, CustomSale, CartModel, PriceHelper, Container) {
        "use strict";

        var CustomizationModel = {
            code: ko.observable(),
            amount: ko.observable(0),
            shipAble: ko.observable(false),
            status: ko.observable(2),
            statusList: ko.observableArray(),
            taxClass: ko.observable(2),
            taxClasses: CustomSale.taxClasses,
            initialize: function(){
                var self = this;
                self.initEvents();
                return self;
            },
            initEvents: function(){
                var self = this;
                Helper.observerEvent('webpos_cart_item_init_data_after', function(event, eventData){
                    if(eventData){
                        var data = eventData.data;
                        var item = eventData.item;
                        item.is_custom_gift_voucher = ko.observable((data.is_custom_gift_voucher == true)?true:false);
                        item.custom_gift_voucher_status = ko.observable((data.custom_gift_voucher_status)?data.custom_gift_voucher_status:2);
                        item.custom_gift_voucher_code = ko.observable((data.custom_gift_voucher_code)?data.custom_gift_voucher_code:"");
                        item.custom_gift_voucher_amount = ko.observable((data.custom_gift_voucher_amount)?data.custom_gift_voucher_amount:0);
                    }
                });
                Helper.observerEvent('webpos_cart_item_prepare_info_buy_request_after', function(event, eventData){
                    if(eventData){
                        var buy_request = eventData.buy_request;
                        var item = eventData.item;
                        if((buy_request.is_custom_sale == true) && (item.is_custom_gift_voucher() == true)) {
                            buy_request.quote_item_data.push({
                                key: "is_custom_gift_voucher",
                                value: 1
                            });
                            buy_request.custom_gift_voucher_status = item.custom_gift_voucher_status();
                            buy_request.custom_gift_voucher_code = item.custom_gift_voucher_code();
                            buy_request.custom_gift_voucher_amount = item.custom_gift_voucher_amount();
                            buy_request.is_custom_gift_voucher = true;
                        }
                    }
                });
                return self;
            },
            resetData: function(){
                this.code("");
                this.amount(0);
                this.status(2);
                this.shipAble(false);
                this.taxClass(2);
            },
            addToCart: function(){
                var self = this;
                var amount = PriceHelper.toNumber(self.amount());
                var price = self.calculatePrice(amount);
                var data = {
                    product_id:"customsale",
                    sku:(self.taxClass())?"webpos-customsale-"+self.taxClass():'webpos-customsale',
                    qty: 1,
                    product_name:self.code(),
                    unit_price:PriceHelper.toBasePrice(price),
                    tax_class_id:self.taxClass(),
                    is_virtual:self.shipAble()?false:true,
                    is_custom_gift_voucher: true,
                    custom_gift_voucher_status: self.status(),
                    custom_gift_voucher_code: self.code(),
                    custom_gift_voucher_amount: amount
                };
                CartModel.addProduct(data);
                self.resetData();
                Container.toggleArea("customization");
            },
            calculatePrice: function(price){
                if(!Helper.isProductPriceIncludesTax()){

                }
                return price;
            },
            initData: function(data){
                if(data){
                    var self = this;
                    if(data.status_list){
                        self.statusList(data.status_list);
                    }
                }
            }
        };
        return CustomizationModel.initialize();
    }
);