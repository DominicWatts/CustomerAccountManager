<?php


namespace Xigen\CustomerAccountManager\Api\Data;

/**
 * AccountManagerInterface interface
 */
interface AccountManagerInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const NAME = 'name';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const ACCOUNTMANAGER_ID = 'accountmanager_id';
    const EMAIL = 'email';
    const UPDATED_AT = 'updated_at';

    /**
     * Get accountmanager_id
     * @return string|null
     */
    public function getAccountmanagerId();

    /**
     * Set accountmanager_id
     * @param string $accountmanagerId
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setAccountmanagerId($accountmanagerId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Xigen\CustomerAccountManager\Api\Data\AccountManagerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Xigen\CustomerAccountManager\Api\Data\AccountManagerExtensionInterface $extensionAttributes
    );

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setEmail($email);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setStatus($status);
}
