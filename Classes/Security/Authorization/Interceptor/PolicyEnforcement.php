<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\Security\Authorization\Interceptor;

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
 * @subpackage Security
 * @version $Id$
 */

/**
 * This is the main security interceptor, which enforces the current security policy and is usually called by the central security aspect:
 *
 * 1. If authentication has not been performed (flag is set in the security context) the configured authentication manager is called to authenticate its tokens
 * 2. If a AuthenticationRequired exception has been thrown we look for an authentication entry point in the active tokens to redirect to authentication
 * 3. Then the configured AccessDecisionManager is called to authorize the request/action
 *
 * @package FLOW3
 * @subpackage Security
 * @version $Id$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class PolicyEnforcement implements \F3\FLOW3\Security\Authorization\InterceptorInterface {

	/**
	 * The current security context
	 * @var \F3\FLOW3\Security\Context
	 */
	protected $securityContext;

	/**
	 * The authentication manager
	 * @var \F3\FLOW3\Secuirty\Authentication\ManagerInterface
	 */
	protected $authenticationManager;

	/**
	 * The access decision manager
	 * @var \F3\FLOW3\Security\Authorization\AccessDecisionManagerInterface $accessDecisionManager
	 */
	protected $accessDecisionManager;

	/**
	 * The current joinpoint
	 * @var \F3\FLOW3\AOP\JoinPointInterface $joinPoint
	 */
	protected $joinPoint;

	/**
	 * Constructor.
	 *
	 * @param \F3\FLOW3\Security\ContextHolderInterface $securityContextHolder The security context holder
	 * @param \F3\FLOW3\Security\Authentication\ManagerInterface $authenticationManager The authentication manager
	 * @param \F3\FLOW3\Security\Authorization\AccessDecisionManagerInterface $accessDecisionManager The access decision manager
	 * @return void
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function __construct(
					\F3\FLOW3\Security\ContextHolderInterface $securityContextHolder,
					\F3\FLOW3\Security\Authentication\ManagerInterface $authenticationManager,
					\F3\FLOW3\Security\Authorization\AccessDecisionManagerInterface $accessDecisionManager
					) {
		$this->securityContext = $securityContextHolder->getContext();
		$this->authenticationManager = $authenticationManager;
		$this->accessDecisionManager = $accessDecisionManager;
	}

	/**
	 * Sets the current joinpoint for this interception
	 *
	 * @param \F3\FLOW3\AOP\JoinPointInterface $joinPoint The current joinpoint
	 * @return void
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function setJoinPoint(\F3\FLOW3\AOP\JoinPointInterface $joinPoint) {
		$this->joinPoint = $joinPoint;
	}

	/**
	 * Invokes the security interception
	 *
	 * @return boolean TRUE if the security checks was passed
	 * @throws \F3\FLOW3\Security\Exception\AccessDenied
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function invoke() {
		try {
			if (!$this->securityContext->authenticationPerformed()) {
				$this->authenticationManager->authenticate();
			}
		} catch (\F3\FLOW3\Security\Exception\AuthenticationRequired $exception) {
			foreach ($this->securityContext->getAuthenticationTokens() as $token) {
				if ($token->getAuthenticationEntryPoint() !== NULL && !($this->joinPoint->getProxy() instanceof \F3\FLOW3\Security\Authentication\EntryPointInterface)) {
					$token->getAuthenticationEntryPoint()->startAuthentication();
				}
			}
			throw $exception;
		}

		$this->accessDecisionManager->decide($this->securityContext, $this->joinPoint);
	}
}

?>