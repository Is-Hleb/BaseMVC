<?php


namespace App;


use Throwable;

class DbException extends \Exception
{
    protected $query;
    public function __construct($query, $message = "", $code = 0, Throwable $previous = null)
    {
        if($query != "")
            $this->query = '" '.$query.' "';
        parent::__construct($message, $code, $previous);
    }
    public function getQuery()
    {
        return $this->query;
    }
}