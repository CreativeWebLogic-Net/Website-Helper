<?php

class clsGenericProxyArray
{
    public $obj=array();
    private $handler;

    private $stats=false;

    
    //public function __construct($target, callable $exceptionHandler = null)
    public function __construct()
    {
       
    }

    public function set_stats()
    {
        if(isset(clsClassFactory::$all_vars['stats'])){
            $this->stats=&clsClassFactory::$all_vars['stats'];
        }
        
    }

    public function set_class($name,$target)
    {
        $this->obj[$name] = $target;
        
    }
    
    public function __get($name)
    {
                    
        return $this->obj[$name];
        
    }

    public function __set($name,$target)
    {
        $this->set_class($name,$target);        
    }
        
    
}

