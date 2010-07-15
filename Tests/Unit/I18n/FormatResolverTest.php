<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\I18n;

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
 * Testcase for the FormatResolver
 *
 * @version $Id$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class FormatResolverTest extends \F3\Testing\BaseTestCase {

	/**
	 * @var \F3\FLOW3\I18n\Locale
	 */
	protected $dummyLocale;

	/**
	 * @return void
	 * @author Karol Gusak <firstname@lastname.eu>
	 */
	public function setUp() {
		$this->dummyLocale = new \F3\FLOW3\I18n\Locale('en_GB');
	}

	/**
	 * @test
	 * @author Karol Gusak <firstname@lastname.eu>
	 */
	public function resolvePlaceholdersWorks() {
		$mockNumberFormatter = $this->getMock('F3\FLOW3\I18n\Formatter\NumberFormatter');
		$mockNumberFormatter->expects($this->at(0))->method('format')->with(1, $this->dummyLocale)->will($this->returnValue('1.0'));
		$mockNumberFormatter->expects($this->at(1))->method('format')->with(2, $this->dummyLocale, array('percent'))->will($this->returnValue('200%'));

		$formatResolver = $this->getAccessibleMock('F3\FLOW3\I18n\FormatResolver', array('getFormatter'));
		$formatResolver->expects($this->exactly(2))->method('getFormatter')->with('number')->will($this->returnValue($mockNumberFormatter));

		$result = $formatResolver->resolvePlaceholders('Foo {0,number}, bar {1,number,percent}', array(1, 2), $this->dummyLocale);
		$this->assertEquals('Foo 1.0, bar 200%', $result);
	}
}

?>