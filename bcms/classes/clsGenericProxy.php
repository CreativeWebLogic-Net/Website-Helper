<?php

class clsGenericProxy
{
    public $obj;
    private $handler;

    private $stats=false;

    
    //public function __construct($target, callable $exceptionHandler = null)
    public function __construct($target, callable $exceptionHandler=null)
    {
        $this->obj = $target;
        
        $this->handler = $exceptionHandler;
        $this->set_stats();
    }

    public function set_stats()
    {
        if(isset($this->clss->clsStatistics)){
            $this->stats=$this->cls->clsStatistics;
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
            return $this->obj;
            
        }
        
        public function get_object()
        {
            
            if($this->stats) $this->stats->take_time_sample();
            return $this->obj;
            
        }

        public function set_object($obj)
        {
            
            $this->obj=$obj;
            
        }
        
    
    public function __call($method, $arguments)
    {
        
        //$this->Start_App_Vars();
        $return_variable=null;
            if(method_exists($this->obj,$method)){
                
                $return_variable=call_user_func_array([$this->obj, $method], $arguments);
            }else{
                $output=$method;
                $return_variable=$output;
            }
            return $return_variable;
        /*
        try {
            if($this->stats){
                $this->stats->take_time_sample(get_class($this->obj)."->".$method."->".var_export($arguments,true));
                foreach($arguments as $key=>$val){
                    $tag_name=get_class($this->obj);
                    //if (($val != null) && ($val != '')){
                        $tag_size=strlen(base64_encode(var_export($val,true)));
                        $this->stats->size_data($tag_name,$tag_size);
                        //print(" \n HHH123->".$tag_size." |n -> \n");
                    //}
                }
            } 
            $return_variable=null;
            if(method_exists($this->obj,$method)){
                $return_variable=call_user_func_array([$this->obj, $method], $arguments);
            }
            return $return_variable;
            //$this->Update_App_Vars();
        } catch (Exception $e) {
            // catch all
            if (!is_null($this->handler)) {
                throw call_user_func($this->handler, $e);
            } else {
               throw $e;
            }
        }
        */
        
    }

    
}