<?php
namespace AHT\FeatureProduct\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct as FeatureResource;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\Collection as FeatureCollection;
use Magento\Framework\App\Cache\TypeListInterface;
use	Magento\Framework\App\Cache\Frontend\Pool;

class ProductDeleteAfterObserver implements ObserverInterface
{
    protected $_featureResource;
    protected $_featureCollection;
    private $_cacheTypeList;
    private $_cacheFrontendPool;

    public function __construct(
        FeatureResource $featureResource,
        FeatureCollection $featureCollection,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) {
        $this->_featureResource = $featureResource;
        $this->_featureCollection = $featureCollection;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
    }

    public function execute(Observer $observer)
    {
        try {
            $entity_id = $observer->getProduct()->getEntityId();
            $feature_product = $this->_featureCollection->getItemByColumnValue('entity_id', $entity_id);
            if ($feature_product) {
                $this->_featureResource->delete($feature_product);
                $types = array('config','layout','block_html','collections','reflection','db_ddl','compiled_config','eav','config_integration','config_integration_api','full_page','translate','config_webservice','vertex');
                foreach ($types as $type) {
                    $this->_cacheTypeList->cleanType($type);
                }
                foreach ($this->_cacheFrontendPool as $cacheFrontend) {
                    $cacheFrontend->getBackend()->clean();
                }
            }
        } catch (\Exception $e) {

        }
    }
}
