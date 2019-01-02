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

class Purchase extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Bss\FacebookPixel\Helper\Data
     */
    public $helper;

    /**
     * @var \Magento\Checkout\Model\SessionFactory
     */
    public $checkoutSession;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Bss\FacebookPixel\Helper\Data $helper
     * @param \Magento\Checkout\Model\SessionFactory $checkoutSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Bss\FacebookPixel\Helper\Data $helper,
        \Magento\Checkout\Model\SessionFactory $checkoutSession,
        array $data = []
    ) {
        $this->helper          = $helper;
        $this->checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }

    /**
     * Returns data needed for purchase tracking.
     *
     * @return array|null
     */
    public function getOrderData()
    {
        $order   = $this->checkoutSession->create()->getLastRealOrder();
        $orderId = $order->getIncrementId();

        if ($orderId) {
            $items = [];

            foreach ($order->getAllVisibleItems() as $item) {
                $items[] = [
                    'name' => $item->getName(), 'sku' => $item->getSku()
                ];
            }

            $data = [];

            if (count($items) === 1) {
                $data['content_name'] = $this->helper
                    ->escapeSingleQuotes($items[0]['name']);
            }

            $ids = '';
            foreach ($items as $i) {
                $ids .= "'" . $this->helper
                        ->escapeSingleQuotes($i['sku']) . "', ";
            }

            $data['content_ids']  = trim($ids, ", ");
            $data['content_type'] = 'product';
            $data['value']        = number_format(
                $order->getGrandTotal(),
                2,
                '.',
                ''
            );
            $data['currency']     = $order->getOrderCurrencyCode();

            return $data;
        } else {
            return null;
        }
    }
}
