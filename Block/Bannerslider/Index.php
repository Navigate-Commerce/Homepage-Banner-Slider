<?php

namespace Navigate\HomepageBannerSlider\Block\Bannerslider;

use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{

    protected $scopeConfig;

    protected $sliderCollection;

    protected $storeManagerInterface;


    public function __construct(Template\Context $context, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\Collection $sliderCollection, \Magento\Store\Model\StoreManagerInterface $storeManagerInterface, array $data=[])
    {
        $this->scopeConfig           = $scopeConfig;
        $this->sliderCollection      = $sliderCollection;
        $this->storeManagerInterface = $storeManagerInterface;
        parent::__construct($context, $data);

    }//end __construct()


    public function getSliderCollection()
    {
        return $this->sliderCollection->addFieldToFilter('status', 'Enabled')->setOrder('position', 'asc');

    }//end getSliderCollection()


    public function getMediaUrl()
    {
        return $this->storeManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

    }//end getMediaUrl()


    public function getModuleStatus()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $stausVal   = $this->scopeConfig->getValue('bannerslider/general/enable', $storeScope);
        return $stausVal;

    }//end getModuleStatus()


}//end class
