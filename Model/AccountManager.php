<?php


namespace Xigen\CustomerAccountManager\Model;

use Magento\Framework\Api\DataObjectHelper;
use Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface;
use Xigen\CustomerAccountManager\Api\Data\AccountManagerInterfaceFactory;

/**
 * AccountManager class
 */
class AccountManager extends \Magento\Framework\Model\AbstractModel
{
    protected $_eventPrefix = 'xigen_customeraccountmanager_accountmanager';

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var AccountManagerInterfaceFactory
     */
    protected $accountmanagerDataFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;

    /**
     * AccountManager constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AccountManagerInterfaceFactory $accountmanagerDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\AccountManager $resource
     * @param ResourceModel\AccountManager\Collection $resourceCollection
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        AccountManagerInterfaceFactory $accountmanagerDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Xigen\CustomerAccountManager\Model\ResourceModel\AccountManager $resource,
        \Xigen\CustomerAccountManager\Model\ResourceModel\AccountManager\Collection $resourceCollection,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        $this->accountmanagerDataFactory = $accountmanagerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dateTime = $dateTime;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Before save
     */
    public function beforeSave()
    {
        $this->setUpdatedAt($this->dateTime->gmtDate());
        if ($this->isObjectNew()) {
            $this->setCreatedAt($this->dateTime->gmtDate());
        }
        return parent::beforeSave();
    }

    /**
     * Retrieve accountmanager model with accountmanager data
     * @return AccountManagerInterface
     */
    public function getDataModel()
    {
        $accountmanagerData = $this->getData();

        $accountmanagerDataObject = $this->accountmanagerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $accountmanagerDataObject,
            $accountmanagerData,
            AccountManagerInterface::class
        );

        return $accountmanagerDataObject;
    }
}
