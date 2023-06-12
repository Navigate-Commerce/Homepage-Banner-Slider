<?php
/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Block\Bannerslider;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\Collection;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class Index extends Template
{
    public const SLIDER_LOOP     = 'bannerslider/slider/infinite';
    public const SLIDER_DOTS     = 'bannerslider/slider/show_dots';
    public const SLIDER_AUTOPLAY = 'bannerslider/slider/autoplay';
    public const SLIDER_ARROW    = 'bannerslider/slider/show_arrow';
    public const SLIDER_ITEM_DESKTOP    = 'bannerslider/slider/item_desktop';
    public const SLIDER_ITEM_MOBILE     = 'bannerslider/slider/item_mobile';
    public const SLIDER_AUTOPLAY_TIMING = 'bannerslider/slider/autoplay_timing';

    /**
     * ScopeConfigInterface
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Bannerslider Collection
     *
     * @var Collection
     */
    protected $sliderCollection;

    /**
     * Store Manager
     *
     * @var StoreManagerInterface
     */
    protected $storeManagerInterface;

    /**
     * Construct function
     *
     * @param Template\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Collection $sliderCollection
     * @param StoreManagerInterface $storeManagerInterface
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        Collection $sliderCollection,
        StoreManagerInterface $storeManagerInterface,
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
        $collection = $this->sliderCollection->addFieldToFilter('status', 'Enabled');
        $collection->addFieldToFilter('store_id', [[['like' => '%'.$this->getStoreId().'%']], [['like' => '%0%']]]);
        $collection->setOrder('position', 'asc');
        return $collection;
    }

    /**
     * Retrive media URL
     *
     * @return $this
     */
    public function getMediaUrl()
    {
        return $this->storeManagerInterface->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * Retrive system config
     *
     * @param string $path
     * @return string
     */
    public function getSystemConfig($path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORES);
    }

    /**
     * Get store id
     *
     * @return $this
     */
    public function getStoreId()
    {
        return $this->storeManagerInterface->getStore()->getId();
    }

    /**
     * Return Slider Loop is infinite or not.
     */
    public function getSliderLoop()
    {
        return $this->getSystemConfig(self::SLIDER_LOOP) ? true : false;
    }

    /**
     * Return Slider Dots Enable or not.
     */
    public function getSliderDots()
    {
        return $this->getSystemConfig(self::SLIDER_DOTS) ? true : false;
    }

    /**
     * Return Slider Arrow is visible or not.
     */
    public function getSliderArrow()
    {
        return $this->getSystemConfig(self::SLIDER_ARROW) ? true : false;
    }

    /**
     * Return Slider Autoplay Value.
     */
    public function getSliderAutoplay()
    {
        return $this->getSystemConfig(self::SLIDER_AUTOPLAY) ? true : false;
    }

    /**
     * Return Slider Autoplay Timing Value.
     */
    public function getSliderAutoplayTiming()
    {
        $autoPlayspeed = 5000;
        if (strlen($this->getSystemConfig(self::SLIDER_AUTOPLAY_TIMING)) > 0) {
            $autoPlayspeed = $this->getSystemConfig(self::SLIDER_AUTOPLAY_TIMING);
        }
        return $autoPlayspeed;
    }

    /**
     * Return Slider Desktop Item Counter.
     */
    public function getDesktopItemCount()
    {
        return (int) $this->getSystemConfig(self::SLIDER_ITEM_DESKTOP);
    }

    /**
     * Return Slider Mobile Item Counter.
     */
    public function getMobileItemCount()
    {
        return (int) $this->getSystemConfig(self::SLIDER_ITEM_MOBILE);
    }
}
