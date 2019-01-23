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
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * InitiateCheckout constructor.
     * @param \Bss\FacebookPixel\Model\Session $fbPixelSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Bss\FacebookPixel\Helper\Data $helper
     */
    public function __construct(
        \Bss\FacebookPixel\Model\Session $fbPixelSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Bss\FacebookPixel\Helper\Data $helper,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->fbPixelSession = $fbPixelSession;
        $this->checkoutSession = $checkoutSession;
        $this->fbPixelHelper         = $helper;
        $this->request = $request;
        $this->storeManager = $storeManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $listDisable = $this->fbPixelHelper->listPageDisable();
        $arrCheckout = [
            'checkout_index_index',
            'onepagecheckout_index_index',
            'onestepcheckout_index_index',
            'opc_index_index'
        ];
        $actionName  = $this->request->getFullActionName();
        if (in_array($actionName, $arrCheckout) && in_array('checkout_page', $listDisable)) {
            return true;
        }
        if ($this->fbPixelSession->getActionPage()) {
            return true;
        }
        if (!$this->fbPixelHelper->getConfig('bss_facebook_pixel/event_tracking/initiate_checkout',
            $this->storeManager->getStore()->getId())) {
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
                'item_price' => $item->getPrice()
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