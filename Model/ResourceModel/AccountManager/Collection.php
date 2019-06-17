<?php


namespace Xigen\CustomerAccountManager\Model\ResourceModel\AccountManager;

/**
 * Collection class
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
 
    /**
     * @var string
     */
    protected $_idFieldName = 'accountmanager_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Xigen\CustomerAccountManager\Model\AccountManager::class,
            \Xigen\CustomerAccountManager\Model\ResourceModel\AccountManager::class
        );
    }
}
