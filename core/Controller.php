<?php
namespace Core;
use Core\Router\Router;
use duncan3dc\Laravel\BladeInstance;

abstract class Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var BladeInstance
     */
    private $blade;

    /**
     * Controller constructor.
     *
     * @param Request $request
     * @param Router  $router
     */
    public function __construct(Request $request, Router $router)
    {
        $this->blade = new BladeInstance($request->getServer()['DOCUMENT_ROOT']. '/../src/View', $request->getServer()['DOCUMENT_ROOT'].'/../tmp/cache/views');

        $this->request = $request;
        $this->router = $router;
    }
    /**
     * @param       $routeName
     * @param array $args
     *
     * @throws \Exception
     */
    protected final function redirect($routeName, $args = [])
    {
        $route = $this->router->getRoute($routeName);
        header(sprintf("Location: %s", $route->generateUrl($args)));
    }

    public function render($filename, $args = [])
    {
        echo $this->blade->render($filename, $args);

        //header('Monheadercustom: Tada');
    }
}