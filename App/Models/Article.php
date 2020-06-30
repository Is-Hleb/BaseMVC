<?php


namespace App\Models;

use App\Db;
use App\Model;

class Article extends Model
{
    public const TABLE = 'news';
    public const SEARCH_ARGS = ['content'];

    public $title;
    public $content;


}