<?php
namespace AHT\HelloWorld\Model\ResourceModel\Subscription;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    public function _construct()
    {
        $this->_init('AHT\HelloWorld\Model\Subscription', 'AHT\HelloWorld\Model\ResourceModel\Subscription');
    }
}