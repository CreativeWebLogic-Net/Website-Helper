<?php

class clsClassPointerArray
{
        
       public function __construct()
    {
       
    }

    
    
    public function __get($name)
    {
        if(isset(clsClassFactory::$cls->$name)){
            return clsClassFactory::$cls->$name;
        }else{
            return null;
        }
        
        
    }

    public function __set($name,$target)
    {
        clsClassFactory::$cls->$name=$target;        
    }
        
    
}

