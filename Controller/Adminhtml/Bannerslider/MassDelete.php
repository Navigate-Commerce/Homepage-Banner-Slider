<?php
namespace Navigate\HomepageBannerSlider\Controller\Adminhtml\Bannerslider;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_filter;
    /**
     * @var \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\CollectionFactory
     */
    protected $_collectionFactory;

    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Navigate\HomepageBannerSlider\Model\ResourceModel\Bannerslider\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $itemsDelete = 0;
            foreach ($collection as $item) {
                $data = $item->getData();
                $item->delete();
                $itemsDelete++;
            }
            $this->messageManager->addSuccess(__('A total of %1 Bannerslider(s) were deleted successfully.', $itemsDelete));
        } catch (Exception $e) {
            $this->messageManager->addError('Something went wrong while deleting the Bannerslider '.$e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('bannerslider/bannerslider/index');
    }
}
