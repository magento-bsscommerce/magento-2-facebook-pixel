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
namespace Bss\FacebookPixel\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Tax\Model\Config
     */
    protected $taxConfig;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Tax\Model\Config $taxConfig
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Tax\Model\Config $taxConfig,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder
    ) {
        $this->scopeConfig          = $context->getScopeConfig();
        $this->storeManager = $storeManager;
        $this->taxConfig = $taxConfig;
        $this->jsonEncoder = $jsonEncoder;

        parent::__construct($context);
    }

    /**
     * @param array $data
     * @return false|string
     */
    public function serializes($data)
    {
        $result = $this->jsonEncoder->encode($data);
        if (false === $result) {
            throw new \InvalidArgumentException('Unable to serialize value.');
        }
        return $result;
    }

    /**
     * @return \Magento\Tax\Model\Config
     */
    public function isTaxConfig()
    {
        return $this->taxConfig;
    }

    /**
     * @return array
     */
    public function listPageDisable()
    {
        $list = $this->returnDisablePage();
        if ($list) {
            return explode(',', $list);
        } else {
            return [];
        }
    }

    /**
     * Based on provided configuration path returns configuration value.
     *
     * @param string $configPath
     * @param string|int $scope
     * @return string
     */
    public function getConfig($configPath)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param null $scope
     * @return string
     */
    public function returnPixelId($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/general/pixel_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return mixed
     */
    public function returnDisablePage($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/disable_code',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isProductView($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/product_view',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isCategoryView($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/category_view',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isInitiateCheckout($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/initiate_checkout',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isPurchase($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/purchase',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isAddToWishList($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/add_to_wishlist',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isAddToCart($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/add_to_cart',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isRegistration($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/registration',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isSubscribe($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/subscribe',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return bool
     */
    public function isSearch($scope = null)
    {
        return $this->scopeConfig->getValue(
            'bss_facebook_pixel/event_tracking/search',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * @param null $scope
     * @return mixed
     */
    public function isIncludeTax($scope = null)
    {
        return $this->scopeConfig->getValue(
            'tax/calculation/price_includes_tax',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $scope
        );
    }

    /**
     * Add slashes to string and prepares string for javascript.
     *
     * @param string $str
     * @return string
     */
    public function escapeSingleQuotes($str)
    {
        return str_replace("'", "\'", $str);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrencyCode()
    {
        return $this->storeManager->getStore()->getCurrentCurrency()->getCode();
    }

    /**
     * @param array $data
     * @return string
     */
    public function getPixelHtml($data = false)
    {
        $json = 404;
        if ($data) {
            $json =$this->serializes($data);
        }

        return $json;
    }
}
