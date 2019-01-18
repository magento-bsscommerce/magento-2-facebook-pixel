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
namespace Bss\FacebookPixels\Block;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;

class Atc implements SectionSourceInterface
{

    /**
     * @var \Bss\FacebookPixels\Helper\Data
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
     * Atc constructor.
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Bss\FacebookPixels\Helper\Data $helper
     * @param CurrentCustomer $currentCustomer
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Customer\Model\Session $customerSession,
        \Bss\FacebookPixels\Helper\Data $helper,
        CurrentCustomer $currentCustomer
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->customerSession = $customerSession;
        $this->helper = $helper;
        $this->currentCustomer = $currentCustomer;
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

        if ($this->helper->getSession()->hasAddToCart()) {
            // Get the add-to-cart information since it's unique to the user
            // but might be displayed on a cached page
            $data['events'][] = [
                'eventName' => 'AddToCart',
                'eventAdditional' => $this->helper->getSession()->getAddToCart()
            ];
        }

        return $data;
    }
}