<?php


namespace Xigen\CustomerAccountManager\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;

/**
 * InstallData class
 */
class InstallData implements InstallDataInterface
{
    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'account_manager', [
            'type' => 'int',
            'label' => 'Account Manager',
            'input' => 'select',
            'source' => \Xigen\CustomerAccountManager\Model\Customer\Attribute\Source\AccountManager::class,
            'required' => false,
            'visible' => true,
            'position' => 500,
            'system' => false,
            'backend' => ''
        ]);
        
        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'account_manager')
        ->addData(
            ['used_in_forms' =>
                [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]
            ]
        );
        $attribute->save();
    }
}
