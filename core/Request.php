<?php

namespace core;

class Request
{
    private $post;
    private $get;
    private $files;
    private $cookie;
    private $session;
    private $request;
    private $server;

    public function __construct($post, $get, $files, $cookie, $session, $request, $server)
    {
        $this->post = $post;
        $this->get = $get;
        $this->files = $files;
        $this->cookie = $cookie;
        $this->session = $session;
        $this->request = $request;
        $this->server = $server;
    }

    public static function createFromGlobals()
    {
        session_start();
        return new Request($_POST, $_GET, $_FILES, $_COOKIE, $_SESSION, $_REQUEST, $_SERVER);
    }
    public function getPost($key = null)
    {
        if(is_null($key)){
        return $this->post;
        }
        if(isset($this->post[$key])){
            return $this->post[$key];
        }
        return null;
    }
    public function getGet()
    {
        return $this->get;
    }
    public function getFiles()
    {
        return $this->files;
    }
    public function getCookie()
    {
        return $this->cookie;
    }
    public function getSession()
    {
        return $this->session;
    }
    public function getRequest()
    {
        return $this->request;
    }
    public function getServer()
    {
        return $this->server;
    }
}

