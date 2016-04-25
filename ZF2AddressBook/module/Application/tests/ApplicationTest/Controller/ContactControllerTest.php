<?php

namespace ApplicationTest\Controller;

use Application\Entity\Contact;
use Application\Service\ContactServiceInterface;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ContactControllerTest extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig(require 'config/application.config.php');
    }

    public function testListActionIsAccessible()
    {
        $this->dispatch('/application/contact/list');

        $this->assertResponseStatusCode(200);
    }

    public function testListActionContent()
    {
        $this->dispatch('/application/contact/list');

        $this->assertQueryCount('li.contact', 4);
    }

    public function testListActionContentWithMock()
    {
        $service = $this->prophesize(ContactServiceInterface::class);

        $service->findAll()->shouldBeCalledTimes(1)->willReturn(array(
            (new Contact())->setId(1)->setPrenom('Jean')->setNom('Dupont'),
            (new Contact())->setId(2)->setPrenom('Eric')->setNom('Martin'),
        ));

        $sm = $this->getApplicationServiceLocator();
        $sm->setAllowOverride(true);

        $sm->setService('Application\Service\Contact', $service->reveal());

        $this->dispatch('/application/contact/list');

        $this->assertQueryCount('li.contact', 2);
    }
}


