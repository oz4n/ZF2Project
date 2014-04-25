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
 * @version    $Id: Term.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search\Query;

use Search\Search\Query;
use Search\Index\Term as IndexTerm;
use Search\Lucene\LuceneInterface;
use Search\Search\Query\QueryEmpty;
use Search\Search\Query\MultiTerm;
use Search\Search\Weight\Term as WeightTerm;
use Search\Search\Highlighter\HighlighterInterface;

/**
 * @category   Zend
 * @package    Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Term extends Query
{

    /**
     * Term to find.
     *
     * @var Term
     */
    private $_term;

    /**
     * Documents vector.
     *
     * @var array
     */
    private $_docVector = null;

    /**
     * Term freqs vector.
     * array(docId => freq, ...)
     *
     * @var array
     */
    private $_termFreqs;

    /**
     * Query Term constructor
     *
     * @param Term $term
     * @param boolean $sign
     */
    public function __construct(IndexTerm $term)
    {
        $this->_term = $term;
    }

    /**
     * Re-write query into primitive queries in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    public function rewrite(LuceneInterface $index)
    {
        if ($this->_term->field != null) {
            return $this;
        } else {
            
            $query = new MultiTerm();
            $query->setBoost($this->getBoost());

            
            foreach ($index->getFieldNames(true) as $fieldName) {
                $term = new IndexTerm($this->_term->text, $fieldName);

                $query->addTerm($term);
            }

            return $query->rewrite($index);
        }
    }

    /**
     * Optimize query in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    public function optimize(LuceneInterface $index)
    {
        // Check, that index contains specified term
        if (!$index->hasTerm($this->_term)) {
            
            return new QueryEmpty();
        }

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
        
        $this->_weight = new WeightTerm($this->_term, $this, $reader);
        return $this->_weight;
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
        $this->_docVector = array_flip($reader->termDocs($this->_term, $docsFilter));
        $this->_termFreqs = $reader->termFreqs($this->_term, $docsFilter);

        // Initialize weight if it's not done yet
        $this->_initWeight($reader);
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
        return $this->_docVector;
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
        if (isset($this->_docVector[$docId])) {
            return $reader->getSimilarity()->tf($this->_termFreqs[$docId]) *
                    $this->_weight->getValue() *
                    $reader->norm($docId, $this->_term->field) *
                    $this->getBoost();
        } else {
            return 0;
        }
    }

    /**
     * Return query terms
     *
     * @return array
     */
    public function getQueryTerms()
    {
        return array($this->_term);
    }

    /**
     * Return query term
     *
     * @return Term
     */
    public function getTerm()
    {
        return $this->_term;
    }

    /**
     * Query specific matches highlighting
     *
     * @param HighlighterInterface $highlighter  Highlighter object (also contains doc for highlighting)
     */
    protected function _highlightMatches(HighlighterInterface $highlighter)
    {
        $highlighter->highlight($this->_term->text);
    }

    /**
     * Print a query
     *
     * @return string
     */
    public function __toString()
    {
        // It's used only for query visualisation, so we don't care about characters escaping
        if ($this->_term->field !== null) {
            $query = $this->_term->field . ':';
        } else {
            $query = '';
        }

        $query .= $this->_term->text;

        if ($this->getBoost() != 1) {
            $query = $query . '^' . round($this->getBoost(), 4);
        }

        return $query;
    }

}
