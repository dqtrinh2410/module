<?php
namespace AHT\Shipme\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use \Magento\Shipping\Model\Carrier\AbstractCarrier;
use \Magento\Shipping\Model\Carrier\CarrierInterface;

class Shipme extends  AbstractCarrier implements  CarrierInterface{
    /**
     * Carrier's code
     *
     * @var string
     */
    protected $_code = 'shipme';

    /**
     * Factory class for @see \Magento\Shipping\Model\Rate\Result
     *
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;

    /**
     *
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $_rateMethodFactory;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->_rateResultFactory = $rateResultFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Collect and get rate
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        $result = $this->_rateResultFactory->create();

        // check if express method is enable
        if($this->getConfigData('express_enabled')) {
            $method = $this->_rateMethodFactory->create();
            $method->setCarrier($this->_code);
            $method->setCarrierTitle($this->getConfigData('name'));
            $method->setMethod('express');
            $method->setMethodTitle($this->getConfigData('express_title'));
            $method->setPrice($this->getConfigData('express_price'));
            $method->setCost($this->getConfigData('express_price'));
            $result->append($method);
        }

        // check if business method is enable
        if ($this->getConfigData('business_enabled')) {
            $method = $this->_rateMethodFactory->create();
            $method->setCarrier($this->_code);
            $method->setCarrierTitle($this->getConfigData('name'));
            $method->setMethod('business');
            $method->setMethodTitle($this->getConfigData('business_title'));
            $method->setPrice($this->getConfigData('business_price'));
            $result->append($method);
        }
        return  $result;
    }
     public function getAllowedMethods()
     {
         return ['shipme' => $this->getConfigData('name')];
     }

    public function isTrackingAvailable() {
        return true;
    }
}
