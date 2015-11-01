<?php

namespace Generator\Mod;

use Slim\Slim;

class MainPage extends Base
{
    public function execute(Slim $app)
    {
        $config = [];

        if ($app->config('app')['cache']['enabled']) {
            $config['cache'] = $app->config('app')['cache']['dir'];
        }

        $loader     = new \Twig_Loader_Filesystem('../app/templates');
        $twig       = new \Twig_Environment($loader, $config);
        $template   = $twig->loadTemplate('main_container.html');

        return $template->render(['some_var' => 'template']);
    }
}
