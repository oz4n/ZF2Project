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
 * @version    $Id: ShortWords.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Analysis\TokenFilter;

use Search\Analysis\TokenFilter;
use Search\Analysis\Token;
/**
 * Token filter that removes short words. What is short word can be configured with constructor.
 *
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage Analysis
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ShortWords extends TokenFilter
{

    /**
     * Minimum allowed term length
     * @var integer
     */
    private $length;

    /**
     * Constructs new instance of this filter.
     *
     * @param integer $short  minimum allowed length of term which passes this filter (default 2)
     */
    public function __construct($length = 2)
    {
        $this->length = $length;
    }

    /**
     * Normalize Token or remove it (if null is returned)
     *
     * @param Token $srcToken
     * @return Token
     */
    public function normalize(Token $srcToken)
    {
        if (strlen($srcToken->getTermText()) < $this->length) {
            return null;
        } else {
            return $srcToken;
        }
    }

}
