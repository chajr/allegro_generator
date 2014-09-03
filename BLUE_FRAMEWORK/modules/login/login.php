<?php
/**
 * log in user
 *
 * @category    BlueFramework
 * @package     modules
 * @subpackage  login
 * @author      Michał Adamiak    <chajr@bluetree.pl>
 * @copyright   chajr/bluetree
 * @version     0.1.0
 */

class login extends module_class
{
    public $required_libs       = array('log_class');
    public $required_modules    = array('connection');

    const USER_PASS = '';

    /**
     * lunch module
     */
    public function run()
    {
        log_class::setSessionModel($this->session);

        $this->_logoutInfo();
        if ($this->get->logout === 'true') {
            log_class::logOff();
            $this->session->set('logout', true);
            header('Location: /');
            exit;
        }

        if ($this->post->login === 'yes') {
            $this->_checkLoginData();
        } else {
            $this->_checkIsLogged();
        }
    }

    /**
     * show log out info
     */
    protected function _logoutInfo()
    {
        if (isset($this->session->logout) && $this->session->logout === true) {
            $this->error('ok', '', 'Jesteś wylogowany');
        }
        $this->session->clear('logout');
    }

    /**
     * check log in data
     */
    protected function _checkLoginData()
    {
        if ($this->post->password) {
            $this->_checkUser();
        } else {
            $this->_showLoginForm();
            $this->error('critic', '', 'Musisz podać hasło');
        }
    }

    /**
     * check that user is log in
     * 
     * @throws LibraryException
     */
    protected function _checkIsLogged()
    {
        $verification = log_class::verifyUser();
        if (!$verification) {
            $this->_showLoginForm();
        }
    }

    /**
     * show login form
     */
    protected function _showLoginForm()
    {
        $this->layout('form');
        $this->_showDescription();
    }

    /**
     * check that user should be log in
     */
    protected function _checkUser()
    {
        $hashPass = hash('sha256', $this->post->password);

        if (self::USER_PASS === $hashPass) {
            log_class::logOn(1, 1, 1);
        } else {
            $this->_showLoginForm();
            $this->error('critic', '', 'Nieprawidłowe hasło');
        }
    }

    /**
     * show log in description
     */
    protected function _showDescription()
    {
        $description = 'Witaj w generatorze aukcji allegro';
        $this->generate('description', $description, 1);
    }

    public function runErrorMode(){}
}