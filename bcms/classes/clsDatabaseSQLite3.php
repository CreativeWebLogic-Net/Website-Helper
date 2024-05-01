<?php
    class clsDatabaseSQLite3{
        
        private $DB=array();

        private $Current_DB="";

		private $Current_DB_List="";
        private $links;

		private $num_rows;

        private $result;

        private $log=array();

        private $SQL="";
        function __construct(){
			
		}
		//-----------------------------------------------------------------------------------------------------------
		
		
		private function Set_Log(&$log){
			$this->log=$log;
			$this->log->general('-Set Log Boot Success: $r->'.var_export($log,true),3);
		}

        private function Set_Links($links=false){
			if($links[$this->Current_DB]){
				$this->links[$this->Current_DB]=$links;
			}else{
			}
		}
		private function Get_Links(){
            
			if(!$this->links[$this->Current_DB]){
				return false;
			}else{
				return $this->links[$this->Current_DB];
			}
		}
		private function Set_Result($result=false){
			$this->result=$result;
			
		}
		private function Get_Result(){
			if(!$this->result){
				return false;
			}else{
				return $this->result;
			}
		}

        public function Connect($DB){
            $this->DB[$DB['db_server_id']]=$DB;
			//$DB['server_tag']="db-sqlite3.php";
			$TArr=$DB['db_server_id'];
			//$this->current_server_tag=$DB['server_tag'];
			//$TArr=$this->current_server_tag;
			//$server_login[$DB['server_tag']]=array();
				
			$db = new SQLite3($DB['dbName']);
			$this->links[$TArr]=$db;
			//$this->Current_DB_List[]=$TArr;
            $this->Current_DB=$TArr;
			return $this->links[$TArr];
		}

        public function rawQuery($query="",$link=false)
		{
            //print $query." \n\n";
			$result=false;
			if($query!=""){
				$this->SQL=$query;
				if(!$link){
					$link=$this->Get_Links();
				}
				try{
					if($link){
						$result = $link->query($query);
						if($result){
							$this->Set_Result($result);
						}else{
							print "\n failed query =>".$query." \n\n";
						}
                        
					}else{
					}
					if(!$result){
						//$this->log->general("No MySQL Result->".$query,9);
						return false;
					}else{
					}
				}catch(Exception $e){
					$this->log->general("MySQL Exception->".var_export($e,true)." ".$query,3);
				}
			}else{
			}
			return $result;
		}
		
		public function NumRows($result=false){
			if(!$result){
				$result=$this->Get_Result();
			}
			$link=$this->Get_Links();
			$num_rows=0;
			if($result){
				try{
					$num_rows=0;
					$result->reset();
                    $nrows = 0;
                    while ($this->Fetch_Array()){
                        $nrows++;
                    }
                    $result->reset();
                    $num_rows=$nrows;
				}catch(Exception $e){
					$this->log->general("MySQL NumRows Exception->".var_export($e,true)." ".$this->SQL,3);
					return 0;
				}
			}
			$this->num_rows=$num_rows;
            return $num_rows;
		}

        public function Fetch_Array($result=false)
		{
			$row=array();
			if(!$result) $result=$this->Get_Result();
            if($result){
				$row = $result->fetchArray(SQLITE3_NUM);
				if(is_array($row)){
					if(count($row)>0){
					}else{
						$row=array();
					}
				}else{
					$row=array();
				}
			}else{
				$row=array();
			}
			return $row;
		}
		
		public function Fetch_Assoc($result=false)
		{
			$row=array();
			$return_array=array();
			if(!$result) $result=$this->Get_Result();
			if($result){
				$row = $result->fetchArray(SQLITE3_ASSOC);
				//print_r($row);
				$return_array=$row;
				
				
				if(is_array($return_array)){
					return $return_array;
				}else{
					$return_array=array();
				}
				
			}else{
                $return_array=array();
			}
			//print_r($return_array);
			return $return_array;
		}

		public function Fetch_Both($result=false)
		{
			//echo"fff-----------------------------------------------------------------------------";
			$row=array();
			$row = $result->fetchArray(SQLITE3_BOTH);
			return $row;
		}

        //===================================================================

        function mb_escape(string $string)

		{
	
			return preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', $string);
	
		}
		
		
		function Escape($string)
		{
			//echo"20-----------------------------------------------------------".var_export($this->links,true)."------------------";
			
			if(isset($string)){
				if(strlen($string)>0){
					if($this->links){
						$st = $this->mb_escape($string);
					}else{
						$st="";
					}
					
				}else{
					$st="";
				}
			}else{
				$st="";
			}
			
			return $st;
			
		}
		
		function Insert_Id($result=false){
			/*
			try{
				//$InsertID = $this->links->insert_id;
				$InsertID = $this->links->lastInsertRowID();
				return $InsertID;
			}catch(ErrorException $e){
				$this->log->general("-Insert_Id failed--".var_export($e,true),3);
			}
			*/
			$row=array();
			$return_array=array();
			if(!$result) $result=$this->Get_Result();
			if($result){
				$row = $result->lastInsertRowID();
				//print_r($row);
				$return_array=$row;
				
				
				if(is_array($return_array)){
					return $return_array;
				}else{
					$return_array=array();
				}
				
			}else{
                $return_array=array();
			}
			//print_r($return_array);
			return $return_array;
		}

        
    }