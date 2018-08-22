<?php
    /*  This is the default controller  */
    class Home extends Controller
    {
        #   Default function to be called  
        public function get()
        {
            $welcome = "Welcome to Ease";
            $tagline = "Easy, Holistic, Independent Web development";
            $this->loadView('', ['welcome' => $welcome, 'tagline' => $tagline]);
        }
    }