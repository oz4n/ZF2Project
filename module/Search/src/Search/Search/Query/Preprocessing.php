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
 * @package    Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Preprocessing.php 24593 2012-01-05 20:35:02Z matthew $
 */


namespace Search\Search\Query;

use Search\Search\Query;
use Search\Lucene\Exception;
use Search\Lucene\LuceneInterface;

/**
 * It's an internal abstract class intended to finalize ase a query processing after query parsing.
 * This type of query is not actually involved into query execution.
 *
 * @category   Zend
 * @package    Lucene
 * @subpackage Search
 * @internal
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Preprocessing extends Query
{
    /**
     * Matched terms.
     *
     * Matched terms list.
     * It's filled during rewrite operation and may be used for search result highlighting
     *
     * Array of Index Term objects
     *
     * @var array
     */
    protected $_matches = null;

    /**
     * Optimize query in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    public function optimize(LuceneInterface $index)
    {
        
        throw new Exception('This query is not intended to be executed.');
    }

    /**
     * Constructs an appropriate Weight implementation for this query.
     *
     * @param LuceneInterface $reader
     * @return \Search\Search\Weight
     */
    public function createWeight(LuceneInterface $reader)
    {
        
        throw new Exception('This query is not intended to be executed.');
    }

    /**
     * Execute query in context of index reader
     * It also initializes necessary internal structures
     *
     * @param LuceneInterface $reader
     * @param \Search\Index\DocsFilter|null $docsFilter
     */
    public function execute(LuceneInterface $reader, $docsFilter = null)
    {
        
        throw new Exception('This query is not intended to be executed.');
    }

    /**
     * Get document ids likely matching the query
     *
     * It's an array with document ids as keys (performance considerations)
     *
     * @return array
     */
    public function matchedDocs()
    {
        
        throw new Exception('This query is not intended to be executed.');
    }

    /**
     * Score specified document
     *
     * @param integer $docId
     * @param LuceneInterface $reader
     * @return float
     */
    public function score($docId, LuceneInterface $reader)
    {
        
        throw new Exception('This query is not intended to be executed.');
    }

    /**
     * Return query terms
     *
     * @return array
     */
    public function getQueryTerms()
    {
        
        throw new Exception('Rewrite operation has to be done before retrieving query terms.');
    }
}

