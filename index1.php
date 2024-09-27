<?php


use Blog\LatestPosts;
use Blog\PostMapper;
use Blog\Slim\TwigMiddleware;
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions('config/di.php');

$container = $builder->build();

AppFactory::setContainer($container);

$view = $container->get(Environment::class);

$config = include 'config/database.php';
$dsn = $config['dsn'];
$username = $config['username'];
$password = $config['password'];

try {
    // $connection = new PDO($dsn, $username, $password);
    $connection = new PDO('mysql:host=127.0.0.1;dbname=php_blog', "root", "1234");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch (PDOException $exception){
    echo 'Database error: ' . $exception->getMessage();
    die();
}

$app = AppFactory::create();
$app->add(new TwigMiddleware($view));

$app->get('/', function (Request $request, Response $response) use ($view, $connection) {
    $latestPosts = new LatestPosts($connection);
    $posts = $latestPosts->get(2);
    $body = $view->render('index.twig', [
        'posts' => $posts
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function (Request $request, Response $response) use ($view) {
    $body = $view->render('about.twig', [
        'name' => "Andrew"
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/blog[/{page}]', function (Request $request, Response $response, $args) use ($view, $connection) {
    $postMapper = new PostMapper($connection);
    $page = isset($args['page']) ? (int) $args['page'] : 1;
    $limit = 2;
    $posts = $postMapper->getList($page, $limit, 'DESC');
    $totalCount = $postMapper->getTotalCount();
    $body = $view->render('blog.twig', [
        'posts' => $posts,
        'pagination' => [
            'current' => $page,
            'paging' => ceil($totalCount / $limit)
        ]
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function (Request $request, Response $response, $args) use ($view, $connection) {
    $postMapper = new PostMapper($connection);
    $post = $postMapper->getByUrlKey((string) $args['url_key']);

    if(empty($post)){
        $body = $view->render('not-found.twig');
    }else{
        $body = $view->render('post.twig', [
            'post' => $post
        ]);
    }

    $response->getBody()->write($body);
    return $response;
});

$app->run();
