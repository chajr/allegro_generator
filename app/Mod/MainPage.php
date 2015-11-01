<?php

namespace Generator\Mod;

use Slim\Slim;

class MainPage extends Base
{
    public function execute(Slim $app)
    {
        $loader = new \Twig_Loader_Filesystem('../app/templates');
        $twig = new \Twig_Environment($loader, array(
            'cache' => '../var/cache',
        ));
        $template = $twig->loadTemplate('main_container.html');

        return $template->render(['some_var' => 'template']);
    }
}
