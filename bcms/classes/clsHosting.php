<?php

    class clsHosting extends clsFormCreator{
       
        public $r;
        public $log;
        public $output;

        function __construct(){
			$this->Set_Log(clsClassFactory::$all_vars['log']);
            $this->Set_DataBase(clsClassFactory::$all_vars['r']);
			
		}
        function Set_DataBase($r){
			$this->r=$r;
			
		}

        function Set_Log($log){
			$this->log=$log;
			
		}

        function Pre_Create_Server_List(){
			$this->output=__METHOD__;
            return $this->output;
		}
        function Pre_Create_Server_Add(){
			$this->output=__METHOD__;
            return $this->output;
		}

        function Pre_Create_Server_Edit(){
			$this->output=__METHOD__;
            return $this->output;
		}
        function Create_Server_List(){
            //print "XXD3";
            //$this->output="XXD4";
			$this->output=$this->Create_Server_List_Table();
            return $this->output;
		}

        function Create_Server_Edit(){
            //print "XXD3";
            //$this->output="XXD4";
			$this->output=$this->Create_Server_Form();
            return $this->output;
		}

        function Create_Server_Add(){
            $this->output=$this->Create_Server_Form();
            return $this->output;
		}




        
    }

?>