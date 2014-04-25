<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Model;

use ORM\OrmDAO\CategoryDao;
use ORM\Registry\Registry;
use ORM\Entity\Taxonomy;
use Post\Form\TaxForm;
use Post\Paginator\Paginator;

/**
 * Description of CategoryModel
 *
 * @author melengo
 */
class CategoryModel
{

    /**
     *
     * @var EntityManager
     */
    protected $dao;

    /**
     *
     * @var ORM\Entity\Taxonomy 
     */
    protected $entity = 'ORM\Entity\Taxonomy';

    /**
     * 
     * @param type $service
     */
    public function __construct($service)
    {
        $this->dao = new CategoryDao($service, $this->entity);
        Registry::set("entityManager", $this->getEntityManager());
    }

    /**
     * 
     * @return \Post\Paginator\Paginator
     */
    public function getPaginator($offset, $limit, $page = 6)
    {
        return new Paginator($this->findAllWithPagination($offset, $limit), $offset, $limit, $page);
    }

    /**
     * 
     * @param type $object
     * @return type
     */
    public function getForm($object)
    {
        $form = new TaxForm();
        return $form->bind($object);
    }

    /**
     * 
     * @return \ORM\Entity\Taxonomy
     */
    public function getEntity()
    {
        return new Taxonomy();
    }

    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->dao->getEntityManager();
    }

    /**
     * 
     * @return Doctrine\Common\Persistence\ObjectRepository
     */
    public function getObjectRepository()
    {
        return $this->dao->getObjectRepository();
    }

    /**
     * 
     * @return type
     */
    public function findAllWithPagination($offset, $limit)
    {
        $dql = $this->dao->findAllCat($offset, $limit);
        return $this->dao->getEntityManager()->createQuery($dql->getDQL());
    }

    /**
     * 
     * @return type
     */
    public function findAll()
    {
        return $this->dao->findAllCat()->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_OBJECT);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function findByPk($id)
    {
        $result = $this->dao->findByPk($id)->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_OBJECT);
        if ($result != null) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $object
     * @return type
     */
    public function save($object)
    {
        return $this->dao->save($object);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function delete($id)
    {
        return $this->dao->remove($this->findByPk($id));
    }

    public function toArray()
    {
        
    }

    public function toJson()
    {
        
    }

}
