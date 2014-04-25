<?php

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Subquery.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search\QueryEntry;

use Search\Search\QueryEntry;
use Search\Lucene\Exception;
use Search\Search\Query;

/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Subquery extends QueryEntry
{

    /**
     * Query
     *
     * @var Zend_Search_Lucene_Search_Query
     */
    private $_query;

    /**
     * Object constractor
     *
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->_query = $query;
    }

    /**
     * Process modifier ('~')
     *
     * @param mixed $parameter
     * @throws Exception
     */
    public function processFuzzyProximityModifier($parameter = null)
    {

        throw new Exception('\'~\' sign must follow term or phrase');
    }

    /**
     * Transform entry to a subquery
     *
     * @param string $encoding
     * @return Query
     */
    public function getQuery($encoding)
    {
        $this->_query->setBoost($this->_boost);

        return $this->_query;
    }

}
