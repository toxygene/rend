# Description #
This class is the abstract base class for the `Rend_Factory_Database_*` classes.

# API #
| **Method** | **Description** |
|:-----------|:----------------|
| `setAutoQuoteIdentifiers(/* boolean */ $autoQuoteIdentifiers)` | Sets the auto-quote identifiers flag. |
| `setCaseFolding(/* boolean */ $caseFolding)` | Sets the case folding value. Valid values: `natural`, `lower`, `upper`. |
| `setFetchMode(/* integer */ $fetchMode)` | Sets the default fetch mode. Valid values: `lazy`, `assoc`, `num`, `both`, `named`, `obj`. |
| `setHost(/* string */ $host)` | Sets the host to connect to. |
| `setPassword(/* string */ $password)` | Sets the password to use when connecting to the host. |
| `setPersistent(/* boolean */ $persistent)` | Set the persistent connection flag. |
| `setProfiler(/* ? */ $profiler)` | Set the profiler. |
| `setProtocol(/* mixed */ $protocol)` | Set the connection protocol. Accepts: `Zend_Db_Profiler`, `Zend_Config`, `array`, `boolean`. |
| `setSchema(/* string */ $schema)` | Sets the schema (database name) to use after connecting to the host. |
| `setStatementClass(/* string */ $statementClass)` | Set the statement class. |
| `setUsername(/* string */ $username)` | Sets the username to use when connecting to the host. |