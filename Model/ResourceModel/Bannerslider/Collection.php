<?php
/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Id variable
     *
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize construct
     *
     * Initialize Bannerslider models
     */
    public function _construct()
    {
        $this->_init(
            \Navigate\HomepageBannerSlider\Model\Bannerslider::class,
            \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider::class
        );
    }
}
