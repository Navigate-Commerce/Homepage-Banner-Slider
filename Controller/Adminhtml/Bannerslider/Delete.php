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
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Navigate\HomepageBannerSlider\Model\BannersliderFactory;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var boolean
     */
    protected $resultPageFactory = false;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var BannersliderFactory
     */
    protected $bannersliderFactory;

    /**
     * Delete Construct method
     *
     * @param Context $context
     * @param ManagerInterface $messageManager
     * @param BannersliderFactory $bannersliderFactory
     */
    public function __construct(
        Context $context,
        ManagerInterface $messageManager,
        BannersliderFactory $bannersliderFactory
    ) {
        parent::__construct($context);
        $this->_resultFactory      = $context->getResultFactory();
        $this->messageManager      = $messageManager;
        $this->bannersliderFactory = $bannersliderFactory;
    }

    /**
     * Execute function
     *
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->bannersliderFactory->create()->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Bannerslider deleted successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addError('Something went wrong '.$e->getMessage());
            }
        } else {
            $this->messageManager->addError('Bannerslider not found, please try once more.');
        }

        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }
}
