<?php


namespace Xigen\CustomerAccountManager\Model\ResourceModel;

/**
 * AccountManager class
 */
class AccountManager extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('xigen_customeraccountmanager_accountmanager', 'accountmanager_id');
    }
}
