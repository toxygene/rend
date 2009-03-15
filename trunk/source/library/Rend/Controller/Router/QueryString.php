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
 * @package Controller
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Zend_Controller_Router_Abstract */
require_once "Zend/Controller/Router/Abstract.php";

/**
 * @category Rend
 * @package Controller
 */
class Rend_Controller_Router_QueryString extends Zend_Controller_Router_Abstract
{

    /**
     * Values
     * @var array
     */
    private $_values = array();

    /**
     * Assemble a URL
     *
     * @param array $userParams
     * @param string $name (ignored)
     * @param boolean $reset
     * @param boolean $encode (ignored)
     * @return string
     */
    public function assemble($userParams, $name = null, $reset = false, $encode = true)
    {
        if ($reset) {
            $params = $userParams;
        } else {
            $params = array_merge(
                $this->_invokeParams,
                $this->_values,
                $userParams
            );
        }

        return "?" . http_build_query($params);
    }

    /**
     * Route a request
     *
     * @param Zend_Controller_Request_Abstract $request
     * @return array
     */
    public function route(Zend_Controller_Request_Abstract $request)
    {
        $this->_values = array_merge(
            $this->_invokeParams,
            $this->_values,
            $request->getParams()
        );

        return $this->_values;
    }

}
