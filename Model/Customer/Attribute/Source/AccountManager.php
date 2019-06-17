<?php


namespace Xigen\CustomerAccountManager\Model\Customer\Attribute\Source;

/**
 * AccountManager class
 */
class AccountManager extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

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
            $collection = $this->accountManagerFactory->create()
                ->getCollection()
                ->addAttributeToFilter('status', ['eq' => 1]);
            foreach ($collection as $item) {
                $this->_options[] = [
                    [
                        'value' => $item->getId(),
                        'label' => __('[%1] %2', $item->getId(), $item->getName())
                    ]
                ];
            }
        }
        return $this->_options;
    }
}
