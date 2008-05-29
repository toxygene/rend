<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Action_Helper_SslSelector extends Rend_Controller_Action_Helper_Abstract
{

    /**#@+
     * Default port values
     * @var     integer
     */
    const HTTP_PORT  = 80;
    const HTTPS_PORT = 443;
    /**#@-*/

    /**
     * HTTP port
     * @var     integer
     */
    private $_httpPort;

    /**
     * HTTPS port
     * @var     integer
     */
    private $_httpsPort;

    /**
     * Constructor
     *
     * @param   integer     $httpPort
     * @param   integer     $httpsPort
     */
    public function __construct($httpPort = null, $httpsPort = null)
    {
        $this->_httpPort  = $httpPort;
        $this->_httpsPort = $httpsPort;
    }

    /**
     * Get the HTTP port
     *
     * @return  integer
     */
    public function getHttpPort()
    {
        if (!$this->_httpPort) {
            $this->_httpPort = self::HTTP_PORT;
        }
        return $this->_httpPort;
    }

    /**
     * Get the HTTPS port
     *
     * @return  integer
     */
    public function getHttpsPort()
    {
        if (!$this->_httpsPort) {
            $this->_httpsPort = self::HTTPS_PORT;
        }
        return $this->_httpsPort;
    }

    /**
     * Hook into action controller preDispatch() workflow
     */
    public function preDispatch()
    {
        if ($this->_isSslRequired() && !$this->_isCurrentlySsl()) {
            $this->_redirect(true);
        } elseif (!$this->_isSslRequired() && $this->_isCurrentlySsl()) {
            $this->_redirect(false);
        }
    }

    /**
     * Redirect to HTTP or HTTPS page
     *
     * @param   boolean     $ssl
     */
    private function _redirect($ssl = false)
    {
        $this->_getActionHelper('redirector')
             ->setCode(301)
             ->gotoUrl($this->_getUrl($ssl));
    }

    /**
     * Get the URL to redirect to
     *
     * @param   boolean $ssl
     * @return  string
     */
    private function _getUrl($ssl = false)
    {
        $request = $this->getRequest();

        $url = 'http';

        if ($ssl) {
            $url .= 's';
        }

        $url .= '://' . $request->getServer('SERVER_NAME');

        if ($ssl && $this->getHttpsPort() != self::HTTPS_PORT) {
            $url .= ':' . $this->getHttpsPort();
        } elseif (!$ssl && $this->getHttpPort() != self::HTTP_PORT) {
            $url .= ':' . $this->getHttpPort();
        }

        $url .= $request->getRequestUri();

        return $url;
    }

    /**
     * Determine if the current request is an SSL request
     *
     * @return  boolean
     */
    private function _isCurrentlySsl()
    {
        return $this->getRequest()->isSsl();
    }

    /**
     * Determine if SSL is required for the requested action
     *
     * @return  boolean
     */
    private function _isSslRequired() {
        $actionName       = $this->_getActionName();
        $actionController = $this->getActionController();

        return isset($actionController->ssl) && isset($actionController->ssl[$actionName]) && $actionController->ssl[$actionName];
    }

}
