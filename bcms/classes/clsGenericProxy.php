<?php

class clsGenericProxy
{
    public $obj;
    private $handler;
    private $stats=false;
    public $output="";

    //public $all_vars=array();
    //public $var=array();
    //public $cls=array();

    
    public function __construct($target, callable $exceptionHandler=null)
    {
        $this->obj = $target;
        //print_r($target);
        //$this->obj->cls=&clsClassFactory::$cls;
        //$this->obj->all_vars->methods=array();
        $this->set_globals();
    }

    public function set_method($method,$arguments){
        $current_meth=array();
        $current_meth['current_class']=get_class($this->obj);
        $current_meth['current_arguments']=$arguments;
        $current_meth['current_method']=$method;
        /*
        if(isset($this->output)>0){
            print $this->output;
            $current_meth['current_output']=base64_encode($this->output);

        }
        */
        //if(!isset($this->obj->all_vars->methods)) $this->obj->all_vars->methods=array();
        $this->obj->all_vars['methods'][]=$current_meth;
        $this->update_globals();
    }

    public function set_globals()
    {
        $this->obj->cls=&clsClassFactory::$cls;
        //$this->obj->set_vars(clsClassFactory::$vrs);
        //$this->obj->all_vars=clsClassFactory::$vrs->get_vars();
        
        //$this->obj->all_vars=&clsClassFactory::$vrs->new_variables;
        $this->obj->all_vars=&clsClassFactory::$all_vars;
            //exit("ll567");
        //$this->obj->all_vars=$this->obj->get_vars();
    }

    public function update_globals()
    {
        //clsClassFactory::$vrs=array_merge(clsClassFactory::$vrs, $this->obj->all_vars);
        //$this->obj->set_vars($this->obj->all_vars);
        //clsClassFactory::$vrs->set_vars($this->obj->all_vars);
        
        //clsClassFactory::$vrs->new_variables=array_replace(clsClassFactory::$vrs->new_variables, $this->obj->all_vars);
        //print("1113 \n ");
        //print_r($this->obj->all_vars);
        //clsClassFactory::$vrs->new_variables = $this->mergeArraysRecursively(clsClassFactory::$vrs->new_variables, $this->obj->all_vars);

        clsClassFactory::$all_vars = $this->mergeArraysRecursively(clsClassFactory::$all_vars, $this->obj->all_vars);
        
        //print("1112 \n ");
        //print_r($result);
        //print(" \n ");
        //clsClassFactory::$vrs->new_variables = $this->recurse_arrays($value);
    }

    function mergeArraysRecursively($array1, $array2) {
        foreach ($array2 as $key => $value) {
            // Check if both arrays have an array at this key
            if (is_array($value) && isset($array1[$key]) && is_array($array1[$key])) {
                $array1[$key] = $this->mergeArraysRecursively($array1[$key], $array2[$key]);
            } else {
                // Otherwise, set the value from the second array
                $array1[$key] = $value;
            }
        }
        return $array1;
    }

    public function set_stats()
    {
        if(isset($this->clss->clsStatistics)){
            $this->stats=$this->cls->clsStatistics;
        }
        
    }
    
    public function __get($name)
    {
        //if($this->stats) $this->stats->take_time_sample();
        return $this->obj;
        
    }

    public function __call($method, $arguments)
    {
        //echo"--123---------------------------$method--------------------------------------------------\n";
        try{
            $this->output="";
            if(method_exists($this->obj,$method)){
                $this->set_globals();
                
                $this->output=call_user_func_array([$this->obj, $method], $arguments);
                
                //$this->set_method($method,$arguments);
                $this->update_globals();
                //print("GGG");
                //print_r(clsClassFactory::$all_vars);
                //print("HH3".$method);
                //print_r(clsClassFactory::$vrs->new_variables);
                //print_r($this->obj->all_vars);
                //exit("ll");
                
            }else{
                $this->output="Uknown Method ->".$method;
            }
            
            return $this->output;

        }catch(Exception $e){
            //print_r($e);
        }
    }

    public function export_data()
    {
        print_r($this->obj->all_vars);
        //print_r($this->obj->var);
        //print_r($this->obj->cls);
    }

    
}
