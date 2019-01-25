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

class Atc implements SectionSourceInterface
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
     * @var \Bss\FacebookPixel\Model\SessionFactory
     */
    protected $fbPixelSession;

    /**
     * Atc constructor.
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Bss\FacebookPixel\Helper\Data $helper
     * @param CurrentCustomer $currentCustomer
     * @param \Bss\FacebookPixel\Model\SessionFactory $fbPixelSession
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Customer\Model\Session $customerSession,
        \Bss\FacebookPixel\Helper\Data $helper,
        CurrentCustomer $currentCustomer,
        \Bss\FacebookPixel\Model\SessionFactory $fbPixelSession
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
        $session = $this->fbPixelSession->create();
        $data = [
            'events' => []
        ];

        if ($session->hasAddToCart()) {
            // Get the add-to-cart information since it's unique to the user
            // but might be displayed on a cached page
            $data['events'][] = [
                'eventName' => 'AddToCart',
                'eventAdditional' => $session->getAddToCart()
            ];
        }
        return $data;
    }
}