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
namespace Bss\FacebookPixel\Block;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;

class Subscribe implements SectionSourceInterface
{

    /**
     * @var \Bss\FacebookPixel\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var \Bss\FacebookPixel\Model\Session
     */
    protected $fbPixelSession;

    /**
     * Atc constructor.
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Bss\FacebookPixel\Helper\Data $helper
     * @param CurrentCustomer $currentCustomer
     * @param \Bss\FacebookPixel\Model\Session $fbPixelSession
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Customer\Model\Session $customerSession,
        \Bss\FacebookPixel\Helper\Data $helper,
        CurrentCustomer $currentCustomer,
        \Bss\FacebookPixel\Model\Session $fbPixelSession
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->customerSession = $customerSession;
        $this->helper = $helper;
        $this->currentCustomer = $currentCustomer;
        $this->fbPixelSession = $fbPixelSession;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getSectionData()
    {
        $data = [
            'events' => []
        ];

        if ($this->fbPixelSession->hasAddSubscribe()) {
            $data['events'][] = [
                'eventName' => 'Subscribe',
                'eventAdditional' => $this->fbPixelSession->getAddSubscribe()
            ];
        }
        return $data;
    }
}