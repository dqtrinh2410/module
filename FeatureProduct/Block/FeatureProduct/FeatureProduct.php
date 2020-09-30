<?php
namespace AHT\FeatureProduct\Block\FeatureProduct;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Product\Visibility;
use Magento\CatalogWidget\Model\Rule;
use Magento\Framework\App\Http\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\View\LayoutFactory;
use Magento\Rule\Model\Condition\Sql\Builder;
use Magento\TestFramework\Event\Magento;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ProductFactory;
use AHT\FeatureProduct\Helper\Data;
use Magento\CatalogWidget\Block\Product\ProductsList;
use Magento\Widget\Helper\Conditions;
use Magento\Catalog\Model\Product;

class FeatureProduct extends ProductsList
{
    protected $_featureCollection;
    protected $_productCollection;
    protected $_product;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        ProductCollectionFactory $productCollectionFactory,
        Visibility $catalogProductVisibility,
        Context $httpContext,
        Builder $sqlBuilder,
        Rule $rule,
        Conditions $conditionsHelper,
        CategoryRepositoryInterface $categoryRepository,
        array $data = [],
        Json $json = null,
        LayoutFactory $layoutFactory = null,
        EncoderInterface $urlEncoder = null,
        CollectionFactory $featureCollectionFactory,
        Product  $product
    ) {
        $this->_product = $product;
        $this->_featureCollection = $featureCollectionFactory->create();
        $this->_productCollection = $productCollectionFactory->create();
        parent::__construct($context, $productCollectionFactory, $catalogProductVisibility, $httpContext, $sqlBuilder, $rule, $conditionsHelper, $categoryRepository, $data, $json, $layoutFactory, $urlEncoder);
    }

    public function createCollection()
    {
        $collection = $this->_productCollection->addAttributeToFilter('feature_product', 1);;
        if ($this->getData('store_id') !== null) {
            $collection->setStoreId($this->getData('store_id'));
        }

        $collection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());
        $collection->distinct(true);

        //print_r($collection->getData());die();
        return $collection;
    }

    public function getProductById($entity_id) {
        return $this->_product->load($entity_id);
    }
//    protected $_collection;
//    protected $_productCollectionFactory;
//    protected $_helper;
//    protected $_storeManager;
//    protected $_product;
//
//    public function __construct(
//        Template\Context $context,
//        array $data = [],
//        CollectionFactory $collectionFactory,
//        ProductCollectionFactory $productCollectionFactory,
//        ProductFactory $productFactory,
//        Data $helper
//    ) {
//        $this->_helper = $helper;
//        $this->_product = $productFactory->create();
//        $this->_collection = $collectionFactory->create();
//        $this->_productCollectionFactory = $productCollectionFactory;
//        parent::__construct($context, $data);
//    }
////
//    public function getProductData($numberDisplay) {
//        $arrayData = [];
//        //print_r($this->_collection->getData());die();
//        $listFeature = $this->_collection->setPageSize($numberDisplay);
//        $listProduct = $this->_productCollectionFactory->create();
//    }
//
//    public function getStoreManager() {
//        return $this->_storeManager;
//    }
//
//    public function getHelper() {
//        return $this->_helper;
//    }
//
//    public function getProductLink($entity_id) {
//        return $this->escapeUrl($this->_product->load($entity_id)->getProductUrl());
//    }
}
