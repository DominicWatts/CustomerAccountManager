<?php
namespace Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager;

/**
 * Mass-Status Controller.
 */
class MassStatus extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Xigen_CustomerAccountManager::top_level';
    private $filter;
    private $collectionFactory;
    private $accountManagerFactory;
    /**
     * MassStatus constructor
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Xigen\CustomerAccountManager\Model\AccountManagerFactory $accountManagerFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Xigen\CustomerAccountManager\Model\AccountManagerFactory $accountManagerFactory
    ) {
        $this->filter = $filter;
        $this->accountManagerFactory = $accountManagerFactory;
        parent::__construct($context);
    }
    /**
     * Execute action.
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $ids = $this->getRequest()->getPost('selected');
        $status = $this->getRequest()->getParam('status');
        if ($ids) {
            $collection = $this->accountManagerFactory->create()
                ->getCollection()
                ->addFieldToFilter('accountmanager_id', ['in' => $ids]);
            $collectionSize = $collection->getSize();
            $updatedItems = 0;
            foreach ($collection as $item) {
                try {
                    $item->setStatus($status);
                    $item->save();
                    $updatedItems++;
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
            if ($updatedItems != 0) {
                if ($collectionSize != $updatedItems) {
                    $this->messageManager->addErrorMessage(
                        __('Failed to update %1 custome manager(s).', $collectionSize - $updatedItems)
                    );
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 customer manager(s) have been updated.', $updatedItems)
                );
            }
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
