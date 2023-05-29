<?php
/*
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Ui\Component\Listing\Columns\Bannerslider;

use Magento\Catalog\Helper\Image;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{
    protected const ALT_FIELD = 'title';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param ContextInterface      $context
     * @param UiComponentFactory    $uiComponentFactory
     * @param Image                 $imageHelper
     * @param UrlInterface          $urlBuilder
     * @param StoreManagerInterface $storeManager
     * @param array                 $components
     * @param array                 $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Image $imageHelper,
        UrlInterface $urlBuilder,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->imageHelper  = $imageHelper;
        $this->urlBuilder   = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param  array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = 'imagename';
            foreach ($dataSource['data']['items'] as & $item) {
                $url = '';
                if ($item[$fieldName] != '') {
                    $url = $this->storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    ).$item[$fieldName];
                }

                $item[$fieldName.'_src']      = $url;
                $item[$fieldName.'_alt']      = $this->getAlt($item) ?: '';
                $item[$fieldName.'_title']    = $item['title'];
                $item[$fieldName.'_link']     = $this->urlBuilder->getUrl(
                    'bannerslider/bannerslider/edit',
                    ['id' => $item['id']]
                );
                $item[$fieldName.'_orig_src'] = $url;
            }
        }

        return $dataSource;
    }

    /**
     * Retrive Alg field
     *
     * @param array $row
     * @return void
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}
