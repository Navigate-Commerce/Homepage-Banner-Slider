<?php

namespace Navigate\HomepageBannerSlider\Model\ResourceModel;

class Bannerslider extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'id';
    /**
     * Initialize construct Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider
     */
    public function _construct()
    {
        $this->_init("bannerslider", "id");
    }
}
