<?php
spl_autoload_register(function($classname){
    require $filename='../app/models/'.$classname.".php";
  
});
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';

