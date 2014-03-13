<?php

namespace Account\Controller;

use Account\Form\AccountForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ORM\Entity\Account;

class IndexController extends AbstractActionController
{
	protected $_objectManager;

	protected function getObjectManager()
	{
		if (!$this->_objectManager) {
			$this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}

		return $this->_objectManager;
	}

	public function indexAction()
	{
		$accounts = $this->getObjectManager()->getRepository('\ORM\Entity\Account')->findAll();
		return new ViewModel(
			[
				'accounts' => $accounts
			]
		);

//		$form = new AccountForm();
//		return [
//			'form' => $form
//		];
	}

	public function addAction()
	{
		$form = new AccountForm();
		$request = $this->getRequest();
		if ($request->isPost()) {
			$data = $request->getPost();
			$form->setData($data);
			if ($form->isValid()) {
				print_r($form->getData());
			}
		}
		return [
			'form' => $form
		];
	}

}

