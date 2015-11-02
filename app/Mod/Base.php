<?php

namespace Generator\Mod;

use Slim\Slim;

abstract class Base
{
    /**
     * @var \Slim\Slim
     */
    protected $_app;

    /**
     * force to create execute method
     *
     * @return mixed
     */
    abstract public function execute();

    /**
     * set up application
     *
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->_app = $app;
    }

    /**
     * get template object
     *
     * @param string $templateName
     * @return \Twig_TemplateInterface
     */
    public function getTemplate($templateName)
    {
        $config = [];

        if ($this->_app->config('app')['cache']['enabled']) {
            $config['cache'] = $this->_app->config('app')['cache']['dir'];
        }

        $loader     = new \Twig_Loader_Filesystem('../app/templates');
        $twig       = new \Twig_Environment($loader, $config);
        $template   = $twig->loadTemplate($templateName);

        return $template;
    }
}
