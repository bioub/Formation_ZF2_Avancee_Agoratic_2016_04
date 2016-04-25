<?php

namespace Application\Controller;

use Application\Entity\Contact;
use Application\Form\ContactForm;
use Application\Service\ContactServiceInterface;
use CsvView\Model\CsvModel;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use DoctrineModule\Stdlib\Hydrator\Strategy\DisallowRemoveByValue;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Log\Logger;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var ContactServiceInterface
     */
    protected $contactService;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * ContactController constructor.
     * @param ContactServiceInterface $contactService
     */
    public function __construct(ContactServiceInterface $contactService)
    {

        $this->contactService = $contactService;
    }

    public function listAction()
    {
        //$this->logger = $this->getServiceLocator()->get('Log\App');
        //$this->logger->emerg('test');

       /* $config = $this->getServiceLocator()->get('Config');
        if (isset($config["alliance"])) {
            var_dump($config["alliance"]);
        }*/

        return new ViewModel(array(
            'contacts' => $this->contactService->findAll()
        ));
    }

    public function addAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        // TODO mettre le form dans le service manager
        $contactForm = new ContactForm($em);

        if ($this->request->isPost()) {

            $data = $this->request->getPost();
            $contactForm->setData($data);

            // TODO $contactForm->setInputFilter();

            if ($contactForm->isValid()) {
                $dataFiltrees = $contactForm->getData();
                var_dump($dataFiltrees);

                $contact = new Contact();
                // TODO récupérer DoctrineObject dans HydratorManager
                $hydrator = new DoctrineObject($em);
                //$hydrator->addStrategy('groupes', new DisallowRemoveByValue());
                $hydrator->hydrate($dataFiltrees, $contact);

                $em->persist($contact);
                $em->flush();
            }

        }

        return new ViewModel(array(
            'contactForm' => $contactForm
        ));
    }

    public function csvAction()
    {
        return new CsvModel(array(
            array('Prénom', 'Nom'),
            array('Bill', 'Gates'),
            array('Steve', 'Jobs'),
        ), array(
           'filename' => 'contacts.csv')
        );
    }
}