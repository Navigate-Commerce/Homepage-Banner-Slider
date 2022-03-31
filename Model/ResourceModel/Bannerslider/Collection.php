<?php

namespace Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    /**
     * Initialize construct
     * Initialize Bannerslider models
     */
    public function _construct()
    {
        $this->_init(
            'Navigate\HomepageBannerSlider\Model\Bannerslider',
            'Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider'
        );
    }
}
