<?php

namespace App\Controller;

class TestsController extends AppController
{
    public function foo()
    {
        $this->render('vue'); // foo.blade.php
    }

    public function bar($var)
    {
        $this->render('bar', ['bar' => $var, '_1' => 'un', '_2' => 'deux']);
    }

    public function redirection($args)
    {
        $this->redirect('testsBar', ['param' => $args]);
    }

}