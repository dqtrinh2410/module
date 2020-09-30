<?php
namespace AHT\FeatureProduct\Controller\Index;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\Grid\Collection;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use Magento\Catalog\Model\Product;

class Index extends \Magento\Framework\App\Action\Action {
    protected $_productCollection;
    protected $_featureCollection;

    public function __construct(
        Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        Collection $featureCollection
    ) {
        $this->_featureCollection = $featureCollection;
        $this->_productCollection = $collectionFactory->create();
        parent::__construct($context);
    }

    public function execute()
    {
        print_r(
            $this->_featureCollection->addAttributeToSelect(['name'], 'rightJoin')
                ->getData()
        );
        print_r(
            $this->_productCollection->addAttributeToSelect(['name'], 'fullJoin')
                ->addAttributeToFilter('feature_product', 1)
                ->getData()
        );
        die();
        // TODO: Implement execute() method.
    }
}
