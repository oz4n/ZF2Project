<?php

/**
 * This file is part of the Fightmaster/dao library.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace ORM\GeneralDAO;

use UnexpectedValueException;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectRepository;
use ORM\GeneralDAO\GDAOException\InvalidArgumentException;
use ORM\GeneralDAO\GDAOInterface\DAOManagerInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Doctrine Manager implementation which can be used as base class for your concrete manager (ORM or ODM, or another)
 * 
 * @property EntityManager $entityManager Doctrine EntityManager
 * @property ObjectRepository $objectRepository Doctrine ObjectRepository
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
class DAOManager implements DAOManagerInterface, ServiceLocatorAwareInterface
{

    const ASC = 'ASC';
    const DESC = 'DESC';

    /**
     *
     * @var type 
     */
    protected $services;

    /**
     *
     * @var string
     */
    public $class;

    /**
     *
     * @param string $class            
     */
    public function __construct($service, $class)
    {
        $this->setServiceLocator($service);
        $this->class = $this->getEntityManager()->getClassMetadata($class)->getName();
    }

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
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * Returns fully qualified class name of the object.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     *     
     * @return Doctrine\Common\Persistence\ObjectRepository
     */
    public function getObjectRepository()
    {
        return $this->getEntityManager()->getRepository($this->getClass());
    }

    /**
     * 
     * @param type $condition
     * @param type $params
     * @param type $offset
     * @param type $limit
     * @return @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder($condition = null, $params = array(), $offset = null, $limit = null)
    {
        $dql = $this->getEntityManager()->createQueryBuilder();
        $dql->select('t')->from($this->getClass(), 't');
        if (null !== $condition) {
            $dql->where($condition);
        }
        if (null !== $limit) {
            $dql->setMaxResults($limit);
        }

        if (null !== $offset) {
            $dql->setFirstResult($offset);
        }
        if (null != $params) {
            if (isset($params['orderBy']) || null !== $params['orderBy']) {
                $dql->orderBy($params['orderBy']['entity'], isset($params['orderBy']['sort']) ? $params['orderBy']['sort'] : self::ASC );
            }
        }
        return $dql;
    }

    /**
     * Creates an empty object instance.
     *
     * @return object
     */
    public function create()
    {
        $class = $this->getClass();

        return new $class();
    }

    /**
     * Saves the object
     *
     * @param Object $object            
     * @param bool $flush            
     * @throws InvalidArgumentException
     */
    public function save($object, $flush = true)
    {
        $this->isExpectedObject($object);
        $this->getEntityManager()->persist($object);
        if ($flush) {
            $this->flush();
        }
    }

    /**
     * Removes the object
     *
     * @param Object $object            
     * @param bool $flush            
     * @throws InvalidArgumentException
     */
    public function remove($object, $flush = true)
    {
        $this->isExpectedObject($object);
        $this->getEntityManager()->remove($object);
        if ($flush) {
            $this->flush();
        }
    }

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param
     *            $id
     * @return object
     */
    public function findByPk($id)
    {
        return $this->getQueryBuilder('t.id=' . $id);
    }

    public function findAllByPk($id)
    {
        
    }
    
    public function findByFk($id)
    {
        
    }
    
    public function findAllByFk($id)
    {
        
    }

    public function find()
    {
        
    }

    /**
     * Finds all objects in the repository.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAll($condition = null, $params = array())
    {
        return $this->getQueryBuilder($condition, $params);
    }

    public function findByEntity()
    {
        
    }

    public function findAllByEntity()
    {
        
    }

    /**
     * Finds a single object by a set of criteria.
     *
     * @param array $criteria            
     * @return object
     */
    public function findOneBy(array $criteria)
    {
        return $this->getObjectRepository()->findOneBy($criteria);
    }

    /**
     * Optionally sorting and limiting details can be passed.
     * An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array $criteria            
     * @param array|null $orderBy            
     * @param null $limit            
     * @param null $offset            
     * @return Object[]
     * @throws UnexpectedValueException
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getObjectRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * Checks entity
     *
     * @param
     *            $object
     * @return bool
     * @throws InvalidArgumentException
     */
    private function isExpectedObject($object)
    {
        $className = $this->getClass();
        if (!is_object($object) || !$object instanceof $className) {
            throw new InvalidArgumentException();
        }

        return true;
    }

}
