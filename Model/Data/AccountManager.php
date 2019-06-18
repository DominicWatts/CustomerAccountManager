<?php


namespace Xigen\CustomerAccountManager\Model\Data;

use Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface;

/**
 * AccountManager class
 */
class AccountManager extends \Magento\Framework\Api\AbstractExtensibleObject implements AccountManagerInterface
{

    /**
     * Get accountmanager_id
     * @return string|null
     */
    public function getAccountmanagerId()
    {
        return $this->_get(self::ACCOUNTMANAGER_ID);
    }

    /**
     * Set accountmanager_id
     * @param string $accountmanagerId
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setAccountmanagerId($accountmanagerId)
    {
        return $this->setData(self::ACCOUNTMANAGER_ID, $accountmanagerId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Xigen\CustomerAccountManager\Api\Data\AccountManagerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Xigen\CustomerAccountManager\Api\Data\AccountManagerExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
