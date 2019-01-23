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

class WishlistAddProduct implements ObserverInterface {

    /**
     * @var \Bss\FacebookPixel\Model\Session
     */
    protected $fbPixelSession;

    /**
     * @var \Bss\FacebookPixel\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * WishlistAddProduct constructor.
     * @param \Bss\FacebookPixel\Model\Session $fbPixelSession
     * @param \Bss\FacebookPixel\Helper\Data $helper
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Bss\FacebookPixel\Model\Session $fbPixelSession,
        \Bss\FacebookPixel\Helper\Data $helper,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->fbPixelSession = $fbPixelSession;
        $this->helper        = $helper;
        $this->storeManager = $storeManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute( \Magento\Framework\Event\Observer $observer )
    {
        if ($this->fbPixelSession->getActionPage()) {
            return true;
        }
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getProduct();
        if (!$this->helper->getConfig('bss_facebook_pixel/event_tracking/add_to_wishlist',
                $this->storeManager->getStore()->getId()) || !$product) {
            return true;
        }
        
        $data = [
            'content_type' => 'product',
            'content_ids' => [$product->getSku()],
            'value' => $product->getFinalPrice(),
            'currency' => $this->helper->getCurrencyCode()
        ];
        
        $this->fbPixelSession->setAddToWishlist($data);
        
        return true;
	}
}