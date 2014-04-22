<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Model;

use ORM\OrmDAO\CategoryDao;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of CategoryModel
 *
 * @author melengo
 */
class CategoryModel implements ServiceLocatorAwareInterface
{

    /**
     *
     * @var type 
     */
    protected $services;

    /**
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var ORM\Entity\Taxonomy 
     */
    protected $entity = 'ORM\Entity\Taxonomy';

    /**
     * 
     * @param type $objekmanager
     */
    public function __construct($objekmanager)
    {
        $this->setServiceLocator($objekmanager);
    }

    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $locator
     */
    public function setServiceLocator(ServiceLocatorInterface $locator)
    {
        $this->services = $locator;
    }

    /**
     * 
     * @return type
     */
    public function getServiceLocator()
    {
        return $this->services;
    }

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em            
     * @access public
     * @return UserController
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $em)
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
     * @access public
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->setEntityManager(
                    $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            );
        }
        return $this->entityManager;
    }

    /**
     * 
     * @return \ORM\OrmDAO\CategoryDao
     */
    protected function catDaoManager()
    {
        return new CategoryDao($this->getEntityManager(), $this->entity);
    }

    public function findAllByQuery($offset, $limit)
    {
        return $this->catDaoManager()->getAllCatBy($offset, $limit);
    }

    public function findAll()
    {
        return $this->catDaoManager()->findBy(['term' => 1], ['root' => 'ASC', 'lft' => 'ASC']);
    }

    public function findById($id)
    {
        return $this->catDaoManager()->findByPk($id);
    }

    public function save($object)
    {
        return $this->catDaoManager()->save($object);
    }

    public function delete($id)
    {
        return $this->catDaoManager()->remove($this->findById($id));
    }

}
