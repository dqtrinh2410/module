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
    protected $_helperData;

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
        Product  $product,
        Data $helperData
    ) {
        $this->_product = $product;
        $this->_helperData = $helperData;
        $this->_featureCollection = $featureCollectionFactory->create();
        $this->_productCollection = $productCollectionFactory->create();
        parent::__construct($context, $productCollectionFactory, $catalogProductVisibility, $httpContext, $sqlBuilder, $rule, $conditionsHelper, $categoryRepository, $data, $json, $layoutFactory, $urlEncoder);
    }

    public function createCollection()
    {
        $collection = $this->_productCollection->addAttributeToSelect('*')
                        ->addAttributeToFilter('feature_product', 1);
        return $collection;
    }

    public function getHelperData() {
        return $this->_helperData;
    }
}
