<?php

class clsGenericVariables
{
    private $var=[];

    
    public function __construct()
    {
        
        //$this->var = array();
        //$this->var['content_data'] = [];
        //echo"--88---------------------------------------------------------------------------\n";
    }
    
    public function __get($name)
        {
            $return_variable=null;
            if(isset($this->var[$name])){
                $return_variable=$this->var[$name];
            }
            return $return_variable;
        }
        /*
        public function __set($name, $value) {
            if (!isset($this->var[$name])) {
                $this->var[$name] = [];
            }
            $this->var[$name][] = $value;
        }
        */
        public function __set($name,$value)
        {
            
            $this->var[$name]=$value;
        }
        
        
        
}
