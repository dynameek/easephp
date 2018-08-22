<?php
    /*
     *  REQUEST CLASSES
     *  ***************
     *  This class is the backbone of the application functionality.
     *  1. It checks the request method and maps to an appropriate controller
     *  2. By extending the security class, it is ensures that the application
     *     is protected against XSS, CSRF
     *
     *  When a request object is created,
     *  1. It parses the url
     *  2. Deteremines the request method
     *  3. Performs necessary security checks and data sanitization
     *  4. Routes request to appropriate controllers
     *  
    */
    
    class Request extends Security
    {
        #
        private $controller;
        private $params = [];
        private $requestMethod;
        
        /*
         * On creation of th request object,
         * ___________________________________________
         * 1. Parse the url
         * 2. check the request method
         * 3. if a 'post', 'put' or 'delete' method is passed
         *      - check if csrf token is set
         *      - verify the token if it set
         *      - clean the  request array
         * 4. set the controller if it exists
         * 5. set parameters
         * 6. Call route method to map controller
         *
         */
        public function __construct()
        {
            $urlComponents = $this->parseUrl(); #   Parse the url
            $this->checkRequestType();
            if( $this->requestMethod !== 'get')
            #   If request is not a get request, check for csrf
            {
                #   Throw an exception of csrf variable is not set
                if(!isset($_POST['csrf_token']))
                    throw new Exception('Request::__construct: Unprotected form');
                
                #   If token is set, verify it
                if(!Request::verifyToken($_POST['csrf_token']))
                    throw new Exception('Request::__Construct : Invalid protection token');
                
                #   Clean $_POST array
                $this->cleanGlobals($_POST);
            }
            
            #   Set the controller name {name of the file}
            if(isset($urlComponents[0]))
            {
                $this->controller = $urlComponents[0];
                unset($urlComponents[0]);
                if($this->requestMethod == 'get')
                    $this->params = array_values($urlComponents);
                else $this->params = $_POST;
            }
            
            #   Create route object
            #   The route object will call appropriate controller methods
            $this->route();
        }
        
        /*
         *  This function imports the route class
         *  It creates a route object, passing the set controller, method and parameters
         *  _____________________________________________________________________________
        */
        private function route()
        {
            require_once './app/core/Route.php';
            $route = new Route($this->controller, $this->requestMethod, $this->params);
        }
        
        /*
         * This function collects and parses the url
         * Each part of the url is sanitized.
         * It returns and array of the various components of the url
         * __________________________________________________________
         */
        private function parseUrl()
        {
            $url = $_GET['url'];    #   Get url from address bar
            $url = explode('/', htmlspecialchars(rtrim($url, '/')));  #blow url into array
            return $url;
        }
        
        /*
         *  This function checks the request method
        */
        private function checkRequestType()
        {
            $retVal = 'get';
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $retVal = 'post';
                if(isset($_POST['r_method']))
                {
                    switch($_POST['r_method'])
                    {
                        case 'put':
                            $retVal = 'put';
                            break;
                        case 'delete':
                            $retVal = 'delete';
                            break;
                        default:
                            throw Exception('Request::checkRequestType : Invalid request method');
                    }
                }
            }
            
            $this->requestMethod = $retVal;
        }
        
        /*
         *  This function cleans the values of superglobals
        */
        private function cleanGlobals($var)
        {
            foreach($var as $key => $value)
            {
                $var[$key] = htmlspecialchars(trim($value));
            }
        }
    }