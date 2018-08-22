<?php
    /*
     *  IMPORT CORE CLASSES
     *  *******************
    */
    require_once 'core/App.php';        #   The App Class
    require_once 'core/Security.php';   #   The Security Class
    require_once 'core/Request.php';    #   The Request Class
    require_once 'core/Controller.php'; #   The Controller Class
    require_once 'core/Model.php';      #   The Model Class
    require_once 'core/Asset.php';      #   The Asset Class
    
    /*  Create a new App object */
    $app = new App;                 