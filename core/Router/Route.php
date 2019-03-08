<?php

namespace Core\Router;


use Core\Request;

class Route
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $parameters;
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $action;
    /**
     * @var
     */
    private $args;

    /**
     * Route constructor.
     * @param string $name
     * @param string $path
     * @param array $parameters
     * @param string $controller
     * @param string $action
     */

    public function __construct($name, $path, array $parameters, $controller, $action)
    {
        $this->name = $name;
        $this->path = $path;
        $this->parameters = $parameters;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @return mixed
     */

    public function call($request, $router)
    {
        $controller = $this->controller;
        $controller = new $controller($request, $router);
        return call_user_func_array([$controller, $this->action], $this->args);
    }


    /**
     * @param string $requestUri
     * @return bool
     */
    public function match($requestUri)
    {

        $path = preg_replace_callback("/:(\w+)/", [$this, "parameterMatch"], $this->path);
        $path = str_replace("/", "\/", $path);
        if (!preg_match("/^$path$/i", $requestUri, $matches)) {
            return false;
        }
        $this->args = array_slice($matches,1);
        return true;
    }

    private function parameterMatch($match)
    {
        if(isset($this->parameters[$match[1]])) {
            return sprintf("(%s)",$this->parameters[$match[1]]);
        }

        return '([^/]+)';
    }

    /**
     * @param $args
     * @return string
     */
    public function generateUrl($args)
    {
        // On remplace chaque paramètre du chemin par les arguments transmis
        $url = str_replace(array_keys($args), $args, $this->path);
        // On supprime les ":"
        $url = str_replace(":", "", $url);

        return $url;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }
    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

}


