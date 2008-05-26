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
class Rend_Controller_Action_Helper_AclTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

    public function testConstructorSetsTheFilename()
    {
        $helper = new Rend_Controller_Action_Helper_Acl(
            'filename'
        );

        $this->assertEquals('filename', $helper->getFilename());
    }

    public function testDefaultFilenameIsLazyLoaded()
    {
        $helper = new Rend_Controller_Action_Helper_Acl();

        $this->assertEquals(
            '../config/acl.php',
            $helper->getFilename()
        );
    }

    public function testDefaultFilenameIsLazyLoadedWithRendPathWhenAvailable()
    {
        $helper = new Rend_Controller_Action_Helper_Acl();

        $helper->getFrontController()->setParam('rendPath', 'test');

        $this->assertEquals(
            'test/config/acl.php',
            $helper->getFilename()
        );
    }

    public function testAclIsLazyLoaded()
    {
        $helper = new Rend_Controller_Action_Helper_Acl(
            realPath(dirname(__FILE__) . '/_files/acl.php')
        );

        $acl = $helper->getAcl();

        $this->assertType('Zend_Acl', $acl);
        $this->assertSame($acl, $helper->getAcl());
        $this->assertSame($acl, $helper->direct());
    }

    public function testAclCanBeOverwritten()
    {
        $acl    = new Zend_Acl();
        $helper = new Rend_Controller_Action_Helper_Acl();

        $helper->setAcl($acl);

        $this->assertSame(
            $acl,
            $helper->getAcl()
        );
    }

}
