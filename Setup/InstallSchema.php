<?php


namespace Xigen\CustomerAccountManager\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * InstallSchema class
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_xigen_customeraccountmanager_accountmanager = $setup->getConnection()
            ->newTable($setup->getTable('xigen_customeraccountmanager_accountmanager'));

        $table_xigen_customeraccountmanager_accountmanager->addColumn(
            'accountmanager_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_xigen_customeraccountmanager_accountmanager->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Name'
        );

        $table_xigen_customeraccountmanager_accountmanager->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Email'
        );

        $table_xigen_customeraccountmanager_accountmanager->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created At'
        );

        $table_xigen_customeraccountmanager_accountmanager->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Updated At'
        );

        $table_xigen_customeraccountmanager_accountmanager->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Status'
        );

        $setup->getConnection()->createTable($table_xigen_customeraccountmanager_accountmanager);
    }
}
