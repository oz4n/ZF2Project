<?php
namespace Account\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use ORM\Entity\TermAccount;
use ORM\Registry\Registry;
use Account\Form\TermAccountForm;

class TermAccountController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em            
     * @access protected
     * @return UserController
     */
    protected function setEntityManager(EntityManager $em)
    {
        $this->entityManager = $em;
        return $this;
    }

    /**
     * Returns the EntityManager
     *
     * Fetches the EntityManager from ServiceLocator if it has not been initiated
     * and then returns it
     *
     * @access protected
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $repository = $this->getEntityManager()->getRepository('ORM\Entity\TermAccount');
        $termaccounts = $repository->findAll();
        return new ViewModel([
            "termaccounts" => $termaccounts
        ]);
    }

    /**
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        // Loading and saving entity manager to Registry
        $em = $this->getEntityManager();
        Registry::set('entityManager', $em);
        
        $termaccount = new TermAccount();
        $form = new TermAccountForm();
        $form->bind($termaccount);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($termaccount);
                $em->flush();
                
                $this->redirect()->toRoute('termaccount');
            }
        }
        
        return new ViewModel([
            'form' => $form
        ]);
    }

    /**
     * Edits Account
     *
     * @return array view variables
     */
    public function editAction()
    {
        $request = $this->getRequest();
        // Getting id parameter either from request or POST
        $id = $request->isPost() ? $request->getPost()->termaccount["id"] : (int) $this->params('id', null);
        
        if (null === $id) {
            return $this->redirect()->toRoute('termaccount');
        }
        
        $em = $this->getEntityManager();
        Registry::set('entityManager', $em);
        
        $termaccount = $em->find('ORM\Entity\TermAccount', $id);
        
        $form = new TermAccountForm();
        $form->bind($termaccount);
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($termaccount);
                $em->flush();
                
                $this->redirect()->toRoute('termaccount');
            }
        }
        
        return new ViewModel([
            'form' => $form,
            'id' => $id
        ]);
    }
}

