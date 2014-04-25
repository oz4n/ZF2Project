<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ORM\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of ServiceManager
 *
 * @author melengo
 */
class ServiceManager implements ServiceLocatorAwareInterface
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

}
