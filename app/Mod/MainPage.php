<?php

namespace Generator\Mod;

class MainPage extends Base
{
    public function execute()
    {
        $template = $this->getTemplate('main_container.html');
        return $template->render(['some_var' => 'template']);
    }
}
