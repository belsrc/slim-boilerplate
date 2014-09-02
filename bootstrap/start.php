<?php

use Slim\Slim;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Belsrc\Boilerplate\Middleware;

/*
|--------------------------------------------------------------------------
| Set Error Reporting
|--------------------------------------------------------------------------
*/
error_reporting(E_ALL | E_STRICT);
error_reporting(error_reporting() & ~E_NOTICE);
ini_set('display_errors', 'On');

/*
|--------------------------------------------------------------------------
| Get the Various Config Files
|--------------------------------------------------------------------------
*/
$paths    = require __DIR__.'/path.php';
$dbConf   = require $paths['app'].'/config/database.php';
$envConf  = require $paths['app'].'/config/environment.php';
$logConf  = require $paths['app'].'/config/log.php';
$viewConf = require $paths['app'].'/config/view.php';
$appConf  = require $paths['app'].'/config/app.php';

/*
|--------------------------------------------------------------------------
| Set Application Timezone
|--------------------------------------------------------------------------
*/
date_default_timezone_set($appConf['timezone']);

/*
|--------------------------------------------------------------------------
| Get Application Environment
|--------------------------------------------------------------------------
*/
$isProduction = in_array(gethostname(), $envConf['production']);
$environment = $isProduction ? 'production' : 'development';

/*
|--------------------------------------------------------------------------
| Set the Database Connection
|--------------------------------------------------------------------------
*/
$capsule = new Capsule();
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->addConnection($dbConf['connections'][$environment]);
$capsule->bootEloquent();

/*
|--------------------------------------------------------------------------
| Initialize the Slim App
|--------------------------------------------------------------------------
*/
$app = new Slim(array(
    'view'           => new \Slim\Views\Twig(),
    'templates.path' => $viewConf['view_path'],
    'mode'           => $environment,
    'debug'          => false,
    'log.level'      => \Slim\Log::DEBUG,
    'log.enable'     => true,
));

/*
|--------------------------------------------------------------------------
| Add Additional Information to the App Object
|--------------------------------------------------------------------------
*/
$app->paths = $paths;
$app->devError = $appConf['debug_error_string'];
$app->liveError = $appConf['live_error_string'];

/*
|--------------------------------------------------------------------------
| Set the Logging Information
|--------------------------------------------------------------------------
*/
$app->log->setEnabled($appConf['has_logging']);
$app->log->setWriter(new \Slim\Logger\DateTimeFileWriter(array(
    'message_format' => $logConf['log_message_format'],
    'path'           => $paths['base'] . '/log',
    'name_format'    => $logConf['log_name_format'],
    'extension'      => $logConf['log_extension'],
)));

/*
|--------------------------------------------------------------------------
| Set the View Information
|--------------------------------------------------------------------------
*/
$view = $app->view();
$view->parserDirectory = 'Twig';
$view->setTemplatesDirectory($viewConf['view_path']);
$view->parserOptions = array(
    'debug'       => true,
    'auto_reload' => true,
    'cache'       => $viewConf['cache_path'],
);
$uri      = $app->request->getResourceUri();
$hostUrl  = $app->request->getRootUri() . '/../';
$rootPath = $app->request->getRootUri() . '/';
$view->appendData(array(
    'uri'     => $uri,
    'root'    => $hostUrl,
    'baseurl' => $rootPath
));

/*
|--------------------------------------------------------------------------
| Set App Error Handler
|--------------------------------------------------------------------------
*/
$app->error(function(\Exception $e) use($app) {
    $app->log->error($e);
    if($app->getMode() == 'development') {
        $s = sprintf($app->devError, get_class($e), $e->getMessage(), $e->getFile(), $e->getLine());
        $app->response->body(json_encode(array(
            'code' => 'Error',
            'data' => $s
        )));
    }
    else {
        $app->response->body(json_encode(array(
            'code' => 'Error',
            'data' => $app->liveError
        )));
    }
});

/*
|--------------------------------------------------------------------------
| Set Some Middleware
|--------------------------------------------------------------------------
*/
$app->add(new Middleware\RouteLoaderMiddleware());
$app->add(new Middleware\AuthMiddleware(
    $appConf['auth_section'],
    $appConf['auth_cookie'],
    $appConf['auth_redirect']
));

/*
|--------------------------------------------------------------------------
| Return the App Object
|--------------------------------------------------------------------------
*/
return $app;
