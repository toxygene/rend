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

/** Zend_Auth_Result */
require_once 'Zend/Auth/Result.php';

/**
 * Authentiction validation
 *
 * @category    Rend
 * @package     Validate
 */
class Rend_Validate_Authentication extends Zend_Validate_Abstract
{

    /**#@+
     * Default fields
     * @var     string
     */
    const DEFAULT_IDENTITY_FIELD   = 'username';
    const DEFAULT_CREDENTIAL_FIELD = 'password';
    /**#@-*/

    /**#@+
     * Authentication errors
     * @var     string
     */
    const GENERAL_AUTH_ERROR       = 'generalAuthError';
    const IDENTITY_NOT_FOUND       = 'identityNotFound';
    const IDENTITY_AMBIGUOUS       = 'identityAmbiguous';
    const CREDENTIAL_INVALID       = 'credentialInvalid';
    const UNCATEGORIZED_AUTH_ERROR = 'uncategorizedAuthError';
    const MISSING_FIELD            = 'missingField';
    /**#@-*/

    /**
     * Map of auth results to errors
     * @var     array
     */
    protected $_codesToErrors = array(
        Zend_Auth_Result::FAILURE                    => self::GENERAL_AUTH_ERROR,
        Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND => self::IDENTITY_NOT_FOUND,
        Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS => self::IDENTITY_AMBIGUOUS,
        Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID => self::CREDENTIAL_INVALID,
        Zend_Auth_Result::FAILURE_UNCATEGORIZED      => self::UNCATEGORIZED_AUTH_ERROR
    );

    /**
     * Message templates
     * @var     array
     */
    protected $_messageTemplates = array(
        self::IDENTITY_NOT_FOUND       => 'Identity not found',
        self::IDENTITY_AMBIGUOUS       => 'Identity was ambiguous',
        self::CREDENTIAL_INVALID       => 'Credential is invalid',
        self::UNCATEGORIZED_AUTH_ERROR => 'General authentication failure',
        self::MISSING_FIELD            => 'Missing field'
    );

    /**
     * Auth adapter object
     * @var     Zend_Auth_Adapter_Interface
     */
    private $_adapter;

    /**
     * Auth object
     * @var     Zend_Auth
     */
    private $_auth;

    /**
     * Credential field
     * @var     string
     */
    private $_credentialField;

    /**
     * Identity field
     * @var     string
     */
    private $_identityField;

    /**
     * Constructor
     *
     * @param   string  $identityField
     * @param   string  $credentialField
     */
    public function __construct($identityField = null, $credentialField = null)
    {
        $this->_identityField   = $identityField;
        $this->_credentialField = $credentialField;
    }

    /**
     * Get the authentication adapter object
     *
     * @return  Zend_Auth_Adapter_Interface
     */
    public function getAdapter()
    {
        if (!$this->_adapter) {
            /** Zend_Controller_Action_HelperBroker */
            require_once 'Zend/Controller/Action/HelperBroker.php';
            $this->_adapter = Zend_Controller_Action_HelperBroker::getStaticHelper('AuthAdapter')
                                                                 ->direct();
        }
        return $this->_adapter;
    }

    /**
     * Get the authentication object
     *
     * @return  Zend_Auth
     */
    public function getAuth()
    {
        if (!$this->_auth) {
            /** Zend_Controller_Action_HelperBroker */
            require_once 'Zend/Controller/Action/HelperBroker.php';
            $this->_auth = Zend_Controller_Action_HelperBroker::getStaticHelper('Auth')
                                                              ->direct();
        }
        return $this->_auth;
    }

    /**
     * Get the credential field
     *
     * @return  string
     */
    public function getCredentialField()
    {
        if (!$this->_credentialField) {
            $this->_credentialField = self::DEFAULT_CREDENTIAL_FIELD;
        }
        return $this->_credentialField;
    }

    /**
     * Get the identity field
     *
     * @return  string
     */
    public function getIdentityField()
    {
        if (!$this->_identityField) {
            $this->_identityField = self::DEFAULT_IDENTITY_FIELD;
        }
        return $this->_identityField;
    }

    /**
     * Set the authentication adapter object
     *
     * @param   Zend_Auth_Adapter_Interface     $adapter
     * @return  Rend_Validate_Authentication
     */
    public function setAdapter(Zend_Auth_Adapter_Interface $adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }

    /**
     * Set the authentication object
     *
     * @param   Zend_Auth   $auth
     * @return  Rend_Validate_Authentication
     */
    public function setAuth(Zend_Auth $auth)
    {
        $this->_auth = $auth;
        return $this;
    }

    /**
     * Set the credential field
     *
     * @param   string  $credentialField
     * @return  Rend_Validate_Authentication
     */
    public function setCredentialField($credentialField)
    {
        $this->_credentialField = $credentialField;
        return $this;
    }

    /**
     * Set the identity field
     *
     * @param   string  $identityField
     * @return  Rend_Validate_Authentication
     */
    public function setIdentityField($identityField)
    {
        $this->_identityField = $identityField;
        return $this;
    }

    /**
     * Validate
     */
    public function isValid($value, $context = null)
    {
        if (!isset($context[$this->_identityField])) {
            $this->_error(self::MISSING_FIELD);
            return false;
        }

        if (!isset($context[$this->_credentialField])) {
            $this->_error(self::MISSING_FIELD);
            return false;
        }

        $adapter = $this->getAdapter();

        $adapter->setIdentity($context[$this->_identityField])
                ->setCredential($context[$this->_credentialField]);

        $result = $this->getAuth()
                       ->authenticate($adapter);

        if (!$result->isValid()) {
            $this->_error($this->_codesToErrors[$result->getCode()]);
            return false;
        }

        return true;
    }

}
