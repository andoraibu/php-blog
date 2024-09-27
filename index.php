<?php


use Blog\LatestPosts;
use Blog\PostMapper;
// use Blog\Slim\TwigMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;
use Slim\Views\Twig;
use Twig\Environment;
use DI\ContainerBuilder;
use Slim\Views\TwigMiddleware;



require __DIR__ . "/vendor/autoload.php";

try {
    // $connection = new PDO($dsn, $username, $password);
    $connection = new PDO('mysql:host=127.0.0.1;dbname=php_blog', "root", "1234");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    if ($connection){
        echo "Connected to DB\n";
    }
}catch (PDOException $exception){
    echo 'Database error: ' . $exception->getMessage();
    die();
}

require __DIR__ . '/vendor/autoload.php';

// Create Container
$container = new Container();

// Set view in Container
$container->set(Twig::class, function() {
    return Twig::create(__DIR__ . '/templates', ['cache' => false]);
});

// Create App from container
$app = AppFactory::createFromContainer($container);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));
// $app->add(new TwigMiddleware($view));

// Add other middleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// $view = $container->get(Environment::class);

$app->get('/', function ($request, $response) use ($connection){
    $latestPosts = new LatestPosts($connection);

    $posts = $latestPosts->get(2);
    $twig = $this->get(Twig::class);
    // $body = $view->render('index.twig', [
    //     'posts' => $posts
    // ]);
    // $response->getBody()->write($body);


    return $twig->render($response, 'index.twig', $posts);

});



$app->run();