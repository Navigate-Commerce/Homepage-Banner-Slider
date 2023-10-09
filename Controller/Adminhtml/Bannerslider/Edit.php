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

use Magento\Framework\Registry;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Navigate\HomepageBannerSlider\Model\BannersliderFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var BannersliderFactory
     */
    protected $bannersliderFactory;

    /**
     * Edit Construct method
     *
     * @param Context $context
     * @param Registry $registry
     * @param PageFactory $resultPageFactory
     * @param BannersliderFactory $bannersliderFactory
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $resultPageFactory,
        BannersliderFactory $bannersliderFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry       = $registry;
        $this->resultPageFactory   = $resultPageFactory;
        $this->bannersliderFactory = $bannersliderFactory;
    }

    /**
     * Execute function
     *
     * @return void
     */
    public function execute()
    {
        $bannerslider = $this->getRequest()->getParam('id');
        $model        = $this->bannersliderFactory->create()->load($bannerslider);
        $this->_coreRegistry->register('bannerslider', $model);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Navigate_HomepageBannerSlider::bannerslider');
        $resultPage->getConfig()->getTitle()->prepend($bannerslider ? __('Edit Banner "'.$model->getTitle().'"') : __('New Bannerslider')); // phpcs:ignore
        return $resultPage;
    }
}
