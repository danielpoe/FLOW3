<?php
namespace TYPO3\FLOW3\Annotations;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Used to enable property injection.
 *
 * FLOW3 will build Dependency Injection code for the property and try
 * to inject a value as specified by the var annotation.
 *
 * @Annotation
 * @Target("PROPERTY")
 */
final class Inject {}

?>