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
 * @version    $Id: QueryHit.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search;

use Search\Lucene\LuceneInterface;
use Search\Lucene\Document;
use Search\Lucene\Proxy;

/**
 * @category   Zend
 * @package    Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class QueryHit
{

    /**
     * Object handle of the index
     * @var LuceneInterface
     */
    protected $_index = null;

    /**
     * Object handle of the document associated with this hit
     * @var Document
     */
    protected $_document = null;

    /**
     * Number of the document in the index
     * @var integer
     */
    public $id;

    /**
     * Score of the hit
     * @var float
     */
    public $score;

    /**
     * Constructor - pass object handle of Zend_Search_Lucene_Interface index that produced
     * the hit so the document can be retrieved easily from the hit.
     *
     * @param LuceneInterface $index
     */
    public function __construct(LuceneInterface $index)
    {

        $this->_index = new Proxy($index);
    }

    /**
     * Convenience function for getting fields from the document
     * associated with this hit.
     *
     * @param string $offset
     * @return string
     */
    public function __get($offset)
    {
        return $this->getDocument()->getFieldValue($offset);
    }

    /**
     * Return the document object for this hit
     *
     * @return Document
     */
    public function getDocument()
    {
        if (!$this->_document instanceof Document) {
            $this->_document = $this->_index->getDocument($this->id);
        }

        return $this->_document;
    }

    /**
     * Return the index object for this hit
     *
     * @return LuceneInterface
     */
    public function getIndex()
    {
        return $this->_index;
    }

}
