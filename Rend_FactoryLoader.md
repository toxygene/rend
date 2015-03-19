# Description #
This class is specialized plugin loader that can be used to easily create and use factories.

# API #
| **Method** | **Description** |
|:-----------|:----------------|
| `getFactory(/* string */ $name)` | Get a factory by name. |

`Rend_FactoryLoader` also overloads the `__get()` and `__call()` methods:

| `->name` | Proxies to `getFactory()`. |
|:---------|:---------------------------|
| `->name()` | Get a factory by name and returns the result of it's `create()` method. |

# Integration with Rend #
If you use [Rend\_Controller\_Plugin\_Setup](Rend_Controller_Plugin_Setup.md), the `Rend_FactoryLoader` will automatically be created and setup with information from your configuration file.

```
factoryLoader.prefixPath.Pre_fix = Pre/Fix

factoryLoader.factories.database.type = Database_Pdo_Mysql
factoryLoader.factories.database.options.host = localhost
factoryLoader.factories.database.options.username = user
factoryLoader.factories.database.options.password = pass
factoryLoader.factories.database.options.schema = db

factoryLoader.factories.someName.type = View
factoryLoader.factories.someName.options.encoding = UTF-8
```