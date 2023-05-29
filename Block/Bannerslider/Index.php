<?php
/*
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Block\Bannerslider;

use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * ScopeConfigInterface
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * \Collection
     *
     * @var \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\Collection
     */
    protected $sliderCollection;

    /**
     * Store Manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManagerInterface;

    /**
     * Construct function
     *
     * @param Template\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\Collection $sliderCollection
     * @param \Magento\Store\Model\StoreManagerInterface $storeManagerInterface
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\Collection $sliderCollection,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        array $data = []
    ) {
        $this->scopeConfig           = $scopeConfig;
        $this->sliderCollection      = $sliderCollection;
        $this->storeManagerInterface = $storeManagerInterface;
        parent::__construct($context, $data);
    }

    /**
     * Retrive slider collection
     *
     * @return $this
     */
    public function getSliderCollection()
    {
        return $this->sliderCollection->addFieldToFilter('status', 'Enabled')->setOrder('position', 'asc');
    }

    /**
     * Retrive media URL
     *
     * @return $this
     */
    public function getMediaUrl()
    {
        return $this->storeManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * Retrive system config
     *
     * @param string $path
     * @return string
     */
    public function getSystemConfig($path)
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $stausVal   = $this->scopeConfig->getValue($path, $storeScope);
        return $stausVal;
    }
}
