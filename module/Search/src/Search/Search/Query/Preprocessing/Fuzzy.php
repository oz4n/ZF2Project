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
 * @version    $Id: Fuzzy.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search\Query\Preprocessing;

use Search\Search\Query\Preprocessing;
use Search\Search\Query\Fuzzy as QueryFuzzy;
use Search\Search\Query\Boolean;
use Search\Search\Query\Insignificant;
use Search\Search\Query\QueryEmpty;
use Search\Lucene\Exception;
use Search\Index\Term;
use Search\Lucene\Lucene;
use Search\Lucene\LuceneInterface;
use Search\Search\Highlighter\HighlighterInterface;
use Search\Analysis\Analyzer;

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
class Fuzzy extends Preprocessing
{

    /**
     * word (query parser lexeme) to find.
     *
     * @var string
     */
    private $_word;

    /**
     * Word encoding (field name is always provided using UTF-8 encoding since it may be retrieved from index).
     *
     * @var string
     */
    private $_encoding;

    /**
     * Field name.
     *
     * @var string
     */
    private $_field;

    /**
     * A value between 0 and 1 to set the required similarity
     *  between the query term and the matching terms. For example, for a
     *  _minimumSimilarity of 0.5 a term of the same length
     *  as the query term is considered similar to the query term if the edit distance
     *  between both terms is less than length(term)*0.5
     *
     * @var float
     */
    private $_minimumSimilarity;

    /**
     * Class constructor.  Create a new preprocessing object for prase query.
     *
     * @param string $word       Non-tokenized word (query parser lexeme) to search.
     * @param string $encoding   Word encoding.
     * @param string $fieldName  Field name.
     * @param float  $minimumSimilarity minimum similarity
     */
    public function __construct($word, $encoding, $fieldName, $minimumSimilarity)
    {
        $this->_word = $word;
        $this->_encoding = $encoding;
        $this->_field = $fieldName;
        $this->_minimumSimilarity = $minimumSimilarity;
    }

    /**
     * Re-write query into primitive queries in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    public function rewrite(LuceneInterface $index)
    {
        if ($this->_field === null) {

            $query = new Boolean();

            $hasInsignificantSubqueries = false;
            if (Lucene::getDefaultSearchField() === null) {
                $searchFields = $index->getFieldNames(true);
            } else {
                $searchFields = array(Lucene::getDefaultSearchField());
            }


            foreach ($searchFields as $fieldName) {
                $subquery = new Fuzzy($this->_word, $this->_encoding, $fieldName, $this->_minimumSimilarity);

                $rewrittenSubquery = $subquery->rewrite($index);

                if (!($rewrittenSubquery instanceof Insignificant ||
                        $rewrittenSubquery instanceof QueryEmpty)) {
                    $query->addSubquery($rewrittenSubquery);
                }

                if ($rewrittenSubquery instanceof Insignificant) {
                    $hasInsignificantSubqueries = true;
                }
            }

            $subqueries = $query->getSubqueries();

            if (count($subqueries) == 0) {
                $this->_matches = array();
                if ($hasInsignificantSubqueries) {
                    return new Insignificant();
                } else {
                    return new QueryEmpty();
                }
            }

            if (count($subqueries) == 1) {
                $query = reset($subqueries);
            }

            $query->setBoost($this->getBoost());

            $this->_matches = $query->getQueryTerms();
            return $query;
        }

        // -------------------------------------
        // Recognize exact term matching (it corresponds to Keyword fields stored in the index)
        // encoding is not used since we expect binary matching

        $term = new Term($this->_word, $this->_field);
        if ($index->hasTerm($term)) {
            $query = new QueryFuzzy($term, $this->_minimumSimilarity);
            $query->setBoost($this->getBoost());

            // Get rewritten query. Important! It also fills terms matching container.
            $rewrittenQuery = $query->rewrite($index);
            $this->_matches = $query->getQueryTerms();

            return $rewrittenQuery;
        }


        // -------------------------------------
        // Recognize wildcard queries

        /** @todo check for PCRE unicode support may be performed through Zend_Environment in some future */
        if (@preg_match('/\pL/u', 'a') == 1) {
            $subPatterns = preg_split('/[*?]/u', iconv($this->_encoding, 'UTF-8', $this->_word));
        } else {
            $subPatterns = preg_split('/[*?]/', $this->_word);
        }
        if (count($subPatterns) > 1) {

            throw new Exception('Fuzzy search doesn\'t support wildcards (except within Keyword fields).');
        }


        // -------------------------------------
        // Recognize one-term multi-term and "insignificant" queries

        $tokens = Analyzer::getDefault()->tokenize($this->_word, $this->_encoding);

        if (count($tokens) == 0) {
            $this->_matches = array();

            return new Insignificant();
        }

        if (count($tokens) == 1) {

            $term = new Term($tokens[0]->getTermText(), $this->_field);

            $query = new QueryFuzzy($term, $this->_minimumSimilarity);
            $query->setBoost($this->getBoost());

            // Get rewritten query. Important! It also fills terms matching container.
            $rewrittenQuery = $query->rewrite($index);
            $this->_matches = $query->getQueryTerms();

            return $rewrittenQuery;
        }

        // Word is tokenized into several tokens

        throw new Exception('Fuzzy search is supported only for non-multiple word terms');
    }

    /**
     * Query specific matches highlighting
     *
     * @param HighlighterInterface $highlighter  Highlighter object (also contains doc for highlighting)
     */
    protected function _highlightMatches(HighlighterInterface $highlighter)
    {
        /** Skip fields detection. We don't need it, since we expect all fields presented in the HTML body and don't differentiate them */
        /** Skip exact term matching recognition, keyword fields highlighting is not supported */
        // -------------------------------------
        // Recognize wildcard queries

        /** @todo check for PCRE unicode support may be performed through Zend_Environment in some future */
        if (@preg_match('/\pL/u', 'a') == 1) {
            $subPatterns = preg_split('/[*?]/u', iconv($this->_encoding, 'UTF-8', $this->_word));
        } else {
            $subPatterns = preg_split('/[*?]/', $this->_word);
        }
        if (count($subPatterns) > 1) {
            // Do nothing
            return;
        }


        // -------------------------------------
        // Recognize one-term multi-term and "insignificant" queries

        $tokens = Analyzer::getDefault()->tokenize($this->_word, $this->_encoding);
        if (count($tokens) == 0) {
            // Do nothing
            return;
        }
        if (count($tokens) == 1) {

            $term = new Term($tokens[0]->getTermText(), $this->_field);

            $query = new QueryFuzzy($term, $this->_minimumSimilarity);

            $query->_highlightMatches($highlighter);
            return;
        }

        // Word is tokenized into several tokens
        // But fuzzy search is supported only for non-multiple word terms
        // Do nothing
    }

    /**
     * Print a query
     *
     * @return string
     */
    public function __toString()
    {
        // It's used only for query visualisation, so we don't care about characters escaping
        if ($this->_field !== null) {
            $query = $this->_field . ':';
        } else {
            $query = '';
        }

        $query .= $this->_word;

        if ($this->getBoost() != 1) {
            $query .= '^' . round($this->getBoost(), 4);
        }

        return $query;
    }

}
