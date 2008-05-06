<?php
/**
 * Rend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category   Rend
 * @package    Tests
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://rend.superglobals.com)
 * @license    http://rend.superglobals.com/License New BSD License
 * @version    $Id$
 */

/** Rend_Controller_Action_Helper_Model */
require_once 'Rend/Controller/Action/Helper/Model.php';

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/**
 *
 */
class Rend_Controller_Action_Helper_ModelTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

}
