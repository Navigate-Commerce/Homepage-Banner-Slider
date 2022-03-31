<?php
namespace Navigate\HomepageBannerSlider\Ui\Component\Listing\Columns\Bannerslider;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = ['label' => 'Enabled', 'value' => 'Enabled'];
        $options[] = ['label' => 'Disabled', 'value' => 'Disabled'];
        return $options;
    }
}
