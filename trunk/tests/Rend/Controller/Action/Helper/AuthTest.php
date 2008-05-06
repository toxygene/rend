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

/** Rend_Controller_Action_Helper_Auth */
require_once 'Rend/Controller/Action/Helper/Auth.php';

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Zend_Auth */
require_once 'Zend/Auth.php';

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/**
 *
 */
class Rend_Controller_Action_Helper_AuthTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $this->_helper = new Rend_Controller_Action_Helper_Auth();
    }

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();

        unset($this->_helper);
    }

    public function testAuthIsLazyLoaded()
    {
        $auth = $this->_helper->getAuth();

        $this->assertType('Zend_Auth', $auth);
        $this->assertSame($auth, $this->_helper->getAuth());
        $this->assertSame($auth, $this->_helper->direct());
    }

    public function testAuthCanBeOverwritten()
    {
        $auth = Zend_Auth::getInstance();

        $this->_helper->setAuth($auth);

        $this->assertSame($auth, $this->_helper->getAuth());
        $this->assertSame($auth, $this->_helper->direct());
    }

}
