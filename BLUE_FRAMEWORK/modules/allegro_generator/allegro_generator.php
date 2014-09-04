<?php
/**
 * main allegro generator class
 *
 * @category    BlueFramework
 * @package     modules
 * @subpackage  generator
 * @author      Michał Adamiak    <chajr@bluetree.pl>
 * @copyright   chajr/bluetree
 * @version     0.2.0
 */
class allegro_generator extends module_class
{
    public $requireLibraries    = [];
    public $requireModules      = [];

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
        }
        
    }

    public function runErrorMode(){}
}
