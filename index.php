<?php

include __DIR__.'/App/autoload.php';

$error = new \App\DbException('Db crash', 100);

$class = $_GET['ctrl'] ?? 'Index';
$class = 'App\Controllers\\'.$class;

$ctrl = new $class;
try {
    $ctrl->action();
} catch (\App\DbException $err) {
    echo 'Ошибка в базе данных:'.$err->getMessage().$err->getQuery().'.';
} catch (Exception $err) {
    echo $err->getMessage();
    die();
}



