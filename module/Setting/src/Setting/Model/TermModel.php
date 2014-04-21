<?php

namespace Setting\Model;

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

    public function findAllMenu()
    {
        // $this->TermManager()->findAll();
        return array(
            array(
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'action' => 'index',
                'id' => 'menu-icon fa fa-dashboard',
                'roles' => array('admin'),
                'pages' => array()
            ),
            array(
                'label' => 'Words',
                'route' => 'post',
                'id' => 'menu-icon fa fa-tasks',
                'pages' => array(
                    array(
                        'label' => 'Posts',
                        'route' => 'post',
                        'action' => 'index',
                        'class' => 'all-post',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    ),
                    array(
                        'label' => 'Add New',
                        'route' => 'post',
                        'action' => 'add',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    ),
                    array(
                        'label' => 'Categories',
                        'route' => 'post/post_category',
                        'action' => 'index',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    ),
                    array(
                        'label' => 'Tags',
                        'route' => 'post/post_tag',
                        'action' => 'index',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    )
                )
            ),
            array(
                'label' => 'Pages',
                'route' => 'page',
                'action' => 'index',
                'id' => 'menu-icon fa fa-files-o',
                'pages' => array(
                    array(
                        'label' => 'All Pages',
                        'route' => 'page',
                        'action' => 'index',
                        'class' => 'all-page',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    ),
                    array(
                        'label' => 'Add New',
                        'route' => 'page',
                        'action' => 'add',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    )
                )
            ),
            array(
                'label' => 'Comments',
                'route' => 'post/post_comment',
                'action' => 'index',
                'id' => 'menu-icon fa fa-comments',
                'pages' => array()
            ),
            array(
                'label' => 'Users',
                'route' => 'user',
                'action' => 'index',
                'id' => 'menu-icon fa fa-users',
                'pages' => array(
                    array(
                        'label' => 'All User',
                        'route' => 'user',
                        'action' => 'index',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    ),
                    array(
                        'label' => 'Add New',
                        'route' => 'user/add',
                        'action' => 'add',
                        'id' => 'menu-icon fa fa-angle-double-right'
                    )
                )
            )
        );
    }

}
