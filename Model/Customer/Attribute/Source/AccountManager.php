<?php


namespace Xigen\CustomerAccountManager\Model\Customer\Attribute\Source;

/**
 * AccountManager class
 */
class AccountManager extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    const ACCOUNT_MANAGER_ENABLED = 1;

    /**
     * @var \Xigen\CustomerAccountManager\Model\AccountManagerFactory
     */
    protected $accountManagerFactory;

    public function __construct(
        \Xigen\CustomerAccountManager\Model\AccountManagerFactory $accountManagerFactory
    ) {
        $this->accountManagerFactory = $accountManagerFactory;
    }

    /**
     * getAllOptions
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '', 'label' => __('Please select')]
            ];
            $collection = $this->accountManagerFactory->create()
                ->getCollection()
                ->addFieldToFilter('status', ['eq' => self::ACCOUNT_MANAGER_ENABLED])
                ->setOrder('name', 'ASC');
            if ($collection && $collection->getSize() > 0) {
                foreach ($collection as $item) {
                    $this->_options[] = [
                        'value' => $item->getId(),
                        'label' => __('[%1] %2', $item->getId(), $item->getName())
                    ];
                }
            }
        }
        return $this->_options;
    }
}
