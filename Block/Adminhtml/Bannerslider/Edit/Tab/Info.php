<?php

namespace Navigate\HomepageBannerSlider\Block\Adminhtml\Bannerslider\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;

class Info extends Generic implements TabInterface
{
    /**
     * Info constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param \Magento\Framework\Session\SessionManagerInterface $coreSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        \Magento\Framework\Session\SessionManagerInterface $coreSession,
        array $data = []
    ) {
        $this->_coreSession = $coreSession;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('bannerslider');
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information')]
        );
        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }

        $fieldset->addField(
            "title",
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'comment' => __('Title'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            "slidertitle",
            'text',
            [
                'name' => 'slidertitle',
                'label' => __('Slider Title'),
                'comment' => __('Slider Title'),
                'note' => 'Display title on the image.'
                
            ]
        );

        $fieldset->addField(
            "buttontitle",
            'text',
            [
                'name' => 'buttontitle',
                'label' => __('Button Title'),
                'comment' => __('Button Title')
            ]
        );


         $fieldset->addField(
             "url_key",
             'text',
             [
                'name' => 'url_key',
                'label' => __('Button Url Key'),
                'comment' => __('Button Url Key'),
                'class' => 'validate-url',
                'note' => 'E.g : https://test.com/test.html'
             ]
         );

        $fieldset->addField(
            "imagename",
            'image',
            [
                'name' => 'imagename',
                'label' => __('Desktop Image'),
                'comment' => __('Image'),
                'required' => true,
                'note' => 'Maximum file size: 2 MB. Allowed file types: jpg,jpeg,png'
            ]
        );


        $fieldset->addField(
            "mobileimagename",
            'image',
            [
                'name' => 'mobileimagename',
                'label' => __('Mobile Image'),
                'comment' => __('Mobile Image'),
                'note' => 'Maximum file size: 2 MB. Allowed file types: jpg,jpeg,png'
                
            ]
        );

        $fieldset->addField(
            "status",
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'comment' => __('Status'),
                'values' =>  [['value' => 'Enabled', 'label' => 'Enabled'],['value' => 'Disabled', 'label' => 'Disabled']]
            ]
        );

        $fieldset->addField(
            "position",
            'text',
            [
                'name' => 'position',
                'label' => __('Position'),
                'comment' => __('Position'),
                'class' => 'validate-number'
            ]
        );
        
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('Bannerslider');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Bannerslider');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
