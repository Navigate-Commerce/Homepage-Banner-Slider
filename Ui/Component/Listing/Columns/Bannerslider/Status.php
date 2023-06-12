<?php
/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Ui\Component\Listing\Columns\Bannerslider;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * To-option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options   = [];
        $options[] = [
            'label' => 'Enabled',
            'value' => 'Enabled',
        ];
        $options[] = [
            'label' => 'Disabled',
            'value' => 'Disabled',
        ];
        return $options;
    }
}
