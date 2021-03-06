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
 * @version    $Id: Query.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search;

use Search\Lucene\LuceneInterface;
use Search\Document\Html;
use Search\Search\Highlighter\HighlighterDefault;
use Search\Search\Highlighter\HighlighterInterface;

/**
 * @category   Zend
 * @package    Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Query
{

    /**
     * query boost factor
     *
     * @var float
     */
    private $_boost = 1;

    /**
     * Query weight
     *
     * @var Weight
     */
    protected $_weight = null;

    /**
     * Current highlight color
     *
     * @var integer
     */
    private $_currentColorIndex = 0;

    /**
     * Gets the boost for this clause.  Documents matching
     * this clause will (in addition to the normal weightings) have their score
     * multiplied by boost.   The boost is 1.0 by default.
     *
     * @return float
     */
    public function getBoost()
    {
        return $this->_boost;
    }

    /**
     * Sets the boost for this query clause to $boost.
     *
     * @param float $boost
     */
    public function setBoost($boost)
    {
        $this->_boost = $boost;
    }

    /**
     * Score specified document
     *
     * @param integer $docId
     * @param LuceneInterface $reader
     * @return float
     */
    abstract public function score($docId, LuceneInterface $reader);

    /**
     * Get document ids likely matching the query
     *
     * It's an array with document ids as keys (performance considerations)
     *
     * @return array
     */
    abstract public function matchedDocs();

    /**
     * Execute query in context of index reader
     * It also initializes necessary internal structures
     *
     * Query specific implementation
     *
     * @param LuceneInterface $reader
     * @param \Search\Index\DocsFilter|null $docsFilter
     */
    abstract public function execute(LuceneInterface $reader, $docsFilter = null);

    /**
     * Constructs an appropriate Weight implementation for this query.
     *
     * @param LuceneInterface $reader
     * @return Weight
     */
    abstract public function createWeight(LuceneInterface $reader);

    /**
     * Constructs an initializes a Weight for a _top-level_query_.
     *
     * @param LuceneInterface $reader
     */
    protected function _initWeight(LuceneInterface $reader)
    {
        // Check, that it's a top-level query and query weight is not initialized yet.
        if ($this->_weight !== null) {
            return $this->_weight;
        }

        $this->createWeight($reader);
        $sum = $this->_weight->sumOfSquaredWeights();
        $queryNorm = $reader->getSimilarity()->queryNorm($sum);
        $this->_weight->normalize($queryNorm);
    }

    /**
     * Re-write query into primitive queries in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    abstract public function rewrite(LuceneInterface $index);

    /**
     * Optimize query in the context of specified index
     *
     * @param LuceneInterface $index
     * @return Query
     */
    abstract public function optimize(LuceneInterface $index);

    /**
     * Reset query, so it can be reused within other queries or
     * with other indeces
     */
    public function reset()
    {
        $this->_weight = null;
    }

    /**
     * Print a query
     *
     * @return string
     */
    abstract public function __toString();

    /**
     * Return query terms
     *
     * @return array
     */
    abstract public function getQueryTerms();

    /**
     * Query specific matches highlighting
     *
     * @param HighlighterInterface $highlighter  Highlighter object (also contains doc for highlighting)
     */
    abstract protected function _highlightMatches(HighlighterInterface $highlighter);

    /**
     * Highlight matches in $inputHTML
     *
     * @param string $inputHTML
     * @param string  $defaultEncoding   HTML encoding, is used if it's not specified using Content-type HTTP-EQUIV meta tag.
     * @param HighlighterInterface|null $highlighter
     * @return string
     */
    public function highlightMatches($inputHTML, $defaultEncoding = '', $highlighter = null)
    {
        if ($highlighter === null) {
            $highlighter = new HighlighterDefault();
        }
        $doc = Html::loadHTML($inputHTML, false, $defaultEncoding);
        $highlighter->setDocument($doc);

        $this->_highlightMatches($highlighter);

        return $doc->getHTML();
    }

    /**
     * Highlight matches in $inputHtmlFragment and return it (without HTML header and body tag)
     *
     * @param string $inputHtmlFragment
     * @param string  $encoding   Input HTML string encoding
     * @param HighlighterInterface|null $highlighter
     * @return string
     */
    public function htmlFragmentHighlightMatches($inputHtmlFragment, $encoding = 'UTF-8', $highlighter = null)
    {
        if ($highlighter === null) {            
            $highlighter = new HighlighterDefault();
        }

        $inputHTML = '<html><head><META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8"/></head><body>'
                . iconv($encoding, 'UTF-8//IGNORE', $inputHtmlFragment) . '</body></html>';

        $doc = Html::loadHTML($inputHTML);
        $highlighter->setDocument($doc);

        $this->_highlightMatches($highlighter);

        return $doc->getHtmlBody();
    }

}
