<?php

namespace ApplicationTest\Entity;

use Application\Entity\Contact;
use Doctrine\Common\Collections\ArrayCollection;

require_once __DIR__ . '/../../../src/Application/Entity/Contact.php';

class ContactTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Contact
     */
    protected $contact;

    protected function setUp()
    {
        $this->contact = new Contact();
    }

    public function testInitialValuesAreNull()
    {
        $this->assertNull($this->contact->getId());
        $this->assertNull($this->contact->getPrenom());
        $this->assertNull($this->contact->getNom());
        $this->assertNull($this->contact->getEmail());
        $this->assertNull($this->contact->getTelephone());
        $this->assertNull($this->contact->getSociete());
        $this->assertInstanceOf(ArrayCollection::class, $this->contact->getGroupes());
        $this->assertEmpty($this->contact->getGroupes());
    }

    public function testGetSetId()
    {
        $this->contact->setId(1);
        $this->assertEquals(1, $this->contact->getId());
    }
}