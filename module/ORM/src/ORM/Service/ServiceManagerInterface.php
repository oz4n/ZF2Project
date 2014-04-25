<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ORM\Service;

/**
 *
 * @author melengo
 */
interface ServiceManagerInterface
{

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $locator);

    public function getServiceLocator();

    public function setEntityManager(\Doctrine\ORM\EntityManager $em);

    public function getEntityManager();
}
