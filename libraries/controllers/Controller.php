<?php

namespace Controllers;

require_once('libraries/utils.php');

class Controller
{
    protected $model;
    protected $modelName = "\Models\Article";

    public function __construct()
    {
        $this->model = new $this->modelName();
    }


}
?>