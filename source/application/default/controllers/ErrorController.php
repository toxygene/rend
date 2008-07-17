<?php
/**
 * Rend
 *
 * @category   Rend
 * @package    Controller
 * @subpackage Default
 */

/** Project_Controller_Action */
require_once 'Project/Controller/Action.php';

/**
 * @category   Rend
 * @package    Controller
 * @subpackage Default
 */
class ErrorController extends Project_Controller_Action
{

    /**
     * Error handler
     *
     * This action is used by the Zend_Controller_Plugin_ErrorHandler for
     * catching unhandled exceptions.
     */
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        if ($this->_helper->config()->display_errors) {
            $this->view->errors = $errors;
        }

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                $this->_forward('page-not-found');
                break;

            default:
                $this->_helper
                     ->log($errors->exception->getMessage(), 3);

                switch (get_class($errors->exception)) {
                    case 'Rend_Controller_Action_Exception_Auth':
                        $this->_forward('unauthorized');
                        break;

                    case 'Rend_Controller_Action_Exception_Acl':
                        $this->_forward('forbidden');
                        break;

                    default:
                        $this->_forward('internal-error');
                        break;
                }
                break;
        }
    }

    /**
     * Action for handling '401 Unauthorized' errors
     */
    public function unauthorizedAction()
    {
        $this->getResponse()
             ->setHttpResponseCode(401);
    }

    /**
     * Action for handling '403 Forbidden' errors
     */
    public function forbiddenAction()
    {
        $this->getResponse()
             ->setHttpResponseCode(403);
    }

    /**
     * Action for handling '404 Not Found' errors
     */
    public function pageNotFoundAction()
    {
        $this->getResponse()
             ->setHttpResponseCode(404);
    }

    /**
     * Action for handling '500 Internal Server Error' errors
     */
    public function internalErrorAction()
    {
        $this->getResponse()
             ->setHttpResponseCode(500);
    }

}
