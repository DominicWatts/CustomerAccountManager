<?php


namespace Xigen\CustomerAccountManager\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * AccountManagerRepositoryInterface interface
 */
interface AccountManagerRepositoryInterface
{

    /**
     * Save AccountManager
     * @param \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface $accountManager
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface $accountManager
    );

    /**
     * Retrieve AccountManager
     * @param string $accountmanagerId
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($accountmanagerId);

    /**
     * Retrieve AccountManager matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete AccountManager
     * @param \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface $accountManager
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface $accountManager
    );

    /**
     * Delete AccountManager by ID
     * @param string $accountmanagerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($accountmanagerId);
}
