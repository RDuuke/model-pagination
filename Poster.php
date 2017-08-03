<?php

require_once 'Model.php';

class Poster extends Model
{
    protected $table = 'posters';
    protected $primaryKey = 'posterId';
    protected $url = 'index.php?page=';
}