<?php


namespace App\Models;
use App\Db;
use App\Model;

class User extends Model
{
    public const TABLE = 'users';
    public const SEARCH_ARGS = ['login'];
    public $login;
    public $password;
}