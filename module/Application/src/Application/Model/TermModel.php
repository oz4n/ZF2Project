<?php
namespace Application\Model;

use ORM\Registry\Registry;
use ORM\DAO\DAOManager;

class TermModel
{

    /**
     *
     * @return \ORM\DAO\DAOManager
     */
    protected function TermManager()
    {
        $em = Registry::get('entityManager');
        return new DAOManager($em, 'ORM\Entity\TermTaxonomy');
    }
    
    public function fineAllBreadCrumbs()
    {
    	return array();
    }

    public function findAllMenu()
    {
        // $this->TermManager()->findAll();
        return array(
            array(
                'label' => 'Dashboard',
                'route' => 'home',
                'action' => 'index',
                'id' => 'icon-dashboard',
                'pages' => array()
            ),
            array(
                'label' => 'Words',
                'route' => 'post',
                'id' => ' icon-th-list',
                'pages' => array(
                    array(
                        'label' => 'Posts',
                        'route' => 'post',
                        'action' => 'index',
                        'class' => 'all-post',
                        'id' => 'icon-double-angle-right'
                    ),
                    array(
                        'label' => 'Add New',
                        'route' => 'post',
                        'action' => 'add',
                        'id' => 'icon-double-angle-right'
                    ),
                    array(
                        'label' => 'Categories',
                        'route' => 'category',
                        'action' => 'index',
                        'id' => 'icon-double-angle-right'
                    ),
                    array(
                        'label' => 'Tags',
                        'route' => 'tag',
                        'action' => 'index',
                        'id' => 'icon-double-angle-right'
                    )
                )
            ),
            array(
                'label' => 'Pages',
                'route' => 'page',
                'action' => 'index',
                'id' => 'icon-tasks',
                'pages' => array(
                    array(
                        'label' => 'All Pages',                        
                        'route' => 'page',
                        'action' => 'index',
                        'class' => 'all-page',
                        'id' => 'icon-double-angle-right'
                    ),
                    array(
                        'label' => 'Add New',
                        'route' => 'page',
                        'action' => 'add',
                        'id' => 'icon-double-angle-right'
                    )
                )
            ),
            array(
                'label' => 'Comments',
                'route' => 'comment',
                'action' => 'index',
                'id' => 'icon-comments',
                'pages' => array()
            )
        );
    }
}