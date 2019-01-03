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
        var productName = config.productName;
        var productSku = config.productSku;
        var productPrice = config.productPrice;
        var productCurrency = config.productCurrency;
        var checkProductData = config.checkProductData;
        var categoryName = config.categoryName;
        var categoryId = config.categoryId;
        var categoryCurrency = config.categoryCurrency;
        var checkCategoryData = config.checkCategoryData;
        var catalogSearch = config.catalogSearch;
        var catalogSearchAdvan = config.catalogSearchAdvan;
        var customerAccountCreate = config.customerAccountCreate;
        var checkout = config.checkout;
        var checkoutSuccess = config.checkoutSuccess;
        var customerAccount = config.customerAccount;
        var cmsPage = config.cmsPage;
        var checkOrderData = config.checkOrderData;
        var orderName = config.orderName;
        var orderId = config.orderId;
        var orderValue = config.orderValue;
        var orderCurrency = config.orderCurrency;
        var checkArrayKey = config.checkArrayKey;


    !function (f, b, e, v, n, t, s) {if (f.fbq)return;n=f.fbq=function () {n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];
            t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', id);

        if (action === 'catalog_product_view') {
            fbq('track', 'PageView');

            if (checkProductData === 1) {
                fbq('track', 'ViewContent', {
                    content_name: productName,
                    content_ids: [productSku],
                    content_type: 'product',
                    value: productPrice,
                    currency: productCurrency
                });
            //Add Pixel Events to the button's click handler
                if (typeof jQuery != 'undefined') {
                    jQuery('#product-addtocart-button').click(function () {
                        fbq('track', 'AddToCart', {
                            content_name: productName,
                            content_ids: [productSku],
                            content_type: 'product',
                            value: productPrice,
                            currency: productCurrency});
                    });
                }
            }
        }

        if (action === 'catalogsearch_result_index' && catalogSearch === 1) {
            fbq('track', 'PageView');
            fbq('track', 'Search');
        }

        if (action === 'catalogsearch_advanced_result' && catalogSearchAdvan === 1) {
            fbq('track', 'PageView');
            fbq('track', 'Search');
        }
        if (action === 'customer_account_create' && customerAccountCreate === 1) {
            fbq('track', 'PageView');
            fbq('track', 'CompleteRegistration');
        }

        if ((action === 'checkout_index_index'
            || action === 'onepagecheckout_index_index'
            || action === 'onestepcheckout_index_index'
            || action === 'opc_index_index') && checkout === 1) {
            fbq('track', 'PageView');
            fbq('track', 'InitiateCheckout');
        }

        if ((action === 'checkout_onepage_success'
            || action === 'onepagecheckout_index_success') && checkoutSuccess === 1) {
            fbq('track', 'PageView');
            if (checkOrderData === 1) {
                if (checkArrayKey === 1) {
                    fbq('track', 'Purchase', {
                        content_name: orderName,
                        content_ids: [orderId],
                        content_type: 'product',
                        value: orderValue,
                        currency: orderCurrency
                    });
                } else {
                    fbq('track', 'Purchase', {
                        content_ids: [orderId],
                        content_type: 'product',
                        value: orderValue,
                        currency: orderCurrency
                    });
                }
            }
        }

        if (action === 'wishlist_index_index') {
            fbq('track', 'PageView');
            fbq('track', 'AddToWishlist');
        }

        if (action === 'catalog_category_view') {
            fbq('track', 'PageView');
        }

        if (checkCategoryData !== null) {
               fbq('track', 'ViewContent', {
                    content_name: categoryName,
                    content_ids: [categoryId],
                    content_type: 'category',
                    currency: categoryCurrency
                });
        }

        if (action === 'customer_account_index' && customerAccount === 1) {
            fbq('track', 'PageView');
        }

        if (cmsPage === 1) {
                fbq('track', 'PageView');
        }

    }
});

