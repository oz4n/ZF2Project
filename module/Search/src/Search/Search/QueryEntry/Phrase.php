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
 * @version    $Id: Phrase.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Search\QueryEntry;

use Search\Search\QueryEntry;
use Search\Search\Query\Preprocessing\Phrase as PreprocessingPhrase;

/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Phrase extends QueryEntry
{

    /**
     * Phrase value
     *
     * @var string
     */
    private $_phrase;

    /**
     * Field
     *
     * @var string|null
     */
    private $_field;

    /**
     * Proximity phrase query
     *
     * @var boolean
     */
    private $_proximityQuery = false;

    /**
     * Words distance, used for proximiti queries
     *
     * @var integer
     */
    private $_wordsDistance = 0;

    /**
     * Object constractor
     *
     * @param string $phrase
     * @param string $field
     */
    public function __construct($phrase, $field)
    {
        $this->_phrase = $phrase;
        $this->_field = $field;
    }

    /**
     * Process modifier ('~')
     *
     * @param mixed $parameter
     */
    public function processFuzzyProximityModifier($parameter = null)
    {
        $this->_proximityQuery = true;

        if ($parameter !== null) {
            $this->_wordsDistance = $parameter;
        }
    }

    /**
     * Transform entry to a subquery
     *
     * @param string $encoding
     * @return \Search\Search\Query
     * @throws \Search\Lucene\Exception
     */
    public function getQuery($encoding)
    {
        
        $query = new PreprocessingPhrase($this->_phrase, $encoding, ($this->_field !== null) ? iconv($encoding, 'UTF-8', $this->_field) : null);

        if ($this->_proximityQuery) {
            $query->setSlop($this->_wordsDistance);
        }

        $query->setBoost($this->_boost);

        return $query;
    }

}
