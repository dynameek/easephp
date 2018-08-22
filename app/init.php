<?php
    /*
     *  IMPORT CORE CLASSES
     *  *******************
    */
    function __autoload($class)
    {
        require_once('core/'.$class.'.php');
    }
    /*  Create a new App object */
    $app = new App;                 