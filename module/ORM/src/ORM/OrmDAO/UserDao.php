<?php
namespace ORM\OrmDAO;

use ORM\GeneralDAO\DAOManager;
class UserDao extends DAOManager
{
    /**
     * 
     * @param Doctrine\ORM\EntityManager $objectManager
     * @param string $class
     */
    public function __construct($objectManager, $class)
    {
    	parent::__construct($objectManager, $class);
    }
}
