<?php


namespace App;


class View
{
    protected $data = [];
    protected $page = "";

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if(isset($this->data[$name]))
            return $this->data[$name];
        return null;
    }


    public function __isset($name)
    {
        return isset($this->data['name']);
    }

    public function render($path)
    {
        ob_start();
        include $path;
        $this->page = ob_get_clean();
        $this->page;

    }

    public function display()
    {
        echo $this->page;
    }

    public static function notAccess()
    {
        include __DIR__.'/../templates/static/NotAccess.php';
    }

}