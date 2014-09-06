<?php
/**
 * main allegro generator class
 *
 * @category    BlueFramework
 * @package     modules
 * @subpackage  generator
 * @author      Michał Adamiak    <chajr@bluetree.pl>
 * @copyright   chajr/bluetree
 * @version     0.3.0
 */
class allegro_generator extends module_class
{
    public $requireLibraries    = [];
    public $requireModules      = [];

    const TEMPLATE_DIR = 'modules/allegro_generator/layouts/user_layouts/';

    /**
     * information that use is logged in
     * 
     * @var bool
     */
    protected $_verification;

    /**
     * running module method
     */
    public function run()
    {
        $this->_verification = log_class::verifyUser();

        if ($this->_verification) {
            $this->layout('index');
            $this->_showUserAddForm();
        }
    }

    /**
     * show add form template for current user
     */
    protected function _showUserAddForm()
    {
        $userId      = $this->_getUserId();
        $path        = self::TEMPLATE_DIR . $userId . '/add_form.html';
        $independent = new display_class([
            'independent' => true,
            'template'    => $path
        ]);

        $this->generate('user_template', $independent->render());
    }

    /**
     * get user id from session
     * 
     * @return null|int
     */
    protected function _getUserId()
    {
        $userData = $this->session->returns('user');

        if (isset($userData['log_class_uid'])) {
            return $userData['log_class_uid'];
        }

        return null;
    }

    public function runErrorMode(){}
}
