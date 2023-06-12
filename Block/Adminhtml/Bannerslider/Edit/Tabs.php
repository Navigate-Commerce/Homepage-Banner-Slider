<?php
/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Block\Adminhtml\Bannerslider\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{

    /**
     * Intialize construct
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bannerslider_create_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Banner Information'));
    }

    /**
     * General Tab
     *
     * @return WidgetTabs
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'bannerslider_create_tabs',
            [
                'label'   => __('General'),
                'title'   => __('General'),
                'content' => $this->getLayout()->createBlock(\Navigate\HomepageBannerSlider\Block\Adminhtml\Bannerslider\Edit\Tab\Info::class)->toHtml(), // phpcs:ignore
                'active'  => true,
            ]
        );
        return parent::_beforeToHtml();
    }
}
