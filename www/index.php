<?php
require_once '../vendor/autoload.php';

$app    = new \Slim\Slim();
$config = json_decode(file_get_contents('../app/config/config.json'), true);

$app->config($config);

try {
    foreach ($app->config('routes') as $route) {
        $app->$route['method'](
            $route['route'],
            function () use ($route, $app) {
                $name = '\\' . $route['module'];

                /** @var Generator\Mod\Base $mod */
                $mod = new $name;

                $mod->execute($app);
            }
        );
    }
} catch (\Exception $e) {
    $app->response->body('Error: ' . $e->getMessage());
}

$app->run();
