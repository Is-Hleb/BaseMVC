<?php


namespace App;


abstract class Controller
{
    abstract protected function handle();
    final public function action()
    {
        if($this->access())
            $this->handle();
        else
            View::notAccess();
    }

    protected function access() : bool
    {
        return true;
    }



}