# Description #
Rend breaks the dispatch script into three parts to make reuse easier.

## common.php ##
This file is for setup of the PHP environment.
  * Error handling
  * Include paths
  * Timezone

By separating the PHP environment setup from the dispatching script, developers can then use the common.php file in other non-web scripts, like cronjobs.

## setup.php ##
This file is used for application-specific code for setting up the Front Controller. This typically involves setting custom routes and parameters.

## index.php ##
This file is for web dispatches. It uses the common.php file to setup the PHP environment and the setup.php file to do additional configuration of the Front Controller, then dispatches the request.