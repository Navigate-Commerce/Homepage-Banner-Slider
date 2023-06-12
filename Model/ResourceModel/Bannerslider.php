<?php
/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Model\ResourceModel;

class Bannerslider extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Id variable
     *
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize construct Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider
     */
    public function _construct()
    {
        $this->_init('bannerslider', 'id');
    }
}
