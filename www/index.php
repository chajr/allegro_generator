<?php
require_once '../vendor/autoload.php';

$envConfig = [];

if (isset($_SERVER['HTTP_ENVIRONMENT_MOD'])) {
    $environment = $_SERVER['HTTP_ENVIRONMENT_MOD'];
    $envConfig = json_decode(
        file_get_contents('../app/config/config_' . $environment . '.json'),
        true
    );
}

$app    = new \Slim\Slim();
$config = json_decode(file_get_contents('../app/config/config.json'), true);

$app->config($config + $envConfig);

try {
    foreach ($app->config('routes') as $route) {
        $app->$route['method'](
            $route['route'],
            function () use ($route, $app) {
                $name = '\\' . $route['module'];

                /** @var Generator\Mod\Base $mod */
                $mod = new $name($app);

                $response = $mod->execute();

                $app->response->setStatus(200);
                $app->response->setBody($response);
            }
        );
    }
} catch (\Exception $e) {
    $app->response->body('Error: ' . $e->getMessage());
}

$app->run();
