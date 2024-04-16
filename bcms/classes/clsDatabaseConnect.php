<?php
	
	
	
	class clsDatabaseConnect{
		public $log=false;
		var $log_text="";
		var $links = array();
		var $connect=array();
		var $mysqli=false;
		var $Insert_Id=false;
		var $db_logins=array();
		var $dbss=array();
		var $current_dir="";
		var $default_db=array();
		var $def_db="";
		var $server_names=array();
		var $server_name="Hostgator Cloud";
		var $server_num=0;
		var $db_num=array(0=>0,1=>0,2=>0);
		var $def_db_num=array(0=>0,1=>0,2=>0);
		var $datab_name="";
		var $server_login=array();
		var $all_databases_array=array();
		var $server_tags=array();
		var $all_db_login_data=array();
		var $local_db=array();
		var $host_name="localhost";
		//var $db_name_serv=array(0=>0,1=>0,2=>0);
		var $db_name_def_num=array(0=>0,1=>0,2=>0);
		var $db_num_ser=array(0=>0,1=>0,2=>0);
		var $current_server_tag="";
		var $current_db_type="Sqlite";
		var $original_server_tag="";
		var $app_data=array();
		var $server_db_list=array();

		var $server_db_id_list=array();
		//-----------------------------------------------------------------------------------------------------------
	
		//function ConnectDbase(){
		
		function __construct(&$log=false){
			if($log){
				//$this->log=$log;
				$this->log=clsClassFactory::$all_vars['log']->get_object();
			}
			//$this->set_data_arrays();
			$this->get_login_details();
		}
		//-----------------------------------------------------------------------------------------------------------
		
		
		public function Set_Log(&$log){
			$this->log=$log;
			$this->log->general('-Set Log Boot Success: $r->'.var_export($log,true),3);
		}

		public function Add_App_Data(&$app_data){
			
			$this->app_data=$app_data;
			//print_r($this->app_data);
			$this->get_login_details();
		}

		
		public function get_login_details(){
			
			$load_file="bcms/classes/db.php";
			if (file_exists($load_file)) {
				include($load_file);
				$this->server_db_list=$server_DB_list;
				
			}else{
			}
			//if($this->original_server_tag=="") $this->original_server_tag=$this->current_server_tag;
			
		}
		
		//-----------------------------------------------------------------------------------------------------------
		
		public function Connect($TArr=""){

			
			return $this->server_db_list;
		}
		
	}