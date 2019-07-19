<?php

namespace Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager;

/**
 * Mass-Delete Controller.
 */
class MassDelete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Xigen_CustomerAccountManager::top_level';

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    private $filter;

    /**
     * @var \Xigen\CustomerAccountManager\Model\AccountManagerFactory
     */
    private $accountManagerFactory;

    /**
     * MassDelete constructor.
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
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $ids = $this->getRequest()->getPost('selected');
        if ($ids) {
            $collection = $this->accountManagerFactory->create()
                ->getCollection()
                ->addFieldToFilter('accountmanager_id', ['in' => $ids]);
            $collectionSize = $collection->getSize();
            $deletedItems = 0;
            foreach ($collection as $item) {
                try {
                    $item->delete();
                    $deletedItems++;
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
            if ($deletedItems != 0) {
                if ($collectionSize != $deletedItems) {
                    $this->messageManager->addErrorMessage(
                        __('Failed to delete %1 account manager(s).', $collectionSize - $deletedItems)
                    );
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 account manager(s) have been deleted.', $deletedItems)
                );
            }
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
