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
 * @version    $Id: Empty.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search\Query;

use Search\Search\Query;
use Search\Lucene\LuceneInterface;
use Search\Search\Weight\WeightEmpty;
use Search\Search\Highlighter\HighlighterInterface;

/**
 * @category   Zend
 * @package    Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class QueryEmpty extends Query
{

    /**
     * Re-write query into primitive queries in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    public function rewrite(LuceneInterface $index)
    {
        return $this;
    }

    /**
     * Optimize query in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    public function optimize(LuceneInterface $index)
    {
        // "Empty" query is a primitive query and don't need to be optimized
        return $this;
    }

    /**
     * Constructs an appropriate Weight implementation for this query.
     *
     * @param LuceneInterface $reader
     * @return \Search\Search\Weight
     */
    public function createWeight(LuceneInterface $reader)
    {
        return new WeightEmpty();
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
        // Do nothing
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
        return array();
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
        return 0;
    }

    /**
     * Return query terms
     *
     * @return array
     */
    public function getQueryTerms()
    {
        return array();
    }

    /**
     * Query specific matches highlighting
     *
     * @param HighlighterInterface $highlighter  Highlighter object (also contains doc for highlighting)
     */
    protected function _highlightMatches(HighlighterInterface $highlighter)
    {
        // Do nothing
    }

    /**
     * Print a query
     *
     * @return string
     */
    public function __toString()
    {
        return '<EmptyQuery>';
    }

}
