<?php
namespace TYPO3\FLOW3\Tests\Functional\Reflection\Fixtures\Model;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A model fixture which is used for testing the class schema building
 *
 * @FLOW3\Entity
 */
class SuperEntity extends AbstractSuperEntity {

	/**
	 * Just a normal string
	 *
	 * @var string
	 */
	protected $someString;

}

?>