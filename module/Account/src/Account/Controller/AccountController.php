<?php

namespace Account\Controller;

use Account\Form\AccountForm;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ORM\Entity\Account;
use ORM\Registry\ORMRegistry;

class AccountController extends AbstractActionController {
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
	protected function setEntityManager(EntityManager $em) {
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
	protected function getEntityManager() {
		if (null === $this->entityManager) {
			$this->setEntityManager ( $this->getServiceLocator ()->get ( 'Doctrine\ORM\EntityManager' ) );
		}
		return $this->entityManager;
	}
	
	/**
	 * Users list action
	 *
	 * Fetches and displays all users.
	 *
	 * @return array view variables
	 */
	public function indexAction() {
		$repository = $this->getEntityManager ()->getRepository ( 'ORM\Entity\Account' );
		$accounts = $repository->findAll ();
		return new ViewModel ( [ 
				"accounts" => $accounts 
		] );
	}
	
	/**
	 * Adds new Account
	 *
	 * @return array view variables
	 */
	public function addAction() {
		// Loading and saving entity manager to Registry
		$em = $this->getEntityManager ();
		ORMRegistry::set ( 'entityManager', $em );
		
		$account = new Account ();
		$form = new AccountForm ();
		$form->bind ( $account );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$form->setData ( $request->getPost () );
			if ($form->isValid ()) {
				$em->persist ( $account );
				$em->flush ();
				
				$this->redirect ()->toRoute ( 'account' );
			}
		}
		
		return new ViewModel ( [ 
				'form' => $form 
		] );
	}
	
	/**
	 * Edits Account
	 *
	 * @return array view variables
	 */
	public function editAction() {
		$request = $this->getRequest ();
		// Getting id parameter either from request or POST
		$id = $request->isPost () ? $request->getPost ()->account ["id"] : ( int ) $this->params ( 'id', null );
		
		if (null === $id) {
			return $this->redirect ()->toRoute ( 'account' );
		}
		
		$em = $this->getEntityManager ();
		ORMRegistry::set ( 'entityManager', $em );
		
		$account = $em->find ( 'ORM\Entity\Account', $id );
		
		$form = new AccountForm ();
		$form->bind ( $account );
		
		if ($request->isPost ()) {
			$form->setData ( $request->getPost () );
			if ($form->isValid ()) {
				$em->persist ( $account );
				$em->flush ();
				
				$this->redirect ()->toRoute ( 'account' );
			}
		}
		
		return new ViewModel ( [ 
				'form' => $form,
				'id' => $id 
		] );
	}
	
	/**
	 * Deletes an User
	 */
	public function deleteAction() {
		$id = ( int ) $this->params ( 'id', null );
		if (null === $id) {
			return $this->redirect ()->toRoute ( 'account' );
		}
		
		$em = $this->getEntityManager ();
		
		$account = $em->find ( 'ORM\Entity\Account', $id );
		
		$em->remove ( $account );
		$em->flush ();
		
		$this->redirect ()->toRoute ( 'account' );
	}
}

