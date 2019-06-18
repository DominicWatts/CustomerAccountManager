<?php


namespace Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager;

/**
 * Edit action class
 */
class Edit extends \Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager
{
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Xigen\CustomerAccountManager\Model\AccountManagerFactory $accountManagerFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->accountManagerFactory = $accountManagerFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('accountmanager_id');
        $model = $this->_objectManager->create(\Xigen\CustomerAccountManager\Model\AccountManager::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This account manager no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('xigen_customeraccountmanager_accountmanager', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit account manager') : __('New account manager'),
            $id ? __('Edit account manager') : __('New account manager')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('account managers'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Account Manager %1', $model->getId()) : __('New Account Manager'));
        return $resultPage;
    }
}
