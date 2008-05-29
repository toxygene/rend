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
class Rend_Controller_Action_Helper_ConfigTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

    public function testConstructorCanSetTheFilenameAndMode()
    {
        $helper = new Rend_Controller_Action_Helper_Config(
            'filename',
            'mode'
        );

        $this->assertEquals('filename', $helper->getFilename());
        $this->assertEquals('mode', $helper->getMode());
    }

    public function testDefaultFilenameIsLazyLoadedWithRendPathWhenAvailable()
    {
        $helper = new Rend_Controller_Action_Helper_Config();
        $helper->getFrontController()->setParam('rendPath', 'test');

        $this->assertEquals(
            'test/config/config.ini',
            $helper->getFilename()
        );
    }

    public function testDefaultFilenameIsLazyLoaded()
    {
        $helper = new Rend_Controller_Action_Helper_Config();

        $this->assertEquals(
            '../config/config.ini',
            $helper->getFilename()
        );
    }

    public function testDefaultModeIsLazyLoaded()
    {
        $helper = new Rend_Controller_Action_Helper_Config();

        $this->assertEquals(
            Rend_Controller_Action_Helper_Config::DEVELOPMENT,
            $helper->getMode()
        );
    }

    public function testDefaultModeIsLazyLoadedFromRendModeWhenAvailable()
    {
        $helper = new Rend_Controller_Action_Helper_Config();

        $helper->getFrontController()->setParam(
            'rendMode',
            Rend_Controller_Action_Helper_Config::PRODUCTION
        );

        $this->assertEquals(
            Rend_Controller_Action_Helper_Config::PRODUCTION,
            $helper->getMode()
        );
    }

    public function testConfigObjectIsLazyLoaded()
    {
        $helper = new Rend_Controller_Action_Helper_Config(
            dirname(__FILE__) . '/_files/config.ini',
            'three'
        );

        $config = $helper->getConfig();

        $this->assertType('Zend_Config_Ini', $config);
        $this->assertEquals('six', $config->test);
    }

    public function testConfigObjectCanBeOverwritten()
    {
        $config = new Zend_Config(array());

        $helper = new Rend_Controller_Action_Helper_Config();
        $helper->setConfig($config);

        $this->assertSame($config, $helper->getConfig());
        $this->assertSame($config, $helper->direct());
    }

}
