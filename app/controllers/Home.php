<?php
class Home
{
    use Controller;
    public function index()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            show($_POST);
        }
        $data=new Model;
        $data->select();
        $this->view('home');
    }
}