<?php
    /*
     *  MODEL CLASS
     *  ***********
     *  This is the base class for all models
     *  It extends the database class; giving models database capability
     *  All models must extend this class
     *
    */
    
    # Require database
    require_once 'Database.php';
    
    class Model extends Database
    {
        
    }