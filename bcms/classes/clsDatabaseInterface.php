<?php
//class clsDatabaseInterface extends clsDatabaseCRUD{
class clsDatabaseInterface{
		var $SQL;
		var $Table;
		var $TargetField="id";
		var $SearchVar;
		var $NewSearchVar=array();
		public $m;
		//var $vs;
		var $links=false;
		var $result;
		var $DBFile="db-local.php";
		var $default_db="bubblelite2";
		//public $log="";
		var $log_text="";
		var $db_type_list=array("MySQL","Sqlite","pgSQL");
		private $server_db_list=array();
		//var $current_db_type="MySQL";
		var $current_db_type="Sqlite";
		//var $current_db_type="pgSQL";
		var $num_rows=0;
		var $Retreive_All_Variables=false;
		var $app_data=array();

		private $DB_Factory;

		var $server_name="Hostgator Cloud";
		public $all_vars=array();
		public $var=array();
        public $cls=array();
        function __construct(){
			$this->cls=&clsClassFactory::$cls;
            //print_r($this->cls);

			//echo "\n 777-xx \n";
            $this->get_database_details();
            
		}

        

		

        
		/*
		public function Add_App_Data(&$app_data){
			
			$this->app_data=$app_data;
		}
		
		
		public function Set_Log(&$log=null){
			$this->log=clsClassFactory::$all_vars['log']->get_object();
			$this->log->general('M Log Success:',1);
		}
		
		public function Set_Vs(&$vs=false){
			$this->vs=$vs;
		}
		*/
		public function Set_Links($links=false){
			if($links){
				$this->links=$links;
			}else{
			}
		}
		public function Get_Links(){
			if(!$this->links){
				return false;
			}else{
				return $this->links;
			}	
		}
		public function Set_Result($result=false){
			$this->result=$result;
		}
		public function Get_Result(){
			if(!$this->result){
				return false;
			}else{
				return $this->result;
			}
		}
		
		public function get_database_details(){
			
			$file_return = "";//include "bcms/classes/db.php";
			$load_file="bcms/classes/db.php";
			if (file_exists($load_file)) {
				$file_return = include ($load_file);
				$this->server_db_list=$server_DB_list;
				//$this->all_vars=array();
				$this->all_vars['database']=array();
				$this->all_vars['database']['db']=array();
				foreach($this->server_db_list as $key=>$val){
					$this->all_vars['database']['db'][]=$val;
					//$this->cls->export_data();
					$this->cls->clsDatabaseFactory->add_database($val);
				}
			}
				 
				return $file_return;
		}
		
		
		public function rawQuery($query="")
		{
			//echo "\n 666-xx".$query." \n";
			$result=$this->cls->clsDatabaseFactory->rawQuery($query);
			return $result;
		}
		
		public function NumRows(){
			$num_rows=$this->cls->clsDatabaseFactory->NumRows();
			$this->num_rows=$num_rows;
			return $num_rows;
		}
		
		public function Fetch_Array()
		{
			$row=array();
			$row=$this->cls->clsDatabaseFactory->Fetch_Array();
			return $row;
		}
		
		public function Fetch_Assoc()
		{
			$row=array();
			$row=$this->cls->clsDatabaseFactory->Fetch_Assoc();
			//print "\n row->".var_dump($row,true)."\n |zz \n";	
			return $row;
		}

		public function Fetch_Both()
		{
			$row=array();
			$row=$this->cls->clsDatabaseFactory->Fetch_Both();
			return $row;
		}

		public function Fetch_Multi_Array()
		{
			$row=array();
			$return_array=array();
			while($row=$this->cls->clsDatabaseFactory->Fetch_Array()){
				$return_array[]=$row;
			}
			return $return_array;
		}
		
		public function Fetch_Multi_Assoc()
		{
			$row=array();
			$return_array=array();
			while($row=$this->cls->clsDatabaseFactory->Fetch_Assoc()){
				$return_array[]=$row;
			}
			return $return_array;
		}
		
		public function Error()
		{
			$return_error=false;
			$link=$this->Get_Links();
			if (!$link) {
				$return_error=mysqli_connect_error();
				return $return_error;
			}else{
				return $return_error;
			}
		}
		
		public function Escape($string)
		{
			$st=$this->cls->clsDatabaseFactory->Escape($string);
			return $st;
		}
		
		public function Insert_Id(){
			$InsertID =$this->cls->clsDatabaseFactory->Insert_Id();
			return $InsertID;
		}
		
	}