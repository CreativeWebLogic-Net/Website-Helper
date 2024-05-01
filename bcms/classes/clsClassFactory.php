<?php

    class clsClassFactory{

        //public static $all_vars;
        //public static $vars;
        private $project_type="";
        public static $vrs;

        public static $cls;
        //public $name_map=array('clsLog'=>'log','clsDatabaseInterface'=>'r','clsSession'=>'sess','clsAssortedFunctions'=>'log','clsExceptionHandler'=>'ex');
        /*
        private $full_class_list=array("clsStatistics","clsLog","clsDatabaseInterface","clsExceptionHandler","clsSession",
        "clsAssortedFunctions","clsServerDetails","clsDomain","clsContent","clsLanguage",
        "clsTemplate","clsModules","clsVariablePointerArray","clsMenu","clsText","clsFormCreator");
        */
        private $full_class_list=array("clsStatistics","clsLog","clsDatabaseInterface","clsExceptionHandler","clsSession","clsSessionHandler",
        "clsAssortedFunctions","clsServerDetails","clsDomain","clsContent","clsLanguage",
        "clsTemplate","clsModules","clsMenu","clsText","clsFormCreator");

        private $remote_class_list=array("clsStatistics","clsLog","clsDatabaseInterface","clsExceptionHandler","clsSession",
        "clsAssortedFunctions","clsServerDetails","clsDomain","clsContent","clsLanguage",
        "clsTemplate","clsModules","clsMenu","clsText","clsFormCreator","clsDCMS.php");

        private $execute_class_install=array("clsStatistics","clsLog","clsDatabaseInterface","clsExceptionHandler","clsSession",
        "clsAssortedFunctions","clsServerDetails","clsDomain","clsContent","clsLanguage",
        "clsTemplate","clsModules","clsMenu","clsText","clsFormCreator","clsDCMS.php");

        function __construct($project_type="full_install"){
            //$className="\n Class=> ".__CLASS__."  => \n";
            //print $className;
            //print "\n cls= ".__CLASS__." \n ";
            $this->project_type=$project_type;
            self::Initialize_Basic_Classes();
            
            //self::Create_Class_Array();
		}
        function Initialize_Basic_Classes(){
            self::$cls=new clsGenericProxyArray();
            //self::$vrs = new stdClass();
            self::$vrs=array();//new clsGenericVariables();
            $className="\n OK | \n";
            self::$cls=new clsGenericProxyArray();
            $set_list=array();
            switch($this->project_type){
                case "full_install":
                    $set_list=$this->full_class_list;
                break;
                case "remote_install":
                    $set_list=$this->remote_class_list;
                break;
                case "execute_install":
                    $set_list=$this->execute_class_install;
                break;
            }
            foreach($set_list as $class){
                self::$cls->$class=new clsGenericProxy(new $class());
            }
        }       
                    
                   

    }