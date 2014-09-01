<?php
/**
 * main module, depends of given parameters runs some useful functions
 * module always run on all pages and subpages
 * 
 * @category    BlueFramework
 * @package     modules
 * @subpackage  main
 * @author      Michał Adamiak    <chajr@bluetree.pl>
 * @copyright   chajr/bluetree
 * @version     1.0.0
 */
class main extends module_class
{
    public $requireLibraries    = [];
    public $requireModules      = [];

    /**
     * running module method
     */
    public function run()
    {
        
    }

    public function runErrorMode(){}
}
