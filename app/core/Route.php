<?php
    /*
     *  ROUTE CLASS
     *  ***********
     *  The route class performs the actual request-controller routing
     *  1. It ensures a controller exists
     *  2. It ensures the controller handler exists
     *  3. It calls the method
     *
     *  if the controller or it's handler do not exist, defaults are called.
     *
    */
    
    class Route
    {
        private $baseUri = './app/controllers/';    #   Base path to controller directory
        private $baseController = 'home';           #   Default controller method
        private $baseMethod = 'get';                #   Default controller handler
        
        
        /*  */
        public function __construct($controller, $method, $params = [])
        {
            /*  Check if controller exists  */
            if(file_exists($this->baseUri.$controller.'.php'))
            {
                #   Replace base controller
                $this->baseController = $controller; 
            }
            
            #   Import the controller class
            require_once ($this->baseUri.$this->baseController.'.php');
            
            #   Create a controller object from the imported class
            $controlObj = new $this->baseController;
            
            #   Check if the method exists
            $method = method_exists($controlObj, $method) ? $method : $this->baseMethod;
            
            #   Call the controller's method with any parameters passed from the request
            call_user_func_array([$controlObj, $method], $params);
        }
    }