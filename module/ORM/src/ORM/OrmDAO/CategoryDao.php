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
 * @property $entityManager $name Description
 * @author melengo
 */
class CategoryDao extends DAOManager
{

    public function __construct($service, $class)
    {
        parent::__construct($service, $class);
    }

    public function findAllCat($offset = null, $limit = null)
    {
        return $this->findAll('t.term=1', ['orderBy' => ['entity' => 't.root,t.lft', 'sort' => self::ASC], 'limit' => $limit, 'offset' => $offset]);
    }

    public function findAllCatWithKey($key = null, $offset = null, $limit = null)
    {
        $dql = $this->getEntityManager()->createQueryBuilder();
        $dql->select('t')->from($this->getClass(), 't');
        $dql->where('t.term=1',
                $dql->expr()->orX(                         
                        $dql->expr()->like('t.name', $dql->expr()->literal("%$key%")),
                        $dql->expr()->like('t.slug', $dql->expr()->literal("%$key%")),
                        $dql->expr()->like('t.description', $dql->expr()->literal("%$key%"))
        ));
        $dql->orderBy('t.root,t.lft', 'ASC');
        $dql->setMaxResults($limit);
        $dql->setFirstResult($offset);
        return $dql;
    }

}
