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
 * @package     Validate
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.4
 * @version     $Id$
 */

/** Zend_Validate_Abstract */
require_once 'Zend/Validate/Abstract.php';

/**
 * Base class for validation
 *
 * @category    Rend
 * @package     Validate
 */
abstract class Rend_Validate_Abstract extends Zend_Validate_Abstract
{

    /**
     * Constructor
     *
     * @param   array|Zend_Config   $options
     */
    public function __construct($options = null)
    {
        if ($options) {
            if ($options instanceof Zend_Config) {
                $this->setConfig($options);
            } elseif (is_array($options)) {
                $this->setOptions($options);
            } else {
                /** Rend_Validate_Exception */
                require_once 'Rend/Validate/Exception.php';
                throw new Rend_Validate_Exception('Invalid options');
            }
        }
    }

    /**
     * Set options from a config object
     *
     * @param   Zend_Config     $config
     * @return  Rend_Controller_Action_Helper_Abstract
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray();
    }

    /**
     * Set options from an array
     *
     * @param   array   $options
     * @return  Rend_Controller_Action_Helper_Abstract
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}
