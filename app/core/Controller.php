<?php
    /*
     *  CONTROLLER CLASS
     *  ******************
     *  This is the base class for all controllers
     *  1. It extends the Form class further sanitization of input data
     *  2. All controllers must extend this class
     *  3. It loads appropriate models and views for the request
     *
     *  All controllers can have not more than four methods:
     *  1. get()
     *  2. post()
     *  3. put()
     *  4. delete()
     *
     *  If any other methods are created, the must ONLY be helper methods
    */
    
    class Controller extends Form
    {
        #
        private const defaultView = 'home/index';   #   The default view
        private const defaultModel = 'user';        #   The default model
        
        private $requestedView = '';                #   The user's requested view
        private $requestedModel = '';               #   THe user's requested model
        
        
        /*
         *  LOAD A MODEL
         *  *************
         *  This take the name of a model and attempts to load it the calling controller
         *  It takes one parameter:
         *  1.  The name of the required model
        */
        protected function loadModel($model)
        {
            #   Check if the model exists
            if(file_exists( './app/models/'.$model.'php'))
                #   Set requested model value
                $this->requestedModel = $model;
            else $this->requestedModel = self::defaultModel;
            
            #   Import model class
            require_once './app/models/'.$this->requestedModel.'.php';
            
            #   return an instance of the model class
            return new $this->requestedModel;
        }
        
        /*
         *  LOAD A VIEW
         *  ***********
         *  This returns a view requested by the controller
         *  It takes two methods:
         *  1. the url to the view(folder_name/ file_name) e.g 'home/index'
         *  2. the data required for that view
         *
        */
        protected function loadView($viewUrl,  $data = [])
        {
            #   Check if the view exists
            if(file_exists('./app/views/'.$viewUrl.'.php'))
                $this->requestedView = $viewUrl;
            else $this->requestedView = self::defaultView;
            
            #   Get the view
            require_once './app/views/'.$this->requestedView.'.php';
        }
    }