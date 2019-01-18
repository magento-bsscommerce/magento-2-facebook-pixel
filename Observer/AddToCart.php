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
 * @package   Bss_FacebookPixels
 * @author    Extension Team
 * @copyright Copyright (c) 2018-2019 BSS Commerce Co. ( http://bsscommerce.com )
 * @license   http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Bss\FacebookPixels\Observer;

use Magento\Framework\Event\ObserverInterface;

class AddToCart implements ObserverInterface {

    /**
     * @var \Bss\FacebookPixels\Model\Session
     */
    protected $fbPixelSession;
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;
    /**
     * @var \Bss\FacebookPixels\Helper\Data
     */
    protected $helper;

    /**
     * AddToCart constructor.
     * @param \Bss\FacebookPixels\Model\Session $fbPixelSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Bss\FacebookPixels\Helper\Data $helper
     */
    public function __construct(
        \Bss\FacebookPixels\Model\Session $fbPixelSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Bss\FacebookPixels\Helper\Data $helper
    ) {
        $this->fbPixelSession = $fbPixelSession;
        $this->checkoutSession = $checkoutSession;
        $this->helper        = $helper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->helper->getConfig('bss_facebook_pixel/event_tracking/add_to_cart')) {
            return true;
        }
        $items = $observer->getItems();
        $product = [
            'content_ids' => [],
            'value' => 0.00,
            'currency' => ""
        ];

        /** @var \Magento\Sales\Model\Order\Item $item */
        foreach ($items as $item) {
            if (!$item->getParentItem()) {
                $product['value'] += $item->getProduct()->getFinalPrice() * $item->getQtyToAdd();
            }
            $product['contents'][] = [
                'id' => $item->getSku(),
                'name' => $item->getName(),
                'quantity' => $item->getQtyToAdd(),
                'price' => $item->getProduct()->getFinalPrice()
            ];
            $product['content_ids'][] = $item->getSku();
        }

        $data = [
            'content_type' => 'product',
            'content_ids' => $product['content_ids'],
            'contents' => $product['contents'],
            'value' => $product['value'],
            'currency' => $this->helper->getCurrencyCode(),
        ];

        $this->fbPixelSession->setAddToCart($data);

        return true;
    }
}