<?php


    class clsClassFactory{

        public static $all_vars=array();
        public static $vars;

        public static $vrs;

        public static $cls;
        public $name_map=array('clsLog'=>'log','clsDatabaseInterface'=>'r','clsSession'=>'sess','clsAssortedFunctions'=>'log','clsExceptionHandler'=>'ex');

        function __construct(){
            
            self::Initialize_Basic_Classes();
            self::Create_Class_Array();
		}
        function Initialize_Basic_Classes(){
            //exit("todo");
            //self::$vars=new clsObjectAccess();

            //print("todo 001");
            $stats=new clsStatistics();
            self::$all_vars['stats']=new clsGenericProxy($stats);
            $ex=new clsExceptionHandler();
            self::$all_vars['ex']=new clsGenericProxy($ex);
            //print("todo 002");
            $log=new clsLog();
            self::$all_vars['log']=new clsGenericProxy($log);
            //print("todo 003");
            $r=new clsDatabaseInterface();
            self::$all_vars['r']=new clsGenericProxy($r);
            ///print("todo 004");
            $sess=new clsSession();
            //print("todo 0041");
            self::$all_vars['sess']=new clsGenericProxy($sess);
            //print("todo 005");
            $a=new clsAssortedFunctions();
            self::$all_vars['a']=new clsGenericProxy($a);
            $os=new  clsServerDetails();
            self::$all_vars['os']=new clsGenericProxy($os);
            //self::$all_vars['stats']->take_time_sample(__CLASS__);

            //$return_array=self::Execute_Class_Method('stats','take_time_sample',array());
            //print($return_array);
            //print_r(self::$all_vars);
            //exit("todo");
		}

        static function Execute_Class_Method($class,$method,$arguments){
            return call_user_func_array([self::$all_vars[$class], $method], $arguments);
		}

        static function Initialize_Class_Variables($name){
            foreach(self::$all_vars as $key=>$val){

            }
		}

        static function Get_Class_Variable($name){
            $pos = strpos('cls', $name);
            if($pos>-1){
                $target_name=self::$name_map[$name];
            }else{
                $target_name=$name;
            }
            return self::$all_vars[$target_name];
		}

        static function Get_Class_Arrays(){
            
            return self::$cls;
		}

        static function Set_Class_Variable($name,$object){
            //print ($name."-".$object);
            self::$all_vars[$name]=$object;
		}

        static function Create_Class_Object($class_name){
            $new=new $class_name();
            self::$all_vars[$class_name]=new clsGenericProxy($new);
		}

        static function Create_Class_Array(){
            $class_array=new clsGenericProxyArray();
            $class_array->clsStatistics=self::$all_vars['stats'];
            //$class_array->clsStatistics->test_output();
            $class_array->clsExceptionHandler=self::$all_vars['ex'];
            $class_array->clsLog=self::$all_vars['log'];
            $class_array->clsDatabaseInterface=self::$all_vars['r'];
            $class_array->clsSession=self::$all_vars['sess'];
            $class_array->clsAssortedFunctions=self::$all_vars['a'];
            $class_array->clsServerDetails=self::$all_vars['os'];
            self::$cls=$class_array;

            //self::$cls->clsStatistics->test_output();
        }

        static function Create_Variables_Array($vars=null){
            if(is_null($vars)){
                $vars=self::$vars;
            }
            self::$vrs=new clsGenericVariables("module_data",$vars->module_data);
            self::$vrs->domain_data=$vars->domain_data;
            self::$vrs->template_data=$vars->domain_data;
            self::$vrs->content_data=$vars->domain_data;
            self::$vrs->text_data=$vars->domain_data;
            self::$vrs->content_domain_data=$vars->domain_data;
            self::$vrs->domain_user_data=$vars->domain_data;
            self::$vrs->app_data=$vars->domain_data;
            self::$vrs->bizcat_data=$vars->domain_data;
            //print $vrs->module_data;
        }


        

    }