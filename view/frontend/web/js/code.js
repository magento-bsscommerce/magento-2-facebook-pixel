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
    'jquery'
], function ($) {
    "use strict";
    return function (config, element) {
        var id = config.id;
        var action = config.action;
        var productData = config.productData;
        var categoryData = config.categoryData;
        var registration = config.registration;
        var addToWishList = config.addToWishList;
        var addToCart = config.addToCart;
        var subscribe = config.subscribe;
        var initiateCheckout = config.initiateCheckout;
        var search = config.search;
        var orderData = config.orderData;

        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];
            t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', id);
        fbq('track', 'PageView');

        if (action == 'catalog_product_view' && productData != 404) {
            fbq('track', 'ViewContent', {
                content_name: productData.content_name ,
                content_ids: productData.content_ids,
                content_type: 'product',
                value: productData.value,
                currency: productData.currency
            });
        }
        if (action == 'catalog_category_view' && categoryData != 404) {
            fbq('trackCustom', 'ViewCategory', {
                content_name: categoryData.content_name,
                content_ids: categoryData.content_ids,
                content_type: 'product_group',
                currency: categoryData.currency
            });
        }

        if (addToWishList != 404) {
            fbq('track', 'AddToWishlist', {
                content_type : 'product',
                content_ids : addToWishList.content_ids,
                value : addToWishList.value,
                currency : addToWishList.currency
            });
        }

        if (search != 404) {
            fbq('track', 'Search', {
                search_string : search.search_string
            });
        }

        if (subscribe != 404) {
            fbq('track', 'Subscribe', {
                id : subscribe.id
            });
        }

        if (addToCart != 404) {
            fbq('track', 'AddToCart', {
                content_ids: addToCart.content_ids,
                content_type: 'product',
                value: addToCart.value,
                currency: addToCart.currency
            });
        }

        if (initiateCheckout != 404) {
            fbq('track', 'InitiateCheckout', {
                content_ids: initiateCheckout.content_ids,
                content_type: 'product',
                contents: initiateCheckout.contents,
                value: initiateCheckout.value,
                currency: initiateCheckout.currency
            });
        }

        if (orderData != 404) {
            fbq('track', 'Purchase', {
                content_ids: orderData.content_ids,
                content_type: 'product',
                contents: orderData.contents,
                value: orderData.value,
                currency: orderData.currency
            });
        }

        if (registration != 404) {
            fbq('track', 'CompleteRegistration', {
                customer_id: registration.customer_id
            });
        }
    }
});
