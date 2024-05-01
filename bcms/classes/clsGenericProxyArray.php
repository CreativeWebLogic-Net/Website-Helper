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
        if(isset(clsClassFactory::$cls->clsStatistics)){
            $this->stats=&clsClassFactory::$cls->clsStatistics;
        }
        
    }

    public function set_class($name,$target)
    {
        $this->obj[$name] = $target;
        
    }
    
    public function __get($name)
    {
        if(isset($this->obj[$name])){
            return $this->obj[$name];
        }
        
        
    }

    public function __set($name,$target)
    {
        $this->set_class($name,$target);        
    }

    public function __call($name, $arguments) {
        if (isset($this->obj[$name])) {
            // If the method exists in the stored object, call it
            return call_user_func_array([$this->obj[$name], $name], $arguments);
        } elseif (!method_exists($this, $name)) {
            exit("\n Bad Method=>".$name." | \n");
        } elseif (method_exists('clsClassFactory', $name)) {
            // If the method exists in clsClassFactory, call it
            return call_user_func_array(['clsClassFactory', $name], $arguments);
        } else {
            // Handle the case where the method is not found
            throw new Exception("Method $name does not exist");
        }
    }

    
        
    
}

