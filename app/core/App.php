<?php
    /*
     *  This class serves as the entry point to our application.
    */
    class App
    {
        public function __construct()
        {
            session_start();        #   Start a session
            $request = new Request; #   Create a request object
        }
    } 