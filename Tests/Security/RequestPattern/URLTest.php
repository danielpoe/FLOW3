<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\Security\RequestPattern;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * @package FLOW3
 * @subpackage Tests
 * @version $Id$
 */

/**
 * Testcase for the URL request pattern
 *
 * @package FLOW3
 * @subpackage Tests
 * @version $Id$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class URLTest extends \F3\Testing\BaseTestCase {

	/**
	 * @test
	 * @category unit
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function anExceptionIsThrownIfTheGivenRequestObjectIsNotSupported() {
		$cliRequest = $this->getMock('F3\FLOW3\MVC\CLI\Request');

		$requestPattern = new \F3\FLOW3\Security\RequestPattern\URL();
		try {
			$requestPattern->matchRequest($cliRequest);
			$this->fail('No exception has been thrown.');
		} catch (\F3\FLOW3\Security\Exception\RequestTypeNotSupported $exception) {

		}
	}

	/**
	 * @test
	 * @category unit
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function canMatchReturnsTrueForASupportedRequestType() {
		$webRequest = $this->getMock('F3\FLOW3\MVC\Web\Request');

		$requestPattern = new \F3\FLOW3\Security\RequestPattern\URL();
		$this->assertTrue($requestPattern->canMatch($webRequest));
	}

	/**
	 * @test
	 * @category unit
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function canMatchReturnsFalseForAnUnsupportedRequestType() {
		$cliRequest = $this->getMock('F3\FLOW3\MVC\CLI\Request');

		$requestPattern = new \F3\FLOW3\Security\RequestPattern\URL();
		$this->assertFalse($requestPattern->canMatch($cliRequest));
	}

	/**
	 * @test
	 * @category unit
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function requestMatchingBasicallyWorks() {
		$request = $this->getMock('F3\FLOW3\MVC\Web\Request');
		$uri = $this->getMock('F3\FLOW3\Property\DataType\URI', array(), array(), '', FALSE);

		$request->expects($this->once())->method('getRequestURI')->will($this->returnValue($uri));
		$uri->expects($this->once())->method('getPath')->will($this->returnValue('/some/nice/path/to/index.php'));

		$requestPattern = new \F3\FLOW3\Security\RequestPattern\URL();
		$requestPattern->setPattern('/some/nice/.*');

		$this->assertTrue($requestPattern->matchRequest($request));
	}
}
?>