<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ORM\OrmDAO\UserDao;
use ORM\Entity\User;
use ORM\Registry\Registry;
use User\Form\UserForm;
use Doctrine\ORM\EntityManager;

/**
 * @property \ORM\Entity\User $user
 */
class UserController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var type 
     */
    protected $staticSalt = "kljhjKLKJJh98798";

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
    protected function userDaoManager()
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
    protected function findUserId($id)
    {
        return $this->userDaoManager()->find($id);
    }

    /**
     * @param type $user
     */
    protected function prepareUserData($user)
    {
        $user->setPasswordSalt($this->generateDynamicSalt());
        $user->setPassword($this->encryptPassword($this->staticSalt, $user->getPassword(), $user->getPasswordSalt()));
        $user->setRegistrationToken(md5(uniqid(mt_rand(), true)));
        return $user;
    }

    /**
     * 
     * @return type
     */
    protected function generateDynamicSalt()
    {
        $dynamicSalt = '';
        for ($i = 0; $i < 50; $i++) {
            $dynamicSalt .= chr(rand(33, 126));
        }

        return $dynamicSalt;
    }

    /**
     * 
     * @param type $staticSalt
     * @param type $password
     * @param type $dynamicSalt
     * @return type
     */
    protected function encryptPassword($staticSalt, $password, $dynamicSalt)
    {
        return $password = md5($staticSalt . $password . $dynamicSalt);
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $repository = $this->userDaoManager();
        $users = $repository->findAll();
        return new ViewModel([
            "users" => $users
        ]);
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $this->RegisterEntityManager();
        $user = new User();
        $form = new UserForm();
        $form->bind($user);
        $request = $this->getRequest();
        if ($request->isPost()) {
//            echo '<pre>';
//            print_r($request->getPost());
//            echo '</pre>';
//            exit();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->prepareUserData($user);
                $this->userDaoManager()->save($user);
                $this->redirect()->toRoute('user');
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $request = $this->getRequest();
        $id = $request->isPost() ? $request->getPost()->user["id"] : (int) $this->params('id', null);

        if (null === $id) {
            return $this->redirect()->toRoute('user');
        }

        $this->RegisterEntityManager();
        $user = $this->findUserId($id);

        $form = new UserForm();
        $form->bind($user);

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->prepareUserData($user);
                $this->userDaoManager()->save($user);
                $this->redirect()->toRoute('user');
            }
        }

        return new ViewModel([
            'form' => $form,
            'id' => $id
        ]);
    }

    public function deleteAction()
    {
        $id = (int) $this->params('id', null);
        if (null === $id) {
            return $this->redirect()->toRoute('user');
        }

        $this->userDaoManager()->remove($this->findUserId($id));
        $this->redirect()->toRoute('user');
    }

}
