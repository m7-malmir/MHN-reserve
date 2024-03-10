<?php
trait Controller
{
    public function view($name)
    {
        $filename = "../app/views/".$name.".view.php";
        if (file_exists($filename)) {
            require_once $filename;
        } else {
            $filename = "../app/views/404.view.php";
            require_once $filename;
        }
    }
}