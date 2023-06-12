<?php
/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Controller\Adminhtml\Bannerslider;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\CollectionFactory;
use Navigate\HomepageBannerSlider\Model\BannersliderFactory;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var BannersliderFactory
     */
    protected $bannersliderFactory;

    /**
     * MassStatus Constructor
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param BannersliderFactory $bannersliderFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        BannersliderFactory $bannersliderFactory
    ) {
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->bannersliderFactory = $bannersliderFactory;
        parent::__construct($context);
    }

    /**
     * Execute function
     *
     * @return void
     */
    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $updated = 0;
            foreach ($collection as $item) {
                $model = $this->bannersliderFactory->create()->load($item['id']);
                $model->setData('status', $this->getRequest()->getParam('status'));
                $model->save();
                $updated++;
            }
            $this->messageManager->addSuccess(__('A total of %1 Homepage BannerSlider(s) were updated successfully.', $updated)); // phpcs:ignore
        } catch (Exception $e) {
            $this->messageManager->addError('Something went wrong while deleting the Homepage BannerSlider '.$e->getMessage()); // phpcs:ignore
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
}
