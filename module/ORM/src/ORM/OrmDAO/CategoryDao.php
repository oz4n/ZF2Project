<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ORM\OrmDAO;

use ORM\GeneralDAO\DAOManager;

/**
 * Description of CategoryDao
 * @property $objectManager $name Description
 * @author melengo
 */
class CategoryDao extends DAOManager
{

    public function __construct($objectManager, $class)
    {
        parent::__construct($objectManager, $class);
    }

    public function getAllCatBy($offset = null, $limit = null)
    {
        $qb = $this->objectManager->createQueryBuilder();
        $qb->select('t')->from($this->getClass(), 't');
        $qb->where('t.term=1');
        $qb->orderBy('t.root,t.lft', 'ASC');
        $qb->setMaxResults($limit);
        $qb->setFirstResult($offset);
        $result = $qb->getDQL();
        return $this->objectManager->createQuery($result);
    }

}
