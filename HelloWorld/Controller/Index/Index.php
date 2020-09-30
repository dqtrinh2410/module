<?php
namespace AHT\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\SessionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Index extends Action {
    /***
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    protected $_productCollectionFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CollectionFactory $productCollectionFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    public function execute() {
        $resultPage = $this->_resultPageFactory->create();
   	    return $resultPage;
//        $p = $this->_productCollectionFactory->create()
//            ->addAttributeToSelect('*')
//            ->addAttributeToFilter('feature_product', 1);
//        echo $p->getName();
    }
}
