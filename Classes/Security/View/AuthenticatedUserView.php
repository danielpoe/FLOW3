<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\Security\View;

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
 * @subpackage MVC
 * @version $Id: $
 */

/**
 * The login view.
 *
 * @package FLOW3
 * @subpackage MVC
 * @version $Id: $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser Public License, version 3 or later
 */
class AuthenticatedUserView extends \F3\FLOW3\MVC\View\AbstractView {

	/**
	 * @var \F3\FLOW3\MVC\Request
	 */
	protected $request;

	/**
	 * Renders the login view
	 *
	 * @return string The rendered view
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function render() {
		$baseURI = $this->request->getBaseURI();

		return "
		<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
		<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
		<html xmlns=\"http://www.w3.org/1999/xhtml\">

		<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			<title>FLOW3 Login</title>

				<base href=\"" . $baseURI . "\" />
				<script type=\"text/javascript\" src=\"Resources/Web/FLOW3/Public/Security/JavaScript/jsbn/jsbn.js\"></script>
				<script type=\"text/javascript\" src=\"Resources/Web/FLOW3/Public/Security/JavaScript/jsbn/prng4.js\"></script>
				<script type=\"text/javascript\" src=\"Resources/Web/FLOW3/Public/Security/JavaScript/jsbn/rng.js\"></script>
				<script type=\"text/javascript\" src=\"Resources/Web/FLOW3/Public/Security/JavaScript/jsbn/rsa.js\"></script>
				<script type=\"text/javascript\" src=\"Resources/Web/FLOW3/Public/Security/JavaScript/jsbn/base64.js\"></script>

				<style type=\"text/css\">
					body { font-family:sans-serif; font-size:90%; background-color:#fff; }
					#logo { float:right; margin:2ex; }
					#loginStatus { clear:both; border: 2px #E56508 solid; width: 230px; height: 50px; padding: 50px; margin: 100px auto 0px auto; background-color: #700016; color: #FFFFFF; }
				</style>

				<script type=\"text/javascript\">

					function encryptLoginData() {
						var username = document.loginForm.F3_FLOW3_Security_Authentication_Token_RSAUsernamePassword_encryptedUsername.value;
						var password = document.loginForm.F3_FLOW3_Security_Authentication_Token_RSAUsernamePassword_encryptedPassword.value;

						var encryptedUsername = encrypt(username, '###PUBLIC_KEY_USERNAME###');
						var encryptedPassword = encrypt(password, '###PUBLIC_KEY_PASSWORD###');

						document.loginForm.F3_FLOW3_Security_Authentication_Token_RSAUsernamePassword_encryptedUsername.value = encryptedUsername;
						document.loginForm.F3_FLOW3_Security_Authentication_Token_RSAUsernamePassword_encryptedPassword.value = encryptedPassword;

						return true;
					}

					function encrypt(plaintext, key) {
						var rsa = new RSAKey();
						rsa.setPublic(key, '10001');
						var cipher = rsa.encrypt(plaintext);

						return linebrk(hex2b64(cipher), 64);
					}

				</script>
		</head>
		<body>
			<img src=\"Resources/Packages/FLOW3/Security/Media/f3_logo.gif\" id=\"logo\" />
			<div id=\"loginStatus\">
				<p>You are now logged in as admin!</p>
			</div>
		</body>
		</html>
		";
	}
}

?>