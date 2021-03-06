<?php
    /*
     *  *****************
     *  *   ASSET CLASS *
     *  *****************
     *  This class is responsible for including app assets.
     *  By default, the supported assets are:
     *  1. Cascading StyleSheets (.css)
     *  2. JavaScript (.js)
     *  3. Media files (images)
     *
     *  This class, as with other classes can be extended and modified as per app needs
    */
    class Asset
    {
        private const imageBasePath = './app/assets/images/';   #   Base URI for images
        private const styleBasePath = './app/assets/css/';      #   Base URI for stylesheets
        private const scriptBasePath = './app/assets/js/';      #   Base uri for Javascript
        
        /*
         *  This loads a HTML img element for the supplied image name
         *  It takes 3 parameters:
         *  1. The image name (e.g xyz.png)
         *  2. alternate value for alt attribute (optional)
         *  3. array of class names for the img element (optional)
         *
         *  It returns a HTML img element
        */
        public function loadImage($image, $alt = '', $classes = [])
        {
            $class_str = '';
            foreach($classes as $class)
            {
                $class_str .= $class.' '; 
            }
            $img = "<img alt='".$alt."' class='".$class_str."'
                    src='".self::imageBasePath.$image."'>";
            return $img;
        }
        
        /*
         *  This loads the required styles for the webpage
         *  It takes a parameter:
         *  1. an array of the names style names (e.g general.css)
         *
         *  it returns no value
        */
        public function loadStyles($stylesheets = [])
        {
            foreach($stylesheets as $stylesheet)
            {
                $lnk = "<link rel='stylesheet'
                        href='".self::styleBasePath.$stylesheet."'>";
                echo $lnk;
            }
        }
        
       
        /*
         *  This loads the required JavaScript files for the webpage
         *  It takes a parameter:
         *  1. an array of the names script names (e.g general.js)
         *
         *  it returns no value
        */
        public function loadJavaScripts($scripts = [])
        {
            foreach($scripts as $script)
            {
                $script = "<script src='";
                $script .= self::scriptBasePath.$script;
                $script .= "'> </script>";
                
                echo $script;
            }
        }
    }