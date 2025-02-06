# Magento 2 Facebook Pixel Extension by BSS Commerce

[![License: OSI Approved :: Open Software License 3.0 (OSL-3.0)](https://img.shields.io/badge/License-OSL--3.0-blueviolet.svg)](https://opensource.org/licenses/OSL-3.0)
[![Magento 2 Compatible](https://img.shields.io/badge/Magento%202-Compatible-brightgreen.svg)](https://www.magento.com/)

**Boost Your Facebook & Instagram Ad Campaigns and Conversion Tracking with Ease**

Are you looking to **maximize your revenue** from Facebook and Instagram advertising? Struggling to **effectively track campaign performance** and **optimize for the best ROI**?

The **Magento 2 Facebook Pixel Extension by BSS Commerce** is the perfect solution. Seamlessly integrate the Facebook Pixel into your Magento 2 store and unlock the power of this leading tracking and advertising tool.

## Key Features

*   **Easy Installation & Configuration:**  Get up and running quickly without deep technical expertise. Simple setup with comprehensive documentation and dedicated support.
*   **Comprehensive Conversion Tracking:** Go beyond standard events. Track **any customer behavior** on your website to gain deep insights into the customer journey and campaign effectiveness.
*   **Enhanced Audience Targeting:** Leverage Facebook Pixel data to **refine your ad targeting**. Reach high-potential customers, **reduce ad spend**, and **improve conversion rates**.
*   **Smart Remarketing:** Create powerful **remarketing campaigns** to re-engage website visitors who showed interest but didn't convert. Remind and encourage them to complete their purchase and **boost sales**.
*   **Accurate Ad Performance Measurement:**  Track and **measure the effectiveness of your Facebook ad campaigns** with precision. Identify top-performing campaigns and optimize your budget and strategy accordingly.
*   **Seamless Magento 2 Integration:** Developed specifically for Magento 2, ensuring **stability, smooth performance, and no conflicts** with other extensions.

## Feature Highlights in Detail

This extension is packed with features to meet all your tracking and optimization needs:

*   **Standard & Custom Event Tracking:**
    *   **Standard Events:** Automatically track essential events like `ViewContent`, `Search`, `AddToCart`, `AddToWishlist`, `InitiateCheckout`, `AddPaymentInfo`, `AddShippingInfo`, `Purchase`, and more.
    *   **Custom Events:**  Create and track **any custom event** relevant to your unique business and marketing strategy.
*   **Advanced Event Parameters:** Capture rich data for in-depth analysis:
    *   `value`: Track order/product value for precise ROI measurement.
    *   `currency`: Support for multiple currencies for international stores.
    *   `content_ids`: Track product/category IDs to analyze performance by product groups.
    *   `content_type`: Categorize content (e.g., product, category) for detailed insights.
    *   `categories`: Track product categories to evaluate performance by industry.
    *   **(And many more):** Expand tracking and enable advanced data analysis.
*   **Advanced Matching:**  Securely and privately collect and send customer information (name, email, phone number, etc.) to Facebook to **improve match rates** and audience optimization.
*   **Multiple Pixel Support:** Easily manage and utilize **multiple Facebook Pixels** on a single website, ideal for businesses with multiple ad accounts or branches.
*   **Pixel Configuration at Multiple Levels:**
    *   **Global:** Apply Pixel to the entire website.
    *   **Category:** Set up unique Pixels for specific product categories.
    *   **Product:** Configure individual Pixels for particular products.
*   **Page Exclusion:**  Exclude Pixels from specific pages (e.g., privacy policy, order confirmation) to ensure data accuracy.
*   **Pixel Activation by Customer Group:** Activate Pixels based on customer groups (e.g., wholesalers, retailers) for segment-specific behavior analysis.
*   **Import/Export Configuration:**  Easily backup and restore configurations, saving setup time.
*   **Frontend Pixel Check:**  Instantly verify Pixel installation and functionality directly on your website's frontend.

**[Backend Demo](https://facebook-pixel.demom2.bsscommerce.com/admin?auto=1)**
**[Frontend Demo](https://facebook-pixel.demom2.bsscommerce.com/)**

**[Full Feature List](https://bsscommerce.com/magento-2-facebook-pixel-extension.html)**

## Installation

[Provide clear and concise installation instructions here. Consider listing methods like Composer, manual upload, etc.]

Example (replace with actual instructions):

```bash
composer require bss/facebook-pixel
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy -f
php bin/magento cache:clean
php bin/magento cache:flush

