<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Paginator;

use Zend\Paginator\Paginator as ZendPaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

/**
 * Description of Paginator
 *
 * @author melengo
 */
class Paginator extends ZendPaginator
{

    protected $pagecount;
    protected $itemsPerPage;

    /**
     * 
     * @param type $query
     * @param type $offset
     * @param type $limit
     * @param type $pageRange
     */
    public function __construct($query, $offset, $limit, $pageRange = 5)
    {
        $adapter = $this->getPaging($query);
        parent::__construct($adapter);
        $this->setPageRange($pageRange);
        $this->setPageCount($adapter);
        $this->setItemsPerPage($limit, $offset);
    }

    /**
     * 
     * @param type $query
     * @return \DoctrineORMModule\Paginator\Adapter\DoctrinePaginator
     */
    public function getPaging($query)
    {
        $paginator = $this->getDoctrinePagintaor($query);
        return $this->getDoctrineAdapter($paginator);
    }
    
    /**
     * 
     * @param type $paginator
     * @return \DoctrineORMModule\Paginator\Adapter\DoctrinePaginator
     */
    public function getDoctrineAdapter($paginator)
    {
        return new DoctrinePaginatorAdapter($paginator);
    }
    
    /**
     * 
     * @param type $query
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function getDoctrinePagintaor($query)
    {
        return new DoctrinePaginator($query);
    }
    
    /**
     * 
     * @return type
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }
    
    /**
     * 
     * @param type $limit
     * @param type $offset
     */
    public function setItemsPerPage($limit, $offset)
    {
        $this->itemsPerPage = $this->setCurrentPageNumber($offset)->setItemCountPerPage($limit);
    }
    
    /**
     * 
     * @return type
     */
    public function getPageCount()
    {
        return $this->pagecount;
    }
    
    /**
     * 
     * @param type $count
     */
    public function setPageCount($count)
    {
        $this->pagecount = count($count);
    }

}
