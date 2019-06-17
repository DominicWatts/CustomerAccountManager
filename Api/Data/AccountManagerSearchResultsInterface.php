<?php


namespace Xigen\CustomerAccountManager\Api\Data;

/**
 * AccountManagerSearchResultsInterface interface
 */
interface AccountManagerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get AccountManager list.
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
