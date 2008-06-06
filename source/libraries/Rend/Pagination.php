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
 * @package     Pagination
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/**
 * Pagination class
 *
 * @category    Rend
 * @package     Pagination
 */
class Rend_Pagination
{

    /**
     * Current page
     * @var     integer
     */
    private $_currentPage;

    /**
     * Options array
     * @var     array
     */
    private $_options = array(
        'firstText'    => 'First',
        'previousText' => 'Previous',
        'nextText'     => 'Next',
        'lastText'     => 'Last',
        'translator'   => null,
        'maxPages'     => null
    );

    /**
     * Items per page
     * @var     integer
     */
    private $_perPage;

    /**
     * Script to render
     * @var     string
     */
    private $_script;

    /**
     * Number of items
     * @var     integer
     */
    private $_totalItems;

    /**
     * View object
     * @var     Zend_View_Interface
     */
    private $_view;

    /**
     * Constructor
     *
     * @param   integer     $currentPage
     * @param   integer     $perPage
     * @param   integer     $totalItems
     * @param   array       $options
     */
    public function __construct($currentPage, $perPage, $totalItems, array $options = array())
    {
        $this->_currentPage = $currentPage;
        $this->_perPage     = $perPage;
        $this->_totalItems  = $totalItems;

        $this->_options = array_merge(
            $this->_options,
            $options
        );
    }

    /**
     * Get the current page
     *
     * @return  integer
     */
    public function getCurrentPage()
    {
        return $this->_currentPage;
    }

    /**
     * Get the number of pages
     *
     * @return  integer
     */
    public function getPages()
    {
        return max(
            1,
            ceil($this->_totalItems / $this->_perPage)
        );
    }

    /**
     * Get the total number of items
     *
     * @return  integer
     */
    public function getTotalItems()
    {
        return $this->_totalItems;
    }

    /**
     * Retrieve the script name
     *
     * @return  string
     */
    public function getScript()
    {
        return $this->_script;
    }

    /**
     * Set the script name
     *
     * @param   string              $script
     * @return  Rend_Pagination
     */
    public function setScript($script = null)
    {
        $this->_script = $script;
        return $this;
    }

    /**
     * Retrieve view object
     *
     * If none registered, attempts to pull from ViewRenderer.
     *
     * @return  Zend_View_Interface
     */
    public function getView()
    {
        if (null === $this->_view) {
            /** Zend_Controller_Action_HelperBroker */
            require_once 'Zend/Controller/Action/HelperBroker.php';

            $this->_view = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->view;
        }

        return $this->_view;
    }

    /**
     * Set view object
     *
     * @param   Zend_View_Interface     $view
     * @return  Rend_Pagination
     */
    public function setView(Zend_View_Interface $view = null)
    {
        $this->_view = $view;
        return $this;
    }

    /**
     * Render pagination
     *
     * @param   Zend_View_Interface     $view
     * @return  string
     */
    public function render(Zend_View_Interface $view = null)
    {
        if (null === $view) {
            $view = $this->getView();
        }

        $script = $this->getScript();
        if (!$script) {
            $view->addScriptPath(dirname(__FILE__) . '/Pagination');
            $script = 'script.phtml';
        }

        $view->currentPage = $this->_currentPage;
        $view->perPage     = $this->_perPage;
        $view->totalItems  = $this->_totalItems;
        $view->totalPages  = $this->getPages();

        if ($this->_options['maxPages']) {
            $window = floor($this->_options['maxPages'] / 2);

            $view->startPage = max(1, $view->currentPage - $window);
            $view->lastPage  = min($view->totalPages, $view->currentPage + $window);
        } else {
            $view->startPage = 1;
            $view->lastPage  = $view->totalPages;
        }

        if ($this->_options['translator']) {
            $view->firstText    = $this->_options['translator']->translate($this->_options['firstText']);
            $view->previousText = $this->_options['translator']->translate($this->_options['previousText']);
            $view->nextText     = $this->_options['translator']->translate($this->_options['nextText']);
            $view->lastText     = $this->_options['translator']->translate($this->_options['lastText']);
        } else {
            $view->firstText    = $this->_options['firstText'];
            $view->previousText = $this->_options['previousText'];
            $view->nextText     = $this->_options['nextText'];
            $view->lastText     = $this->_options['lastText'];
        }

        return $view->render($script);
    }

    /**
     * Serialize as string
     *
     * Proxies to {@link render()}.
     *
     * @return  string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
            return '';
        }
    }

}
