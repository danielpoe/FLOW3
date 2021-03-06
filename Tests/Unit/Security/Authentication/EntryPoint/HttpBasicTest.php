<?php
namespace TYPO3\FLOW3\Tests\Unit\Security\Authentication\EntryPoint;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\FLOW3\Http\Request;
use TYPO3\FLOW3\Http\Response;
use TYPO3\FLOW3\Http\Uri;
use TYPO3\FLOW3\Security\Authentication\EntryPoint\HttpBasic;

/**
 * Testcase for HTTP Basic Auth authentication entry point
 */
class HttpBasicTest extends \TYPO3\FLOW3\Tests\UnitTestCase {

	/**
	 * @test
	 */
	public function startAuthenticationSetsTheCorrectValuesInTheResponseObject() {
		$request = Request::create(new Uri('http://robertlemke.com/admin'))->createActionRequest();
		$response = new Response();

		$entryPoint = new HttpBasic();
		$entryPoint->setOptions(array('realm' => 'realm string'));

		$entryPoint->startAuthentication($request->getHttpRequest(), $response);

		$this->assertEquals('401', substr($response->getStatus(), 0, 3));
		$this->assertEquals('Basic realm="realm string"', $response->getHeader('WWW-Authenticate'));
		$this->assertEquals('Authorization required', $response->getContent());
		$this->assertEquals(array('realm' => 'realm string'), $entryPoint->getOptions());
	}
}
?>
