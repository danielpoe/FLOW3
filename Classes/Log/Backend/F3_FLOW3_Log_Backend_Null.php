<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\Log\Backend;

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
 * @subpackage Log
 * @version $Id$
 */

/**
 * A backend which just ignores everything
 *
 * @package FLOW3
 * @subpackage Log
 * @version $Id$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 */
class Null extends \F3\FLOW3\Log\AbstractBackend {

	/**
	 * Does nothing
	 *
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function open() {}

	/**
	 * Ignores the call
	 *
	 * @param string $message The message to log
	 * @param integer $severity An integer value: -1 (debug), 0 (ok), 1 (info), 2 (notice), 3 (warning), or 4 (fatal)
	 * @param mixed $additionalData A variable containing more information about the event to be logged
	 * @param string $packageKey Key of the package triggering the log (determined automatically if not specified)
	 * @param string $className Name of the class triggering the log (determined automatically if not specified)
	 * @param string $methodName Name of the method triggering the log (determined automatically if not specified)
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function append($message, $severity = 1, $additionalData = NULL, $packageKey = NULL, $className = NULL, $methodName = NULL) {}

	/**
	 * Does nothing
	 *
	 * @return void
	 */
	public function close() {}

}
?>