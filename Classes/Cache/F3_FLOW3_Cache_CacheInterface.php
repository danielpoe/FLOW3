<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\Cache;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 * @package FLOW3
 * @subpackage Cache
 * @version $Id$
 */

/**
 * Contract for a Cache (frontend)
 *
 * @package FLOW3
 * @subpackage Cache
 * @version $Id$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @author Robert Lemke <robert@typo3.org>
 */
interface CacheInterface {

	/**
	 * Pattern a cache identifer must match.
	 */
	const PATTERN_IDENTIFIER = '/^[a-zA-Z0-9_%]{1,250}$/';

	/**
	 * Returns this cache's identifier
	 *
	 * @return string The identifier for this cache
	 */
	public function getIdentifier();

	/**
	 * Returns the backend used by this cache
	 *
	 * @return \F3\FLOW3\Cache\AbstractBackend The backend used by this cache
	 */
	public function getBackend();

	/**
	 * Saves data in the cache.
	 *
	 * @param string $entryIdentifier Something which identifies the data - depends on concrete cache
	 * @param mixed $data The data to cache - also depends on the concrete cache implementation
	 * @param array $tags Tags to associate with this cache entry
	 * @return void
	 */
	public function set($entryIdentifier, $data, $tags = array());

	/**
	 * Finds and returns data from the cache.
	 *
	 * @param string $entryIdentifier Something which identifies the cache entry - depends on concrete cache
	 * @return mixed
	 */
	public function get($entryIdentifier);

	/**
	 * Finds and returns all cache entries which are tagged by the specified tag.
	 * The asterisk ("*") is allowed as a wildcard at the beginning and the end of
	 * the tag.
	 *
	 * @param string $tag The tag to search for, the "*" wildcard is supported
	 * @return array An array with the content of all matching entries. An empty array if no entries matched
	 */
	public function getByTag($tag);

	/**
	 * Checks if a cache entry with the specified identifier exists.
	 *
	 * @param string $entryIdentifier An identifier specifying the cache entry
	 * @return boolean TRUE if such an entry exists, FALSE if not
	 */
	public function has($entryIdentifier);

	/**
	 * Removes the given cache entry from the cache.
	 *
	 * @param string $entryIdentifier An identifier specifying the cache entry
	 * @return boolean TRUE if such an entry exists, FALSE if not
	 */
	public function remove($entryIdentifier);

	/**
	 * Removes all cache entries of this cache.
	 *
	 * @return void
	 */
	function flush();

	/**
	 * Removes all cache entries of this cache which are tagged by the specified tag.
	 *
	 * @param string $tag The tag the entries must have
	 * @return void
	 */
	public function flushByTag($tag);

	/**
	 * Does garbage collection
	 *
	 * @return void
	 */
	public function collectGarbage();
}
?>