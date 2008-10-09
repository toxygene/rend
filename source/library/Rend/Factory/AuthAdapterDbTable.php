<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_AuthAdapter_Interface */
require_once 'Rend/Factory/AuthAdapter/Interface.php';

/** Zend_Auth_Adapter_DbTable */
require_once 'Zend/Auth/Adapter/DbTable.php';

/**
 *
 */
class Rend_Factory_AuthAdapterDbTable extends Rend_Factory_Abstract implements Rend_Factory_AuthAdapter_Interface
{

    /**
     * @var     string
     */
    private $_credentialColumn;

    /**
     * @var     string
     */
    private $_credentialIdentity;

    /**
     * @var     string
     */
    private $_identityColumn;

    /**
     * @var     Zend_Db_Adapter_Abstract
     */
    private $_databaseAdapter;

    /**
     * @var     string
     */
    private $_tableName;

    /**
     * @return  Zend_Auth_Adapter_DbTable
     */
    public function create()
    {
        if ($this->_databaseAdapter) {
            $databaseAdapter = $this->_databaseAdapter;
        } else {
            $databaseAdapter = $this->_factoryLoader
                                    ->database();
        }

        return new Zend_Auth_Adapter_DbTable(
            $databaseAdapter,
            $this->_tableName,
            $this->_identityColumn,
            $this->_credentialColumn,
            $this->_credentialTreatment
        );
    }

    /**
     *
     */
    public function setCredentialColunn($credentialColumn)
    {
        $this->_credentialColumn = $credentialColumn;
        return $this;
    }

    /**
     *
     */
    public function setCredentialTreatment($credentialTreatment)
    {
        $this->_credentialTreatment = $credentialTreatment;
        return $this;
    }

    /**
     *
     */
    public function setDatabaseAdapter(Zend_Db_Adapter_Abstract $databaseAdapter)
    {
        $this->_databaseAdapter = $databaseAdapter;
        return $this;
    }

    /**
     *
     */
    public function setIdentityColumn($identityColumn)
    {
        $this->_identityColumn = $identityColumn;
        return $this;
    }

    /**
     *
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
        return $this;
    }

}
