<?php
namespace AHT\HelloWorld\Controller\Index;


class Event extends \Magento\Framework\App\Action\Action {
    protected $resultPageFactory;
    protected $productFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Catalog\Model\Factory $productFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context);
    }
    public function execute() {
        $resultPage = $this->resultPageFactory->create();
//        $collection = $this->productFactory->create('\Magento\Catalog\Model\Product')->getCollection();
//        $product = $collection->load(50);
//        $category = $collection->load(10);
//        $parameters = [$product, $category];
        $parameters = [
            'product' => $this->_objectManager->create('Magento\Catalog\Model\Product')->load(50),
            'category' => $this->_objectManager->create('Magento\Catalog\Model\Product')->load(10)
        ];
        $this->_eventManager->dispatch('helloworld_register_visit', $parameters);
        return $resultPage;
    }
}
