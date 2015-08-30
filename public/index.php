<?php
require '../vendor/autoload.php';

// Constants
define('base_path', dirname(__DIR__));
define('app_path', base_path . DIRECTORY_SEPARATOR . 'app');
define('content_path', base_path . DIRECTORY_SEPARATOR . 'content');
define('layouts_path', base_path . DIRECTORY_SEPARATOR . 'layouts');

// We start Slim and create a new PagesCollection
$app = new \Slim\Slim(['debug' => true]);
$pages = new \App\PagesCollection();

// Let's load all the helpers funtions
require app_path . DIRECTORY_SEPARATOR . 'helpers.php';

// Let's create a route for every YAML file in the content directory
foreach($pages as $page){
    // We use any cause we may need to access some page using POST to create forms for instance
    $app->any($page->getUrl(), function() use ($page, $app){
        echo $page->render();
    })->name($page->getName());
}

// Let's run our awesome app
$app->run();
