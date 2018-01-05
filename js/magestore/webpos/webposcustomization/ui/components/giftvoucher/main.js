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
        'helper/general'
    ],
    function ($, ko, Component, CustomizationModel, Helper) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'webposcustomization/ui/giftvoucher/main'
            },
            initialize: function(){
                this._super();
            }
        });
    }
);