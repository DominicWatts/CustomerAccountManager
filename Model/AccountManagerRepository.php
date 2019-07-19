<?php


namespace Xigen\CustomerAccountManager\Model;

use Xigen\CustomerAccountManager\Model\ResourceModel\AccountManager as ResourceAccountManager;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Xigen\CustomerAccountManager\Api\AccountManagerRepositoryInterface;
use Xigen\CustomerAccountManager\Model\ResourceModel\AccountManager\CollectionFactory as AccountManagerCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Xigen\CustomerAccountManager\Api\Data\AccountManagerSearchResultsInterfaceFactory;
use Xigen\CustomerAccountManager\Api\Data\AccountManagerInterfaceFactory;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Reflection\DataObjectProcessor;

/**
 * AccountManagerRepository class
 */
class AccountManagerRepository implements AccountManagerRepositoryInterface
{
    /**
     * @var ResourceAccountManager
     */
    protected $resource;

    /**
     * @var AccountManagerInterfaceFactory
     */
    protected $dataAccountManagerFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var AccountManagerCollectionFactory
     */
    protected $accountManagerCollectionFactory;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var AccountManagerFactory
     */
    protected $accountManagerFactory;

    /**
     * @var DataObjectProcessor .
     */
    protected $dataObjectProcessor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var AccountManagerSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @param ResourceAccountManager $resource
     * @param AccountManagerFactory $accountManagerFactory
     * @param AccountManagerInterfaceFactory $dataAccountManagerFactory
     * @param AccountManagerCollectionFactory $accountManagerCollectionFactory
     * @param AccountManagerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceAccountManager $resource,
        AccountManagerFactory $accountManagerFactory,
        AccountManagerInterfaceFactory $dataAccountManagerFactory,
        AccountManagerCollectionFactory $accountManagerCollectionFactory,
        AccountManagerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->accountManagerFactory = $accountManagerFactory;
        $this->accountManagerCollectionFactory = $accountManagerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAccountManagerFactory = $dataAccountManagerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface $accountManager
    ) {
        $accountManagerData = $this->extensibleDataObjectConverter->toNestedArray(
            $accountManager,
            [],
            \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface::class
        );

        $accountManagerModel = $this->accountManagerFactory->create()->setData($accountManagerData);

        try {
            $this->resource->save($accountManagerModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the accountManager: %1',
                $exception->getMessage()
            ));
        }
        return $accountManagerModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($accountManagerId)
    {
        $accountManager = $this->accountManagerFactory->create();
        $this->resource->load($accountManager, $accountManagerId);
        if (!$accountManager->getId()) {
            throw new NoSuchEntityException(__('AccountManager with id "%1" does not exist.', $accountManagerId));
        }
        return $accountManager->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->accountManagerCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Xigen\CustomerAccountManager\Api\Data\AccountManagerInterface $accountManager
    ) {
        try {
            $accountManagerModel = $this->accountManagerFactory->create();
            $this->resource->load($accountManagerModel, $accountManager->getAccountmanagerId());
            $this->resource->delete($accountManagerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the AccountManager: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($accountManagerId)
    {
        return $this->delete($this->getById($accountManagerId));
    }
}
