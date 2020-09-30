<?php
namespace AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\Grid;

use Magento\Catalog\Model\Indexer\Category\Product\TableMaintainer;
use Magento\Catalog\Model\Indexer\Product\Price\PriceTableResolver;
use Magento\Catalog\Model\ResourceModel\Category;
use Magento\Catalog\Model\ResourceModel\Product\Collection\ProductLimitationFactory;
use Magento\Customer\Api\GroupManagementInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Indexer\DimensionFactory;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;
use AHT\FeatureProduct\Model\FeatureProduct;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class Collection extends ProductCollection implements SearchResultInterface
{
    protected $_featureModel;

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Eav\Model\EntityFactory $eavEntityFactory,
        \Magento\Catalog\Model\ResourceModel\Helper $resourceHelper,
        \Magento\Framework\Validator\UniversalFactory $universalFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Catalog\Model\Indexer\Product\Flat\State $catalogProductFlatState,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\Product\OptionFactory $productOptionFactory,
        \Magento\Catalog\Model\ResourceModel\Url $catalogUrl,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Stdlib\DateTime $dateTime, GroupManagementInterface $groupManagement,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        ProductLimitationFactory $productLimitationFactory = null,
        MetadataPool $metadataPool = null, TableMaintainer $tableMaintainer = null,
        PriceTableResolver $priceTableResolver = null,
        DimensionFactory $dimensionFactory = null,
        Category $categoryResourceModel = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $eavConfig, $resource, $eavEntityFactory, $resourceHelper, $universalFactory, $storeManager, $moduleManager, $catalogProductFlatState, $scopeConfig, $productOptionFactory, $catalogUrl, $localeDate, $customerSession, $dateTime, $groupManagement, $connection, $productLimitationFactory, $metadataPool, $tableMaintainer, $priceTableResolver, $dimensionFactory, $categoryResourceModel);
    }

    public function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinInner(
            'aht_feature_product',
            'e.entity_id = aht_feature_product.entity_id',
            ['aht_feature_product.feature_id']
        );
        $this->addFilterToMap('feature_id','feature_id');
        return $this;
    }



    public function setItems(array $items = null)
    {
        // TODO: Implement setItems() method.
    }

    public function getAggregations()
    {
        // TODO: Implement getAggregations() method.
    }

    public function setAggregations($aggregations)
    {
        // TODO: Implement setAggregations() method.
        return $this->getAggregations();
    }

    public function getSearchCriteria()
    {
        // TODO: Implement getSearchCriteria() method.
        return null;
    }

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement setSearchCriteria() method.
        return $this;

    }

    public function getTotalCount()
    {
        // TODO: Implement getTotalCount() method.
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        // TODO: Implement setTotalCount() method.
        return $this;
    }
}
