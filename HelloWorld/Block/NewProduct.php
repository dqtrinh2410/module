<?php
namespace AHT\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class NewProduct extends Template {

    protected $_productCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_productCollectionFactory = $productCollectionFactory;
    }

    public function getProducts() {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('name')
            ->setOrder('created_at')
            ->setPageSize(5);
        // var_dump($collection);die('collection');
        return $collection;
    }
}
