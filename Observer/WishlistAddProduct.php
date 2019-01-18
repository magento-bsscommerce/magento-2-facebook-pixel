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

class WishlistAddProduct implements ObserverInterface {

    /**
     * @var \Bss\FacebookPixels\Model\Session
     */
    protected $fbPixelSession;

    /**
     * @var \Bss\FacebookPixels\Helper\Data
     */
    protected $helper;

    /**
     * WishlistAddProduct constructor.
     * @param \Bss\FacebookPixels\Model\Session $fbPixelSession
     * @param \Bss\FacebookPixels\Helper\Data $helper
     */
    public function __construct(
        \Bss\FacebookPixels\Model\Session $fbPixelSession,
        \Bss\FacebookPixels\Helper\Data $helper
    ) {
        $this->fbPixelSession = $fbPixelSession;
        $this->helper        = $helper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute( \Magento\Framework\Event\Observer $observer )
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getProduct();
        if (!$this->helper->getConfig('bss_facebook_pixel/event_tracking/add_to_wishlist') || !$product) {
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