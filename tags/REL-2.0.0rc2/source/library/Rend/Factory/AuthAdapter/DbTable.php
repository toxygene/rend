<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Rend_Factory_AuthAdapter_Interface */
require_once "Rend/Factory/AuthAdapter/Interface.php";

/**
 *
 */
class Rend_Factory_AuthAdapter_DbTable extends Rend_FactoryLoader_Factory_Abstract implements Rend_Factory_AuthAdapter_Interface
{

    /**
     * Credential column
     * @var string
     */
    private $_credentialColumn;

    /**
     * Credential treatment
     * @var string
     */
    private $_credentialTreatment;

    /**
     * Identity column
     * @var string
     */
    private $_identityColumn;

    /**
     * Database adapter
     * @var Zend_Db_Adapter_Abstract
     */
    private $_databaseAdapter;

    /**
     * Table name
     * @var string
     */
    private $_tableName;

    /**
     * Create an DbTable auth adapter
     *
     * @return Zend_Auth_Adapter_DbTable
     */
    public function create()
    {
        /** Zend_Auth_Adapter_DbTable */
        require_once "Zend/Auth/Adapter/DbTable.php";

        return new Zend_Auth_Adapter_DbTable(
            $this->_databaseAdapter,
            $this->_tableName,
            $this->_identityColumn,
            $this->_credentialColumn,
            $this->_credentialTreatment
        );
    }

    /**
     * Set the credential column
     *
     * @param string $credentialColumn
     * @return Rend_Factory_AuthAdapter_DbTable
     */
    public function setCredentialColumn($credentialColumn)
    {
        $this->_credentialColumn = $credentialColumn;
        return $this;
    }

    /**
     * Set the credential treatment
     *
     * @param string $credentialTreatment
     * @return Rend_Factory_AuthAdapter_DbTable
     */
    public function setCredentialTreatment($credentialTreatment)
    {
        $this->_credentialTreatment = $credentialTreatment;
        return $this;
    }

    /**
     * Set the database adapter
     *
     * @param Zend_Db_Adapter_Abstract $databaseAdapter
     * @return Rend_Factory_AuthAdapter_DbTable
     */
    public function setDatabaseAdapter(Zend_Db_Adapter_Abstract $databaseAdapter)
    {
        $this->_databaseAdapter = $databaseAdapter;
        return $this;
    }

    /**
     * Set the identity column
     *
     * @param string $identityColumn
     * @return Rend_Factory_AuthAdapter_DbTable
     */
    public function setIdentityColumn($identityColumn)
    {
        $this->_identityColumn = $identityColumn;
        return $this;
    }

    /**
     * Set the table name
     *
     * @param string $tableName
     * @return Rend_Factory_AuthAdapter_DbTable
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
        return $this;
    }

}
