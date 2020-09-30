<?php
namespace AHT\HelloWorld\Controller\Index;

class Collection extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $productCollection = $this->_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price',
                'image'
            ])->addAttributeToFilter('name', array(
                'like' => '%Sport%'
            ));
        $output = $productCollection->getSelect()->__toString();
//        echo  $productCollection->getName();
        $this->getResponse()->setBody($output);
    }
}
