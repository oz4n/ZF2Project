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

}
