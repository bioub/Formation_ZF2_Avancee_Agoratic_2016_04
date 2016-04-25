<?php

namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $cm)
    {
        $sm = $cm->getServiceLocator();
        $contactService = $sm->get('Application\Service\Contact');
        return new \Application\Controller\ContactController($contactService);
    }
}