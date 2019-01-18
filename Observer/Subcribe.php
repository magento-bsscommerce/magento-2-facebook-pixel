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

class Subcribe implements ObserverInterface {

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
     * Subcribe constructor.
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
     *
     * @return boolean
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $email = $observer->getEvent()->getSubscriber()->getSubscriberEmail();
        $subscribeId =$observer->getEvent()->getSubscriber()->getSubscriberId();
        if (!$this->helper->getConfig('bss_facebook_pixel/event_tracking/subscribe') || !$email) {
            return true;
        }

        $data = [
            'id' => [$subscribeId],
        ];

        $this->fbPixelSession->setAddSubscribe($data);

        return true;
    }
}