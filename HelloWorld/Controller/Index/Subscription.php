<?php
namespace AHT\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;

class Subscription extends Action {

    public function execute()
    {
        $subscription = $this->_objectManager->create('AHT\HelloWorld\Model\Subscription');    
        $subscription->setFirstname('Trinh');
        $subscription->setLastname('Doan');
        $subscription->setEmail('dqtrinh2410@gmail.com');
        $subscription->setMessage('A short message');
        $subscription->save();
        $array = [$subscription->getFirstName(), $subscription->getLastName()];
        $this->getResponse()->setBody($array[1] . '<br>' . $array[0]);
    }
}

