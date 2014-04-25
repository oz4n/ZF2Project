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
 * @subpackage Analysis
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Common.php 24847 2012-05-31 19:19:28Z rob $
 */
/** Define constant used to provide correct file processing order    */
/** @todo Section should be removed with ZF 2.0 release as obsolete  */
//if (!defined('ZEND_SEARCH_LUCENE_COMMON_ANALYZER_PROCESSED')) {
//    define('ZEND_SEARCH_LUCENE_COMMON_ANALYZER_PROCESSED', true);
//}

namespace Search\Analysis\Analyzer;

use Search\Analysis\Analyzer;
use Search\Analysis\Token;
use Search\Analysis\TokenFilter;

/**
 * Common implementation of the Zend_Search_Lucene_Analysis_Analyzer interface.
 * There are several standard standard subclasses provided by Zend_Search_Lucene/Analysis
 * subpackage: Zend_Search_Lucene_Analysis_Analyzer_Common_Text, ZSearchHTMLAnalyzer, ZSearchXMLAnalyzer.
 *
 * @todo ZSearchHTMLAnalyzer and ZSearchXMLAnalyzer implementation
 *
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage Analysis
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Common extends Analyzer
{

    /**
     * The set of Token filters applied to the Token stream.
     * Array of TokenFilter objects.
     *
     * @var array
     */
    private $_filters = array();

    /**
     * Add Token filter to the Analyzer
     *
     * @param TokenFilter $filter
     */
    public function addFilter(TokenFilter $filter)
    {
        $this->_filters[] = $filter;
    }

    /**
     * Apply filters to the token. Can return null when the token was removed.
     *
     * @param Token $token
     * @return Token
     */
    public function normalize(Token $token)
    {
        foreach ($this->_filters as $filter) {
            $token = $filter->normalize($token);

            // resulting token can be null if the filter removes it
            if ($token === null) {
                return null;
            }
        }

        return $token;
    }

}
