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

/** Rend_Controller_Action_Helper_Mail */
require_once 'Rend/Controller/Action/Helper/Mail.php';

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/** Zend_Mail */
require_once 'Zend/Mail.php';

/**
 *
 */
class Rend_Controller_Action_Helper_MailTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

    public function testConstructorCanSetEncoding()
    {
        $helper = $this->_getHelper('encoding');
        $this->assertEquals('encoding', $helper->getEncoding());
    }

    public function testEncodingIsLazyLoaded()
    {
        $config = new Zend_Config(array('encoding' => 'test'));

        Zend_Controller_Action_HelperBroker::getStaticHelper('config')
                                           ->setConfig($config);

        $this->assertEquals('test', $this->_getHelper()->getEncoding());
    }

    public function testEncodingDefaultsToUtf8()
    {
        $config = new Zend_Config(array());

        Zend_Controller_Action_HelperBroker::getStaticHelper('config')
                                           ->setConfig($config);

        $this->assertEquals('UTF-8', $this->_getHelper()->getEncoding());
    }

    public function testMailObjectIsLazyLoaded()
    {
        $this->assertType('Zend_Mail', $this->_getHelper('encoding')->getMail());
        $this->assertType('Zend_Mail', $this->_getHelper('encoding')->direct());
    }

    private function _getHelper($encoding = null)
    {
        return new Rend_Controller_Action_Helper_Mail($encoding);
    }

}
