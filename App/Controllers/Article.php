<?php


namespace App\Controllers;

use App\Controller;
use App\View;

class Article extends Controller
{

    protected function handle()
    {
        $data = \App\Models\Article::loadById($_GET['id']);
        $view = new View();
        $view->article = $data;
        $view->render(__DIR__ . '/../../Templates/article.php');
        $view->display();
    }

}