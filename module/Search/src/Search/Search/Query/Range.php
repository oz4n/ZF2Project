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
 * @version    $Id: Range.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search\Query;

use Search\Search\Query;
use Search\Lucene\Exception;
use Search\Index\Term;
use Search\Lucene\Lucene;
use Search\Lucene\LuceneInterface;
use Search\Search\Query\QueryEmpty;
use Search\Search\Query\Term as QueryTerm;
use Search\Search\Query\MultiTerm;
use Search\Search\Highlighter\HighlighterInterface;
use Search\Analysis\Analyzer;

/**
 * @category   Zend
 * @package    Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Range extends Query
{

    /**
     * Lower term.
     *
     * @var Term
     */
    private $_lowerTerm;

    /**
     * Upper term.
     *
     * @var Term
     */
    private $_upperTerm;

    /**
     * Search field
     *
     * @var string
     */
    private $_field;

    /**
     * Inclusive
     *
     * @var boolean
     */
    private $_inclusive;

    /**
     * Matched terms.
     *
     * Matched terms list.
     * It's filled during the search (rewrite operation) and may be used for search result
     * post-processing
     *
     * Array of Term objects
     *
     * @var array
     */
    private $_matches = null;

    /**
     * Query Range constructor.
     *
     * @param Term|null $lowerTerm
     * @param Term|null $upperTerm
     * @param boolean $inclusive
     * @throws Exception
     */
    public function __construct($lowerTerm, $upperTerm, $inclusive)
    {
        if ($lowerTerm === null && $upperTerm === null) {

            throw new Exception('At least one term must be non-null');
        }
        if ($lowerTerm !== null && $upperTerm !== null && $lowerTerm->field != $upperTerm->field) {

            throw new Exception('Both terms must be for the same field');
        }

        $this->_field = ($lowerTerm !== null) ? $lowerTerm->field : $upperTerm->field;
        $this->_lowerTerm = $lowerTerm;
        $this->_upperTerm = $upperTerm;
        $this->_inclusive = $inclusive;
    }

    /**
     * Get query field name
     *
     * @return string|null
     */
    public function getField()
    {
        return $this->_field;
    }

    /**
     * Get lower term
     *
     * @return Term|null
     */
    public function getLowerTerm()
    {
        return $this->_lowerTerm;
    }

    /**
     * Get upper term
     *
     * @return Term|null
     */
    public function getUpperTerm()
    {
        return $this->_upperTerm;
    }

    /**
     * Get upper term
     *
     * @return boolean
     */
    public function isInclusive()
    {
        return $this->_inclusive;
    }

    /**
     * Re-write query into primitive queries in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    public function rewrite(LuceneInterface $index)
    {
        $this->_matches = array();

        if ($this->_field === null) {
            // Search through all fields
            $fields = $index->getFieldNames(true /* indexed fields list */);
        } else {
            $fields = array($this->_field);
        }


        $maxTerms = Lucene::getTermsPerQueryLimit();
        foreach ($fields as $field) {
            $index->resetTermsStream();
            if ($this->_lowerTerm !== null) {
                $lowerTerm = new Term($this->_lowerTerm->text, $field);

                $index->skipTo($lowerTerm);

                if (!$this->_inclusive &&
                        $index->currentTerm() == $lowerTerm) {
                    // Skip lower term
                    $index->nextTerm();
                }
            } else {
                $index->skipTo(new Term('', $field));
            }


            if ($this->_upperTerm !== null) {
                // Walk up to the upper term
                $upperTerm = new Term($this->_upperTerm->text, $field);

                while ($index->currentTerm() !== null &&
                $index->currentTerm()->field == $field &&
                strcmp($index->currentTerm()->text, $upperTerm->text) < 0) {
                    $this->_matches[] = $index->currentTerm();

                    if ($maxTerms != 0 && count($this->_matches) > $maxTerms) {

                        throw new Exception('Terms per query limit is reached.');
                    }

                    $index->nextTerm();
                }

                if ($this->_inclusive && $index->currentTerm() == $upperTerm) {
                    // Include upper term into result
                    $this->_matches[] = $upperTerm;
                }
            } else {
                // Walk up to the end of field data
                while ($index->currentTerm() !== null && $index->currentTerm()->field == $field) {
                    $this->_matches[] = $index->currentTerm();

                    if ($maxTerms != 0 && count($this->_matches) > $maxTerms) {

                        throw new Exception('Terms per query limit is reached.');
                    }

                    $index->nextTerm();
                }
            }

            $index->closeTermsStream();
        }

        if (count($this->_matches) == 0) {
            return new QueryEmpty();
        } else if (count($this->_matches) == 1) {
            return new QueryTerm(reset($this->_matches));
        } else {
            $rewrittenQuery = new MultiTerm();

            foreach ($this->_matches as $matchedTerm) {
                $rewrittenQuery->addTerm($matchedTerm);
            }

            return $rewrittenQuery;
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
        throw new Exception('Range query should not be directly used for search. Use $query->rewrite($index)');
    }

    /**
     * Return query terms
     *
     * @return array
     * @throws Exception
     */
    public function getQueryTerms()
    {
        if ($this->_matches === null) {

            throw new Exception('Search or rewrite operations have to be performed before.');
        }

        return $this->_matches;
    }

    /**
     * Constructs an appropriate Weight implementation for this query.
     *
     * @param LuceneInterface $reader
     * @return \Search\Search\Weight
     * @throws Exception
     */
    public function createWeight(LuceneInterface $reader)
    {

        throw new Exception('Range query should not be directly used for search. Use $query->rewrite($index)');
    }

    /**
     * Execute query in context of index reader
     * It also initializes necessary internal structures
     *
     * @param LuceneInterface $reader
     * @param \Search\Index\DocsFilter|null $docsFilter
     * @throws Exception
     */
    public function execute(LuceneInterface $reader, $docsFilter = null)
    {

        throw new Exception('Range query should not be directly used for search. Use $query->rewrite($index)');
    }

    /**
     * Get document ids likely matching the query
     *
     * It's an array with document ids as keys (performance considerations)
     *
     * @return array
     * @throws Exception
     */
    public function matchedDocs()
    {

        throw new Exception('Range query should not be directly used for search. Use $query->rewrite($index)');
    }

    /**
     * Score specified document
     *
     * @param integer $docId
     * @param LuceneInterface $reader
     * @return float
     * @throws Exception
     */
    public function score($docId, LuceneInterface $reader)
    {

        throw new Exception('Range query should not be directly used for search. Use $query->rewrite($index)');
    }

    /**
     * Query specific matches highlighting
     *
     * @param HighlighterInterface $highlighter  Highlighter object (also contains doc for highlighting)
     */
    protected function _highlightMatches(HighlighterInterface $highlighter)
    {
        $words = array();

        $docBody = $highlighter->getDocument()->getFieldUtf8Value('body');
        $tokens = Analyzer::getDefault()->tokenize($docBody, 'UTF-8');

        $lowerTermText = ($this->_lowerTerm !== null) ? $this->_lowerTerm->text : null;
        $upperTermText = ($this->_upperTerm !== null) ? $this->_upperTerm->text : null;

        if ($this->_inclusive) {
            foreach ($tokens as $token) {
                $termText = $token->getTermText();
                if (($lowerTermText == null || $lowerTermText <= $termText) &&
                        ($upperTermText == null || $termText <= $upperTermText)) {
                    $words[] = $termText;
                }
            }
        } else {
            foreach ($tokens as $token) {
                $termText = $token->getTermText();
                if (($lowerTermText == null || $lowerTermText < $termText) &&
                        ($upperTermText == null || $termText < $upperTermText)) {
                    $words[] = $termText;
                }
            }
        }

        $highlighter->highlight($words);
    }

    /**
     * Print a query
     *
     * @return string
     */
    public function __toString()
    {
        // It's used only for query visualisation, so we don't care about characters escaping
        return (($this->_field === null) ? '' : $this->_field . ':')
                . (($this->_inclusive) ? '[' : '{')
                . (($this->_lowerTerm !== null) ? $this->_lowerTerm->text : 'null')
                . ' TO '
                . (($this->_upperTerm !== null) ? $this->_upperTerm->text : 'null')
                . (($this->_inclusive) ? ']' : '}')
                . (($this->getBoost() != 1) ? '^' . round($this->getBoost(), 4) : '');
    }

}
