<?php


namespace Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager;

/**
 * Delete action class
 */
class Delete extends \Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Xigen\CustomerAccountManager\Model\AccountManagerFactory $accountManagerFactory
    ) {
        $this->accountManagerFactory = $accountManagerFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('accountmanager_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->accountManagerFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the account manager.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['accountmanager_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a account manager to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
