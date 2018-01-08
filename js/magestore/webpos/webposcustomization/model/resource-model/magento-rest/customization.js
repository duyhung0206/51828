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
 * @package     Magestore_WebposShipping
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

define(
    [
        'model/resource-model/magento-rest/checkout/abstract'
    ],
    function (onlineAbstract) {
        "use strict";

        return onlineAbstract.extend({
            /**
             * Init API routes
             */
            initialize: function () {
                this._super();
                this.apiUrl = "/webpos/customization";
            },
            /**
             * Get API URL
             * @param key
             * @returns {*}
             */
            getApiUrl: function(key){
                switch(key){
                    case "apiUrl":
                        return this.apiUrl;
                }
            },
            /**
             * @param params
             * @param deferred
             */
            send: function(params, deferred){
                var apiUrl = this.getApiUrl("apiUrl");
                this.callApi(apiUrl, params, deferred);
            }
        });
    }
);