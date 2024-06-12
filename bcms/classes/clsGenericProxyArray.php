<?php

class clsGenericProxyArray
{
    public $obj=array();
    public $object_names=array();
    private $handler;

    private $stats=false;

    
    //private $vrs=array();
    //private $cls=array();
    private $output="";
    //public $all_vars=array();
    ///public $var=array();
    //public $cls=array();
    //public function __construct($target, callable $exceptionHandler = null)
    public function __construct($target=null, callable $exceptionHandler = null)
    {
        //echo"--yyy---------------------------------------------------------------------------\n";
        //$this->vrs=&clsClassFactory::$vrs;
        //$this->cls=&clsClassFactory::$cls;
        //echo"--111STARS---------------------------------------------------------------------------\n";
    }

    public function set_stats()
    {
        //if(isset(clsClassFactory::$cls->clsStatistics)){
            //$this->stats=&clsClassFactory::$cls->clsStatistics;
        //}
        
    }

    public function set_class($name,$target)
    {
        //echo"--XX11222STARS----------------$name-----------------------------------------------------------\n";
        if(!isset($this->obj[$name])){
            $this->obj[$name] = $target;
            $this->object_names[]=$name;
        }
        //$traverse=new clsTraverse();
        //$traverse->traverseClass($name);
        //print_r($target);
        //$this->obj[$name]->vrs=&$this->vrs;
        //$this->obj[$name]->cls=&clsClassFactory::$cls;
    }
    
    public function __get($name)
    {
        //echo"--YYY1--------------$name------------------------------------------------------------\n";
        //print("GGG");
            //print_r(clsClassFactory::$vrs->new_variables);
        if(isset($this->obj[$name])){
            return $this->obj[$name];
        }else{
            echo"--YYY2--------------$name------------------------------------------------------------\n";
        }
        
        
    }

    public function __set($name,$target)
    {
        //echo"--STARS---------------$name------------------------------------------------------------\n";
        $this->set_class($name,$target);        
    }

    

    public function __call($name, $arguments) {
        echo"--88STARS---------------------------------------------------------------------------\n";
        $this->output=null;
        /*
        if (isset($this->obj[$name])) {
            // If the method exists in the stored object, call it
            
            $this->output=call_user_func_array([$this->obj[$name], $name], $arguments);
            //return $this->output;
        } elseif (!method_exists($this, $name)) {
            $this->export_data();
            //exit("\n Bad Method=>".$name." | \n");
        } elseif (method_exists('clsClassFactory', $name)) {
            // If the method exists in clsClassFactory, call it
            $this->output=call_user_func_array(['clsClassFactory', $name], $arguments);
        } else {
            // Handle the case where the method is not found
            throw new Exception("Method $name does not exist");
        }
        */
            
        if (isset($this->obj[$name])) {
            if(method_exists($this, $name)){
                $this->output=call_user_func_array([$this->obj[$name], $name], $arguments);
            }else{
                echo " No Method";
            }
            // If the method exists in the stored object, call it
            
            
            //return $this->output;
        }elseif(!isset($this->obj[$name])){
           clsClassFactory::Add_Class($name);
           $this->output=call_user_func_array([$this->obj[$name], $name], $arguments);
            $this->output="";
        }else{
            echo"\n -OO-777881100---Class=>".__CLASS__."--Method=>".__METHOD__."--------------".var_export($arguments,true)."-------------------------------------------------------\n";
        
        }
        return $this->output;
    }

    public function export_data()
    {
        //echo"\n -PP-777881100---Class=>-------------obj-".var_export($this->obj,true)."------------------------------------------------------\n";
        //echo"\n -PP-777881100---Class=>".__CLASS__."--Method=>".__METHOD__."-------------obj-------------------------------------------------------\n";
        //$traverse=new clsTraverse();
        foreach($this->obj as $key=>$val){
            echo"\n -PP-777881100---Class=>$key-------------obj-------------------------------------------------------\n";
            $val->export_data();
        }
        //print_r($this->object_names);
        /*
        foreach($this->object_names as $key=>$val){
            print "\n =============\n ";
            //print var_export($key,true);
            //$traverse->traverseClass($key);
            //print var_export($val,true);
            print "\n ============= \n";
        } 
        */
        /*
        foreach($this->obj as $key=>$val){
            print "\n =============\n ";
            print var_export($key,true);
            $traverse->traverseClass($key);
            //print var_export($val,true);
            print "\n ============= \n";
        } 

        */
          
    }

        
    
}

