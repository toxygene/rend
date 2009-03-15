<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category Rend
 * @subpackage UnitTest
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_View_Helper_IsAllowed */
require_once "Rend/View/Helper/IsAllowed.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_View_Helper_IsAllowedTest extends PHPUnit_Framework_TestCase
{

    private function _getIsAllowedHelper()
    {
        $acl = new Zend_Acl();

        $acl->add(new Zend_Acl_Resource("apple"))
            ->add(new Zend_Acl_Resource("pear"))
            ->addRole(new Zend_Acl_Role("john"))
            ->addRole(new Zend_Acl_Role("mike"));

        $acl->allow("john", "apple", "eat")
            ->allow("john", "pear")
            ->allow("mike", "apple", "touch");


        $actionController = new IsAllowed_Zend_Controller_Action(
            new Zend_Controller_Request_Simple(),
            new Zend_Controller_Response_Cli()
        );

        $isAllowedHelper = new Rend_Controller_Action_Helper_IsAllowed(array(
            "acl"              => $acl,
            "actionController" => $actionController
        ));

        return $isAllowedHelper;
    }

    public function testAclsCanBeChecked()
    {
        $isAllowedHelper = $this->_getIsAllowedHelper()
                                ->setRole('mike');

        Zend_Controller_Action_HelperBroker::addHelper($isAllowedHelper);

        $helper = new Rend_View_Helper_IsAllowed();

        $this->assertFalse($helper->direct("apple", "eat"));
        $this->assertTrue($helper->direct("apple", "touch"));
    }

    public function testIsAllowedHelperIsLazyLoadedFromTheHelperBroker()
    {
        $isAllowedHelper = $this->_getIsAllowedHelper()
                                ->setRole('mike');

        $helper = new Rend_View_Helper_IsAllowed();
        $helper->setIsAllowedHelper($isAllowedHelper);

        $this->assertSame(
            $isAllowedHelper,
            $helper->getIsAllowedHelper()
        );
    }

}
