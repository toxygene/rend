<?php
/**
 *
 */

/** Zend_Controller_Router_Abstract */
require_once "Zend/Controller/Router/Abstract.php";

/**
 *
 */
class Rend_Controller_Router_QueryString extends Zend_Controller_Router_Abstract
{

    /**
     *
     */
    private $_values = array();

    /**
     * Assemble a URL
     *
     * @param array $userParams
     * @param string $name (ignored)
     * @param boolean $reset
     * @param boolean $encode (ignored)
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