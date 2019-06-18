<?php


namespace Xigen\CustomerAccountManager\Controller\Adminhtml\AccountManager;

/**
 * InlineEdit action class
 */
class InlineEdit extends \Magento\Backend\App\Action
{
    protected $jsonFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Xigen\CustomerAccountManager\Model\AccountManagerFactory $accountManagerFactory
    ) {
        $this->accountManagerFactory = $accountManagerFactory;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelId) {
                    /** @var \Xigen\CustomerAccountManager\Model\AccountManager $model */
                    $model = $this->accountManagerFactory->create()->load($modelId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$modelId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Account manager ID: {$modelId}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }
        
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
