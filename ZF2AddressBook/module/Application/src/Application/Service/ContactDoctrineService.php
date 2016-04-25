<?php
namespace Application\Service;

use Application\Entity\Contact;
use Doctrine\ORM\EntityManager;

class ContactDoctrineService implements ContactServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ContactDoctrineService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getRepository()
    {
        return $this->em->getRepository(Contact::class);
    }

    public function findAll()
    {
        return $this->getRepository()->findAll();
    }
}