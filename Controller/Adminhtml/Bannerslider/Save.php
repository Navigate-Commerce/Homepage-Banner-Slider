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

use Magento\Framework\Filesystem;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Controller\ResultFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Navigate\HomepageBannerSlider\Model\BannersliderFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var boolean
     */
    protected $resultPageFactory = false;

    /**
     * @var File
     */
    protected $fileIo;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var UploaderFactory
     */
    protected $uploader;

    /**
     * @var BannersliderFactory
     */
    protected $bannersliderFactory;

    /**
     * Construct method
     *
     * @param Context $context
     * @param File $fileIo
     * @param Filesystem $filesystem
     * @param UploaderFactory $uploader
     * @param BannersliderFactory $bannersliderFactory
     */
    public function __construct(
        Context $context,
        File $fileIo,
        Filesystem $filesystem,
        UploaderFactory $uploader,
        BannersliderFactory $bannersliderFactory
    ) {
        parent::__construct($context);
        $this->_resultFactory      = $context->getResultFactory();
        $this->fileIo              = $fileIo;
        $this->filesystem          = $filesystem;
        $this->uploader            = $uploader;
        $this->bannersliderFactory = $bannersliderFactory;
    }

    /**
     * Execute method
     *
     * @return void
     */
    public function execute()
    {
        $data     = $this->getRequest()->getParams();
        $mediaDirectory     = $this->filesystem->getDirectoryWrite(
            \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
        );
        $target   = $mediaDirectory->getAbsolutePath('Navigate/Slider/');
        $delImage = $mediaDirectory->getAbsolutePath();
        $ImgFiles = $this->getRequest()->getFiles('imagename')['name'];
        $MobileImgFiles = $this->getRequest()->getFiles('mobileimagename')['name'];
        $model = $this->bannersliderFactory->create();

        try {
            if (isset($data['imagename']['delete'])) {
                $deleteImage       = $delImage.$data['imagename']['value'];
                $data['imagename'] = '';
                $this->fileIo->rm($deleteImage);
            }

            if (isset($data['imagename']['value'])) {
                $data['imagename'] = $data['imagename']['value'];
            }

            // Mobile Image logic
            if (isset($data['mobileimagename']['delete'])) {
                $deleteMobileImage       = $delImage.$data['mobileimagename']['value'];
                $data['mobileimagename'] = '';
                $this->fileIo->rm($deleteMobileImage);
            }

            if (isset($data['mobileimagename']['value'])) {
                $data['mobileimagename'] = $data['mobileimagename']['value'];
            }

            // end mobile logic
            if (isset($ImgFiles) && $ImgFiles != '') {
                try {
                    $allowed_file_types = ['jpg', 'jpeg', 'png', 'svg', 'gif'];
                    $uploader           = $this->uploader->create(['fileId' => 'imagename']);
                    if (in_array($uploader->getFileExtension(), $allowed_file_types)) {
                        $filename             = '';
                        $allowedExtensionType = '';
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'png','svg','gif']);
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(true);
                        $uploader->save($target);
                        $fileName          = 'Navigate/Slider'.$uploader->getUploadedFileName();
                        $data['imagename'] = $fileName;
                    } else {
                        $this->messageManager->addError(
                            __('Please upload valid type of format for Slider Image.
                            File types allowed for Image are : .jpg, .jpeg, .png, .svg, .gif')
                        );

                        if ($this->getRequest()->getParam('id')) {
                            $this->_redirect('*/*/edit', [
                                'id' => $this->getRequest()->getParam('id'),
                                '_current' => true]);
                            return;
                        }

                        $this->_redirect('*/*/');
                        return;
                    }
                } catch (\Exception $e) {
                    throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                }
            }

            // Mobile image upload
            if (isset($MobileImgFiles) && $MobileImgFiles != '') {
                try {
                    $allowed_file_types = ['jpg', 'jpeg', 'png', 'svg', 'gif'];
                    $uploader           = $this->uploader->create(['fileId' => 'mobileimagename']);
                    if (in_array($uploader->getFileExtension(), $allowed_file_types)) {
                        $filename             = '';
                        $allowedExtensionType = '';
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'png','svg','gif']);
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(true);
                        $uploader->save($target);
                        $fileName                = 'Navigate/Slider'.$uploader->getUploadedFileName();
                        $data['mobileimagename'] = $fileName;
                    } else {
                        $this->messageManager->addError(
                            __('Please upload valid type of format for Slider Image.
                            File types allowed for Image are : .jpg, .jpeg, .png, .svg, .gif')
                        );

                        if ($this->getRequest()->getParam('id')) {
                            $this->_redirect('*/*/edit', [
                                'id' => $this->getRequest()->getParam('id'),
                                '_current' => true]);
                            return;
                        }

                        $this->_redirect('*/*/');
                        return;
                    }
                } catch (\Exception $e) {
                    throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                }
            }

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                if ($id != $model->getId()) {
                    throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                }
            }

            try {
                if (isset($data['store_id']) && !empty($data['store_id'])) {
                    $data['store_id'] = implode(',', $data['store_id']);
                } else {
                    $data['store_id'] = 0;
                }
                $model->setData($data)->setId($id);
                $model->save();
                $this->messageManager->addSuccess('Bannerslider succesfully added.');
            } catch (\Exception $e) {
                $this->messageManager->addError('Something went wrong while saving Bannerslider');
            }
        } catch (Exception $e) {
            $this->messageManager->addError('Something went wrong '.$e->getMessage());
        }

        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath(
                '*/*/edit',
                [
                    'id'       => $model->getId(),
                    '_current' => true,
                ]
            );
        }
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }
}
