<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use User\Entity\User;

class UserController extends AbstractActionController
{

    /**
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     *
     * @param EntityManager $em            
     * @access protected
     * @return \User\Controller\UserController
     */
    protected function setEntityManager(EntityManager $em)
    {
        $this->entityManager = $em;
        return $this;
    }

    /**
     *
     * @access protected
     * @return \Doctrine\ORM\EntityManager
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
     * @var int $id
     * @access protected
     * @return \User\Entity\User
     */
    protected function findUserId($id)
    {
    	return $this->getEntityManager()->find('User\Entity\User', $id);    	    	
    }
    
    
    public function addAction()
    {
        $user = new User();
        $user->setUsername("ozan");
        $user->setPassword("password");
        $user->setEmail("ozan@zf2.com");
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        exit();
    }

    public function editAction()
    {
        $id = (int) $this->params('id', null);
        $user = $this->findUserId($id);
        $user->setUsername("melengo");
        $user->setPassword("admin");
        $user->setEmail("melengo@zf2.com");
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        exit();
    }

    public function deleteAction()
    {
        $id = (int) $this->params('id', null);
        $user = $this->findUserId($id);        
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
        exit();
    }
}

