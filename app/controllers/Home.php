<?php
class Home
{
    use Controller;
    public function index()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            show($_POST);
        }
        $this->view('home');
    }
}