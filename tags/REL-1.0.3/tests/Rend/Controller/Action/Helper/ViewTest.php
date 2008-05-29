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

/** TestHelper */
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/TestHelper.php';

/**
 *
 */
class Rend_Controller_Action_Helper_ViewTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

    public function testConstructorCanSetTheEncodingAndPath()
    {
        $helper = $this->_getHelper('encoding', 'path');

        $this->assertEquals('encoding', $helper->getEncoding());
        $this->assertEquals('path', $helper->getPath());
    }

    public function testEncodingIsLazyLoaded()
    {
        $config = new Zend_Config(array('encoding' => 'test'));

        Zend_Controller_Action_HelperBroker::getStaticHelper('config')
                                           ->setConfig($config);

        $helper = $this->_getHelper();

        $this->assertEquals('test', $helper->getEncoding());

        $config = new Zend_Config(array());

        Zend_Controller_Action_HelperBroker::getStaticHelper('config')
                                           ->setConfig($config);

        $helper = $this->_getHelper();

        $this->assertEquals('UTF-8', $helper->getEncoding());
    }

    public function testTranslatorIsLazyLoaded()
    {
        $translator = new Zend_Translate('array', array());

        Zend_Controller_Action_HelperBroker::getStaticHelper('translator')
                                           ->setTranslator($translator);

        $helper = $this->_getHelper('encoding', 'path');

        $this->assertSame(
            $translator->getAdapter(),
            $helper->getView()->getHelper('translate')->getTranslator()
        );
    }

    public function testViewIsLazyLoaded()
    {
        $helper = $this->_getHelper(
            'encoding',
            'path',
            new Zend_Translate('array', array())
        );

        $this->assertType('Zend_View', $helper->getView());
        $this->assertType('Zend_View', $helper->direct());
    }

    private function _getHelper($encoding = null, $path = null, Zend_Translate $translator = null)
    {
        return new Rend_Controller_Action_Helper_View(
            $encoding,
            $path,
            $translator
        );
    }

}
