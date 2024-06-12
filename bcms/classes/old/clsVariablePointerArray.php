<?php

class clsVariablePointerArray
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
        if(is_array($this->obj[$name])){
            $this->obj[$name] = array_merge($this->obj[$name],$target);
            $this->call_event($name,$target);
        }else{
            $this->obj[$name] = $target;
        }
        
        
    }
    /*
    public function set_array($data_arr)
        {
           foreach($data_arr as $key=>$val){
                if($this->data[$key]!=$val){
                    $this->data[$key] = $val;
                }
                
            }
            
        }
*/
        public function call_event($key,$val)
        {
           //print_r($this->data);
            
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

