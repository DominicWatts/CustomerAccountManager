<?php


namespace Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager;

use Magento\Framework\Exception\LocalizedException;

/**
 * Save action class
 */
class Save extends \Magento\Backend\App\Action
{
    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Xigen\CustomerAccountManager\Model\AccountManagerFactory $accountManagerFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->accountManagerFactory = $accountManagerFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('accountmanager_id');
            /** @var \Xigen\CustomerAccountManager\Model\AccountManager $accountManagerFactory */
            $model = $this->accountManagerFactory->create()->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This account manager no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the account manager.'));
                $this->dataPersistor->clear('xigen_customeraccountmanager_accountmanager');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['accountmanager_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the account manager.'));
            }
        
            $this->dataPersistor->set('xigen_customeraccountmanager_accountmanager', $data);
            return $resultRedirect->setPath('*/*/edit', ['accountmanager_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
