<?php

namespace Test\Mod;

use Generator\Mod\MainPage;

class MainPageTest extends \PHPUnit_Framework_TestCase
{
    public function testMainPage()
    {
        $app = $this->_getApp();
        $mod = new MainPage();

        $this->assertEquals('yupi', $mod->execute($app));
    }

    protected function _getApp()
    {
        return new \Slim\Slim;
    }
}
