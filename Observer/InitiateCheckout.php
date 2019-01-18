<?php
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
namespace Bss\FacebookPixel\Observer;

use Magento\Framework\Event\ObserverInterface;

class InitiateCheckout implements ObserverInterface {


    /**
     * @var \Bss\FacebookPixel\Model\Session
     */
    protected $fbPixelSession;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Bss\FacebookPixel\Helper\Data
     */
    protected $fbPixelHelper;

    /**
     * InitiateCheckout constructor.
     * @param \Bss\FacebookPixel\Model\Session $fbPixelSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Bss\FacebookPixel\Helper\Data $helper
     */
    public function __construct(
        \Bss\FacebookPixel\Model\Session $fbPixelSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Bss\FacebookPixel\Helper\Data $helper
    ) {
        $this->fbPixelSession = $fbPixelSession;
        $this->checkoutSession = $checkoutSession;
        $this->fbPixelHelper         = $helper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->fbPixelHelper->getConfig('bss_facebook_pixel/event_tracking/initiate_checkout')) {
            return true;
        }
        if (empty($this->checkoutSession->getQuote()->getAllVisibleItems())) {
            return true;
        }

        $product = [
            'content_ids' => [],
            'contents' => [],
            'value' => "",
            'currency' => ""
        ];
        $items = $this->checkoutSession->getQuote()->getAllItems();
        foreach ($items as $item) {
            $product['contents'][] = [
                'id' => $item->getSku(),
                'name' => $item->getName(),
                'quantity' => $item->getQty(),
                'price' => $item->getPrice()
            ];
            $product['content_ids'][] = $item->getSku();
        }
        $data = [
            'content_ids' => $product['content_ids'],
            'contents' => $product['contents'],
            'content_type' => 'product',
            'value' => $this->checkoutSession->getQuote()->getGrandTotal(),
            'currency' => $this->fbPixelHelper->getCurrencyCode(),
        ];
        $this->fbPixelSession->setInitiateCheckout($data);

        return true;
    }
}