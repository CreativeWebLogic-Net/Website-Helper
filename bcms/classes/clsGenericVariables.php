<?php

class clsGenericVariables
{
    public $var=array();
    private $handler;

    private $clss=array();

    private $stats=false;

    
    //public function __construct($target, callable $exceptionHandler = null)
    public function __construct($name,$value)
    {
        
        $this->Set_Value($name,$value);
        
        $this->set_stats();
        $this->clss=clsClassFactory::$cls;
        //$this->clss=&clsClassFactory::Get_Class_Arrays();
    }

    public function set_stats()
    {
        //print_r($this->clss);
        if(isset($this->clss->clsStatistics)){
            $this->stats=$this->clss->clsStatistics;
        }
        
    }
    
    public function __get($name)
        {
            /*
            if (array_key_exists($name, $this->data)) {
                return $this->data[$name];
            }
            */
            if($this->stats) $this->stats->take_time_sample();
            //return $this->obj;
            return $this->var[$name];
            
        }

        public function __set($name,$value)
        {
            /*
            if (array_key_exists($name, $this->data)) {
                return $this->data[$name];
            }
            */
            if($this->stats) $this->stats->take_time_sample();
            //return $this->obj;
            $this->Set_Value($name,$value);
            //$this->var[$name]=$value;
            
        }
        
        public function __toString()
        {
            if(is_array($this->var)){
                return var_export($this->var,true);
            }else{
                return (string)$this->var;
            }
            
        }

        private function Set_Value($name,$value)
        {
            
            if($this->stats) $this->stats->take_time_sample();
            //return $this->obj;
            $this->var[$name]=$value;
            
        }
    
}
