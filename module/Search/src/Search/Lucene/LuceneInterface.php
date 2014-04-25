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
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Interface.php 24593 2012-01-05 20:35:02Z matthew $
 */

namespace Search\Lucene;

use Search\Index\TermsStream\IndexInterface;
use Search\Index\Term;
use Search\Index\DocsFilter;
use Search\Storage\Directory;
use Search\Lucene\Document;

/**
 * @category   Zend
 * @package    Lucene
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface LuceneInterface extends IndexInterface
{

    /**
     * Get current generation number
     *
     * Returns generation number
     * 0 means pre-2.1 index format
     * -1 means there are no segments files.
     *
     * @param Directory $directory
     * @return integer
     * @throws Exception
     */
    public static function getActualGeneration(Directory $directory);

    /**
     * Get segments file name
     *
     * @param integer $generation
     * @return string
     */
    public static function getSegmentFileName($generation);

    /**
     * Get index format version
     *
     * @return integer
     */
    public function getFormatVersion();

    /**
     * Set index format version.
     * Index is converted to this format at the nearest upfdate time
     *
     * @param int $formatVersion
     * @throws Exception
     */
    public function setFormatVersion($formatVersion);

    /**
     * Returns the Directory instance for this index.
     *
     * @return Directory
     */
    public function getDirectory();

    /**
     * Returns the total number of documents in this index (including deleted documents).
     *
     * @return integer
     */
    public function count();

    /**
     * Returns one greater than the largest possible document number.
     * This may be used to, e.g., determine how big to allocate a structure which will have
     * an element for every document number in an index.
     *
     * @return integer
     */
    public function maxDoc();

    /**
     * Returns the total number of non-deleted documents in this index.
     *
     * @return integer
     */
    public function numDocs();

    /**
     * Checks, that document is deleted
     *
     * @param integer $id
     * @return boolean
     * @throws Exception    Exception is thrown if $id is out of the range
     */
    public function isDeleted($id);

    /**
     * Set default search field.
     *
     * Null means, that search is performed through all fields by default
     *
     * Default value is null
     *
     * @param string $fieldName
     */
    public static function setDefaultSearchField($fieldName);

    /**
     * Get default search field.
     *
     * Null means, that search is performed through all fields by default
     *
     * @return string
     */
    public static function getDefaultSearchField();

    /**
     * Set result set limit.
     *
     * 0 (default) means no limit
     *
     * @param integer $limit
     */
    public static function setResultSetLimit($limit);

    /**
     * Set result set limit.
     *
     * 0 means no limit
     *
     * @return integer
     */
    public static function getResultSetLimit();

    /**
     * Retrieve index maxBufferedDocs option
     *
     * maxBufferedDocs is a minimal number of documents required before
     * the buffered in-memory documents are written into a new Segment
     *
     * Default value is 10
     *
     * @return integer
     */
    public function getMaxBufferedDocs();

    /**
     * Set index maxBufferedDocs option
     *
     * maxBufferedDocs is a minimal number of documents required before
     * the buffered in-memory documents are written into a new Segment
     *
     * Default value is 10
     *
     * @param integer $maxBufferedDocs
     */
    public function setMaxBufferedDocs($maxBufferedDocs);

    /**
     * Retrieve index maxMergeDocs option
     *
     * maxMergeDocs is a largest number of documents ever merged by addDocument().
     * Small values (e.g., less than 10,000) are best for interactive indexing,
     * as this limits the length of pauses while indexing to a few seconds.
     * Larger values are best for batched indexing and speedier searches.
     *
     * Default value is PHP_INT_MAX
     *
     * @return integer
     */
    public function getMaxMergeDocs();

    /**
     * Set index maxMergeDocs option
     *
     * maxMergeDocs is a largest number of documents ever merged by addDocument().
     * Small values (e.g., less than 10,000) are best for interactive indexing,
     * as this limits the length of pauses while indexing to a few seconds.
     * Larger values are best for batched indexing and speedier searches.
     *
     * Default value is PHP_INT_MAX
     *
     * @param integer $maxMergeDocs
     */
    public function setMaxMergeDocs($maxMergeDocs);

    /**
     * Retrieve index mergeFactor option
     *
     * mergeFactor determines how often segment indices are merged by addDocument().
     * With smaller values, less RAM is used while indexing,
     * and searches on unoptimized indices are faster,
     * but indexing speed is slower.
     * With larger values, more RAM is used during indexing,
     * and while searches on unoptimized indices are slower,
     * indexing is faster.
     * Thus larger values (> 10) are best for batch index creation,
     * and smaller values (< 10) for indices that are interactively maintained.
     *
     * Default value is 10
     *
     * @return integer
     */
    public function getMergeFactor();

    /**
     * Set index mergeFactor option
     *
     * mergeFactor determines how often segment indices are merged by addDocument().
     * With smaller values, less RAM is used while indexing,
     * and searches on unoptimized indices are faster,
     * but indexing speed is slower.
     * With larger values, more RAM is used during indexing,
     * and while searches on unoptimized indices are slower,
     * indexing is faster.
     * Thus larger values (> 10) are best for batch index creation,
     * and smaller values (< 10) for indices that are interactively maintained.
     *
     * Default value is 10
     *
     * @param integer $maxMergeDocs
     */
    public function setMergeFactor($mergeFactor);

    /**
     * Performs a query against the index and returns an array
     * of QueryHit objects.
     * Input is a string or Query.
     *
     * @param mixed $query
     * @return array QueryHit
     * @throws Exception
     */
    public function find($query);

    /**
     * Returns a list of all unique field names that exist in this index.
     *
     * @param boolean $indexed
     * @return array
     */
    public function getFieldNames($indexed = false);

    /**
     * Returns a Document object for the document
     * number $id in this index.
     *
     * @param integer|QueryHit $id
     * @return Document
     */
    public function getDocument($id);

    /**
     * Returns true if index contain documents with specified term.
     *
     * Is used for query optimization.
     *
     * @param Term $term
     * @return boolean
     */
    public function hasTerm(Term $term);

    /**
     * Returns IDs of all the documents containing term.
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return array
     */
    public function termDocs(Term $term, $docsFilter = null);

    /**
     * Returns documents filter for all documents containing term.
     *
     * It performs the same operation as termDocs, but return result as
     * DocsFilter object
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return DocsFilter
     */
    public function termDocsFilter(Term $term, $docsFilter = null);

    /**
     * Returns an array of all term freqs.
     * Return array structure: array( docId => freq, ...)
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return integer
     */
    public function termFreqs(Term $term, $docsFilter = null);

    /**
     * Returns an array of all term positions in the documents.
     * Return array structure: array( docId => array( pos1, pos2, ...), ...)
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return array
     */
    public function termPositions(Term $term, $docsFilter = null);

    /**
     * Returns the number of documents in this index containing the $term.
     *
     * @param Term $term
     * @return integer
     */
    public function docFreq(Term $term);

    /**
     * Retrive similarity used by index reader
     *
     * @return Similarity
     */
    public function getSimilarity();

    /**
     * Returns a normalization factor for "field, document" pair.
     *
     * @param integer $id
     * @param string $fieldName
     * @return float
     */
    public function norm($id, $fieldName);

    /**
     * Returns true if any documents have been deleted from this index.
     *
     * @return boolean
     */
    public function hasDeletions();

    /**
     * Deletes a document from the index.
     * $id is an internal document id
     *
     * @param integer|QueryHit $id
     * @throws Exception
     */
    public function delete($id);

    /**
     * Adds a document to this index.
     *
     * @param Document $document
     */
    public function addDocument(Document $document);

    /**
     * Commit changes resulting from delete() or undeleteAll() operations.
     */
    public function commit();

    /**
     * Optimize index.
     *
     * Merges all segments into one
     */
    public function optimize();

    /**
     * Returns an array of all terms in this index.
     *
     * @return array
     */
    public function terms();

    /**
     * Undeletes all documents currently marked as deleted in this index.
     */
    public function undeleteAll();

    /**
     * Add reference to the index object
     *
     * @internal
     */
    public function addReference();

    /**
     * Remove reference from the index object
     *
     * When reference count becomes zero, index is closed and resources are cleaned up
     *
     * @internal
     */
    public function removeReference();
}
