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

/** Rend_Controller_Action_Helper_Translator */
require_once 'Rend/Controller/Action/Helper/Translator.php';

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/** Zend_Locale */
require_once 'Zend/Locale.php';

/**
 *
 */
class Rend_Controller_Action_Helper_TranslatorTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

    public function testDirectoryIsLazyLoaded()
    {
        $helper = new Rend_Controller_Action_Helper_Translator();
        $this->assertEquals('../languages', $helper->getDirectory());
    }

    public function testLocaleIsLazyLoaded()
    {
        $locale = new Zend_Locale();
        Zend_Controller_Action_HelperBroker::getStaticHelper('locale')
                                           ->setLocale($locale);

        $helper = new Rend_Controller_Action_Helper_Translator();

        $this->assertEquals($locale, $helper->getLocale());
    }

    public function testTranslatorIsLazyLoaded()
    {
        $config = new Zend_Config(array(
            'translator' => array(
                'adapter' => 'csv',
                'options' => array(
                    'scan' => 2
                )
            )
        ));

        Zend_Controller_Action_HelperBroker::getStaticHelper('config')
                                           ->setConfig($config);

        $helper = new Rend_Controller_Action_Helper_Translator(
            dirname(__FILE__) . '/_files/languages',
            new Zend_Locale()
        );

        $this->assertType('Zend_Translate', $helper->getTranslator());
        $this->assertType('Zend_Translate', $helper->direct());
        $this->assertEquals(
            'two',
            $helper->getTranslator()->translate('one')
        );
        $this->assertEquals(
            2,
            $helper->getTranslator()->getOptions('scan')
        );
    }

    public function testTranslatorCanBeOverwritten()
    {
        $translate = new Zend_Translate('array', array());
        $helper = new Rend_Controller_Action_Helper_Translator();
        $helper->setTranslator($translate);

        $this->assertSame(
            $translate,
            $helper->getTranslator()
        );
    }

    public function testExceptionIsThrownWhenTranslatorIsNotEnabled()
    {
        $this->setExpectedException('Zend_Controller_Action_Exception');

        $config = new Zend_Config(array());

        Zend_Controller_Action_HelperBroker::getStaticHelper('config')
                                           ->setConfig($config);

        $helper = new Rend_Controller_Action_Helper_Translator();

        $helper->getTranslator();
    }

}
