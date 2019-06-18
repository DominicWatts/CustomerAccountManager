<?php


namespace Xigen\CustomerAccountManager\Rewrite\Magento\Customer\Block\Account\Dashboard;

/**
 * Info Block class
 */
class Info extends \Magento\Customer\Block\Account\Dashboard\Info
{
    /**
     * @var \Xigen\CustomerAccountManager\Api\AccountManagerRepositoryInterface
     */
    protected $accountManagerRepositoryInterface;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        \Magento\Customer\Helper\View $helperView,
        \Xigen\CustomerAccountManager\Api\AccountManagerRepositoryInterface $accountManagerRepositoryInterface,
        \Psr\Log\LoggerInterface $logger,
        array $data = []
    ) {
        $this->accountManagerRepositoryInterface = $accountManagerRepositoryInterface;
        $this->logger = $logger;
        parent::__construct($context, $currentCustomer, $subscriberFactory, $helperView, $data);
    }

    /**
     * Get customer account manager
     * @return string
     */
    public function getCustomerAccountManager()
    {
        if ($customer = $this->getCustomer()) {
            if ($accountManager = $customer->getCustomAttribute('account_manager')) {
                return $accountManager->getValue() ?: null;
            }
        }
        return false;
    }

    /**
     * Get account manager from customer in session
     * @return \Xigen\CustomerAccountManager\Model\Data\AccountManager
     */
    public function getCustomerAccountManagerDetails()
    {
        if ($accountManager = $this->getCustomerAccountManager()) {
            return $this->getAccountManagerById($accountManager);
        }
    }

    /**
     * Get customer account manager by Id
     * @param int $accountManagerId
     * @return \Xigen\CustomerAccountManager\Model\Data\AccountManager
     */
    public function getAccountManagerById($accountManagerId)
    {
        try {
            return $this->accountManagerRepositoryInterface->getById($accountManagerId);
        } catch (\Exception $e) {
            $this->logger->critical($e);
            return false;
        }
    }

    /**
     * Get the full name of account manager
     * @return string
     */
    public function getAccountManagerName()
    {
        if ($accountManager = $this->getCustomerAccountManagerDetails()) {
            return $accountManager->getName();
        }
    }

    /**
     * Get the email of account manager
     * @return string
     */
    public function getAccountManagerEmail()
    {
        if ($accountManager = $this->getCustomerAccountManagerDetails()) {
            return $accountManager->getEmail();
        }
    }
}
