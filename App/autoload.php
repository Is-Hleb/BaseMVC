<?php

function vardump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '<pre>';
}

spl_autoload_register(function($name){
    $path = __DIR__ . '/../' . str_replace('\\', '/', $name) . '.php';;
    if(file_exists($path))
        include $path;
    else {
        echo 'Такая страница не найдена :( <hr><br> Вернуться <a href="index.php">назад</a>';
        die();
    }
});

