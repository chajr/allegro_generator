<?php
/**
 * main allegro generator class
 *
 * @category    BlueFramework
 * @package     modules
 * @subpackage  generator
 * @author      Michał Adamiak    <chajr@bluetree.pl>
 * @copyright   chajr/bluetree
 * @version     0.1.0
 */
class allegro_generator extends module_class
{
    public $requireLibraries    = [];
    public $requireModules      = [];

    /**
     * running module method
     */
    public function run()
    {
        $this->layout('index');
    }

    public function runErrorMode(){}
}
