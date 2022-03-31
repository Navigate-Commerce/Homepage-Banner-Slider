<?php
namespace Navigate\HomepageBannerSlider\Block\Bannerslider;

use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;
    protected $sliderCollection;
    protected $storeManagerInterface;

    public function __construct(Template\Context $context, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\Collection $sliderCollection, \Magento\Store\Model\StoreManagerInterface $storeManagerInterface, array $data = [])
    {
        $this->scopeConfig = $scopeConfig;
        $this->sliderCollection = $sliderCollection;
        $this->storeManagerInterface = $storeManagerInterface;
        parent::__construct($context, $data);
    }

    public function getSliderCollection()
    {
        return $this->sliderCollection->addFieldToFilter('status', 'Enabled')->setOrder('position', 'asc');
    }

    public function getMediaUrl()
    {
        return $this->storeManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getModuleStatus()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $stausVal = $this->scopeConfig->getValue("bannerslider/general/enable", $storeScope);
        return $stausVal;
    }
}
