<?php
namespace AHT\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Landingspape extends Template {
    
    public function getLandingspage() {
        return $this->getUrl('less1');
    }

    public function getRedirectUrl() {
        return $this->getUrl('less1/index/redirect');
    }
}