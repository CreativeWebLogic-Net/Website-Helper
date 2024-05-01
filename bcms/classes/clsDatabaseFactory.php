<?php

    class clsDatabaseFactory{

        private $DB=array();
        private $Databases=array();

        private $Current_Database="";
        function __construct(){
			
		}

        public function set_database($db_server_id){
            $this->Current_Database=$db_server_id;
        }

        public function add_database($DB){
            //print_r($DB);
            $this->Current_Database=$DB['db_server_id'];
			$this->DB[$this->Current_Database]=$DB;
            
            switch($this->DB[$this->Current_Database]['server_type']){
                case "MySQL":
                    $new_db=new clsDatabaseMySQL();
                break;
                case "Sqlite":
                    $new_db=new clsDatabaseSQLite3();
                break;
                case "pgSQL":
                    $new_db=new clsDatabasePGSql();
                break;
            }
            $this->Databases[$this->Current_Database]=$new_db;
            $this->Databases[$this->Current_Database]->Connect($DB);
		}

        public function rawQuery($query="")
		{
			return $this->Databases[$this->Current_Database]->rawQuery($query);
		}
		
		public function NumRows(){
			return $this->Databases[$this->Current_Database]->NumRows();
		}

        public function Fetch_Array()
		{
			return $this->Databases[$this->Current_Database]->Fetch_Array();
		}
		
		public function Fetch_Assoc()
		{
			return $this->Databases[$this->Current_Database]->Fetch_Assoc();
		}

		public function Fetch_Both()
		{
			return $this->Databases[$this->Current_Database]->Fetch_Both();
		}
		function Escape($string)
		{
			
			return $this->Databases[$this->Current_Database]->Escape($string);
			
		}
		
		function Insert_Id(){
			return $this->Databases[$this->Current_Database]->Insert_Id();
		}
    }