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
class Rend_Controller_Action_Helper_LocaleTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $this->_helper = new Rend_Controller_Action_Helper_Locale();
    }

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();

        unset($this->_helper);
    }

    public function testLocaleIsLazyLoaded()
    {
        $locale = $this->_helper->getLocale();

        $this->assertType('Zend_Locale', $locale);

        $this->assertSame($locale, $this->_helper->getLocale());
        $this->assertSame($locale, $this->_helper->direct());
    }

    public function testLocaleCanBeOverwritten()
    {
        $locale = new Zend_Locale('fr_CA');

        $this->_helper->setLocale($locale);

        $this->assertEquals($locale, $this->_helper->getLocale());
    }

}
