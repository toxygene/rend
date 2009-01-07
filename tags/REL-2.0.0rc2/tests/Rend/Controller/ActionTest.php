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
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/** Rend_Controller_Action */
require_once "Rend/Controller/Action.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Controller_ActionTest extends PHPUnit_Framework_TestCase
{

    private $_action;

    private $_config;

    private $_factoryLoader;

    public function setUp()
    {
        $this->_config        = new Zend_Config(array());
        $this->_factoryLoader = new Rend_FactoryLoader();

        $this->_action = new Mock_Rend_Controller_Action(
            new Zend_Controller_Request_HttpTestCase(),
            new Zend_Controller_Response_HttpTestCase(),
            array(
                "rendConfig"        => $this->_config,
                "rendFactoryLoader" => $this->_factoryLoader
            )
        );
    }

    public function testFactoryLoaderIsLoadedViaInvokeArg()
    {
        $this->assertSame(
            $this->_factoryLoader,
            $this->_action->getFactoryLoader()
        );
    }

    public function testConfigurationIsLoadedViaInvokeArg()
    {
        $this->assertSame(
            $this->_config,
            $this->_action->getConfig()
        );
    }

}

class Mock_Rend_Controller_Action extends Rend_Controller_Action
{}
