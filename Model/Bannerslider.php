<?php
/*
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Model;

class Bannerslider extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Initialize construct Navigate\HomepageBannerSlider\Model\Bannerslider
     */
    public function _construct()
    {
        $this->_init(\Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider::class);
    }
}
