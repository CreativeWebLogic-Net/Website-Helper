<?php

    class clsClassFactory{

        public  static  $project_type="full_install";
        public static $vrs;

        public static $all_vars=array();

        public static $cls;
        
        
        private static $class_execute_local=array("clsStartUp","clsAssortedFunctions");

        private static $class_execute_notes=array("clsStatistics","clsLog");

        private static $class_execute_session=array("clsSession","clsSessionHandler");

        private static $class_execute_content=array("clsDomain","clsContent","clsTemplate","clsModules","clsMenu","clsText","clsLanguage");

        private static $class_execute_database=array("clsDatabaseFactory","clsDatabaseInterface","clsDatabaseCRUD");

        private static $class_execute_general=array("clsExceptionHandler","clsServerDetails","clsFormCreator");

        private static $class_execute_remote=array("clsDCMS","clsTestServer");

        private static $class_types=array("class_execute_local","class_execute_notes","class_execute_session",
        "class_execute_content","class_execute_database","class_execute_general","class_execute_remote");

        private static $project_types=array("all_installs","full_install","remote_install","new_install");

        private static $every_class_variable=array();

        function __construct($project_type="full_install"){
            //$className="\n Class=> ".__CLASS__."  => \n";
            //print $className;
            //print "\n cls= ".__CLASS__." \n ";
            //$project_type="remote_install";
            $project_type="full_install";
            self::$project_type=$project_type;
            $start_up =new clsStartUp();
            //self::$vrs =new clsGenericVariables();
            self::$cls=new clsGenericProxyArray();
            self::Set_Classes();
            self::Populate_Classes(self::$project_type);
            $system =new clsSystem();
            self::$cls->clsStartUp=new clsGenericProxy($start_up);
            self::$cls->clsSystem=new clsGenericProxy($system);
            
            
            //self::Create_Class_Array();
		}

        public static function Set_Classes(){
            //self::$every_class_variable["all_installs"]=self::$class_execute_local;
            self::$every_class_variable["full_install"]=array_merge(self::$class_execute_local,self::$class_execute_notes,
            self::$class_execute_database,self::$class_execute_content,self::$class_execute_session,self::$class_execute_general);
            self::$every_class_variable["remote_install"]=array_merge(self::$class_execute_remote,self::$class_execute_local);
            self::$every_class_variable["new_install"]=array_merge(self::$class_execute_local,self::$class_execute_remote);
            //print_r(self::$every_class_variable);
            
		}
        
        public static function Check_Class($class){

            //echo"\n xxx->\n".$class."\n ";//." | ".var_export(self::$cls,true);
            if(!isset(self::$cls->$class)){
                self::$cls->$class=new clsGenericProxy(new $class());
            }
            
		}
        
        
        public static function Populate_Classes($project_type="full_install"){
            //print "\n //$this->var=$this->all_vars;\n".$project_type."\n ";
            $set_list=self::$every_class_variable[$project_type];
            foreach($set_list as $class){
                //print "\n";
                //print_r($class);

                self::Add_Class($class);
            }   
		}
              
        public static function Add_Class($class){

            //echo"\n 1777xxx->\n".$class."\n ";//." | ".var_export(self::$cls,true);
            if(!isset(self::$cls->$class)){
                self::$cls->$class=new clsGenericProxy(new $class());
            }else{
                echo"\n 99xxx->\n".$class."\n ";//." | ".var_export(self::$cls,true);
            }
            
		}
                   

    }