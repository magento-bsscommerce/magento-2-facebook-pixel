/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category  BSS
 * @package   Bss_FacebookPixel
 * @author    Extension Team
 * @copyright Copyright (c) 2018-2019 BSS Commerce Co. ( http://bsscommerce.com )
 * @license   http://bsscommerce.com/Bss-Commerce-License.txt
 */
define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'Bss_FacebookPixel/js/code'
], function (jQuery, ko, Component, customerData, code) {
    'use strict';
    return Component.extend({
        initialize: function () {
            var self = this;
            self._super();
            customerData.get('bss-fbpixel-subscribe').subscribe(function (loadedData) {
                if (loadedData && "undefined" !== typeof loadedData.events) {
                    for (var eventCounter = 0; eventCounter < loadedData.events.length; eventCounter++) {
                        var eventData = loadedData.events[eventCounter];
                        if ("undefined" !== typeof eventData.eventAdditional && eventData.eventAdditional) {
                            jQuery('.bss-subscribe-email').text(eventData.eventAdditional.email);
                            jQuery('.bss-subscribe-id').text(eventData.eventAdditional.id);
                            customerData.set('bss-fbpixel-subscribe', {});
                            return window.fb();
                        }
                    }
                }
            });
        }
    });
});
