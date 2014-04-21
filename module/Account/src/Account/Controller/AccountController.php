<?php
namespace Account\Controller;

use Account\Form\AccountForm;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ORM\Entity\User;
use ORM\Registry\Registry;
use ORM\OrmDAO\UserDao;


class AccountController extends AbstractActionController
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
     *
     * @return \ORM\DAO\DAOManager
     */
    protected function AccountDaoManager()
    {
        return new UserDao($this->getEntityManager(), 'ORM\Entity\User');
    }

    /**
     *
     * @return \ORM\Registry\ORMRegistry
     */
    protected function RegisterEntityManager()
    {
        return Registry::set("entityManager", $this->getEntityManager());
    }

    /**
     *
     * @param int $id            
     * @return object
     */
    protected function findAccountId($id)
    {
        return $this->AccountDaoManager()->find($id);
    }

    /**
     * Users list action
     *
     * Fetches and displays all users.
     *
     * @return array view variables
     */
    public function indexAction()
    {
        $repository = $this->AccountDaoManager();
        $accounts = $repository->findAll();
        return new ViewModel([
            "accounts" => $accounts
        ]);
    }

    /**
     * Adds new Account
     *
     * @return array view variables
     */
    public function addAction()
    {
        $this->RegisterEntityManager();
        $account = new User();
        $form = new AccountForm();
        $form->bind($account);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->AccountDaoManager()->save($account);
                $this->redirect()->toRoute('account');
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
        $id = $request->isPost() ? $request->getPost()->account["id"] : (int) $this->params('id', null);
        
        if (null === $id) {
            return $this->redirect()->toRoute('account');
        }
        
        $this->RegisterEntityManager();
        $account = $this->findAccountId($id);
        
        $form = new AccountForm();
        $form->bind($account);
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->AccountDaoManager()->save($account);
                $this->redirect()->toRoute('account');
            }
        }
        
        return new ViewModel([
            'form' => $form,
            'id' => $id
        ]);
    }

    /**
     * Deletes an User
     */
    public function deleteAction()
    {
        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('account');
        }
        
        $this->AccountDaoManager()->remove($this->findAccountId($id));
        $this->redirect()->toRoute('account');
    }
}

