<?php


namespace App\Controllers;

use App\Controller;
use App\Models\Article;
use App\View;

class Index extends Controller
{

    protected function handle()
    {
        $data = Article::loadAll();
        $view = new View();
        $view->articles = $data;
        $view->render(__DIR__.'/../../Templates/index.php');
        $view->display();
    }

}