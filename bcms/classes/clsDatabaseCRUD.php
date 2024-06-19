<?php
    class clsDatabaseCRUD{
		public $all_vars=array();
		public $var=array();
		public $cls=array();
        //=================================================================================================
		public function Exec_Create($array_type="Assoc",$table_name,$columns_array=array()){
			$query_type="Create";

			//$columns_array
			//$table_name
			//$query_type
			//$array_type
			//$max_rows
			//$page_number

			$specific_columns=array();
			$order_by="";
			$max_rows=0;
			$page_number=0;

			//$sql="INSERT (".$retrieve_list.") INTO  ".$table_name." VALUES  (".$values_list.")";

			return $this->Execute_Database_Query($array_type,$query_type,$table_name,$columns_array,$specific_columns,$order_by,$max_rows,$page_number);
		}

		public function Exec_Retrieve($array_type="Assoc",$table_name,$retrieve_columns=array("*"),$where_array=array(),$order_by="",$max_rows=0,$page_number=1){
			$numargs = func_num_args();
			$arg_list = func_get_args();
			for ($i = 0; $i < $numargs; $i++) {
				if(is_array($arg_list[$i])){
					//echo "Argument $i is: " . var_export($arg_list[$i],true) . "\n";
				}else{
					//echo "Argument $i is: " . $arg_list[$i] . "\n";
				}
				
			}
			
			$query_type="Retrieve";
			$where_list="";
			
			
			if(is_array($where_array)){
				$acount=0;
				foreach($where_array as $key=>$val){
					if($acount==0){
						//$where_list.=" WHERE ".implode("=",$val);
						$where_list.=" WHERE ".$key."=".$val;
					}else{
						//$where_list.=" AND '".implode("'='",$val)."'";
						//$where_list.=" AND ".$key."=".$val;
					}
					$acount++;
				}
				
			}
			//print_r($where_list);

			if(is_array($retrieve_columns)){
				$retrieve_list=implode(",",$retrieve_columns);
			}else{
				$retrieve_list="";
			}
			if($order_by!=""){
				$order_by_sql=" ORDER BY ".$order_by;
			}
			
			//$max_rows=0;
			//$page_number
			if($max_rows>0){
				$sql_limits="LIMIT ".($page_number*$max_rows).",".$max_rows;
			}else{
				$sql_limits="";
			}
			
			$sql="SELECT ".$retrieve_list." FROM ".$table_name." ".$where_list." ".$order_by." ".$sql_limits;

			//print $sql;
            $return_array=array();
            $rslt=$this->cls->clsDatabaseFactory->rawQuery($sql);
			
			if($rslt){
				$this->cls->clsDatabaseFactory->Set_Result($rslt);
				$NumRows=$this->cls->clsDatabaseFactory->NumRows($rslt);
			}
            //$this->rslt=$this->Database_Raw_Query($sql);
			if($NumRows>1){
				if($array_type=="Assoc"){
					while($myrow=$this->cls->clsDatabaseFactory->Fetch_Assoc($rslt)){
						$return_array[]=$myrow;
					}
				}else{
					while($myrow=$this->cls->clsDatabaseFactory->Fetch_Array($rslt)){
						$return_array[]=$myrow;
					}
				}
			}else{
				if($array_type=="Assoc"){
					$return_array=$this->cls->clsDatabaseFactory->Fetch_Assoc($rslt);
				}else{
					$return_array=$this->cls->clsDatabaseFactory->Fetch_Array($rslt);
				}
			}
			
            
            //print_r($return_array);
            //print_r("ggg=> \n");
            return $return_array;
			
			//return $this->Execute_Database_Query($array_type,$query_type,$table_name,$retrieve_columns,$where_array,$order_by,$max_rows,$page_number);
		}

		public function Exec_Delete($array_type="Assoc",$table_name,$columns_array=array(),$specific_columns=array()){
			$query_type="Delete";
			/*
			,$order_by="id",$max_rows=0,$page_number=1

			if($specific_list!=""){
				$where_list=" WHERE ".$specific_list;
			}else{
				$where_list="";
			}
			$sql="DELETE FROM ".$table_name." ".$where_list;
			*/

			$order_by="";
			$max_rows=0;
			$page_number=0;

			return $this->Execute_Database_Query($array_type,$query_type,$table_name,$columns_array,$specific_columns,$order_by,$max_rows,$page_number);
		}

		public function Exec_Update($array_type="Assoc",$table_name,$columns_array=array(),$specific_columns=array()){
			$query_type="Update";
			/*
			,$order_by="id",$max_rows=0,$page_number=1
			$sql="UPDATE ".$table_name." SET ".$values_list." WHERE  ".$specific_list;
			*/

			$order_by="";
			$max_rows=0;
			$page_number=0;
			return $this->Execute_Database_Query($array_type,$query_type,$table_name,$columns_array,$specific_columns,$order_by,$max_rows,$page_number);
		}

		//============================================================================

		public function Execute_Database_Query($array_type="Assoc",$query_type,$table_name,$columns_array=array(),$specific_columns=array(),$order_by="id",$max_rows=0,$page_number=1){
            $update_list="*";
			$specific_list="";
			$values_list="";
			foreach($specific_columns as $key=>$val){
				$specific_list.=$val['name']."='".$val['value']."'";
			}

			foreach($columns_array as $key=>$val){
				$retrieve_array[]=$val['name'];
				$insert_values[]=$val['value'];
				$values_list.=$val['name']."='".$val['value']."'";
			}
			$retrieve_list="*";
            if(count($retrieve_array)>0){
              $retrieve_list=implode(",",$retrieve_array);
            }
			$values_list="";
			if(count($insert_values)>0){
				$values_list=implode("','",$insert_values);
				$values_list="'".$values_list."'";
			}
            $order_by_sql=" ORDER BY ".$order_by;
            if($max_rows>0){
                $sql_limits=" LIMIT 0,10";
            }else{
                $sql_limits="";
            }
            switch($query_type){
				case "Create":
					$sql="INSERT (".$retrieve_list.") INTO  ".$table_name." VALUES  (".$values_list.")";
				break;
				case "Retrieve":
					if($specific_list!=""){
						$where_list=" WHERE ".$specific_list;
					}else{
						$where_list="";
					}
					
					$sql="SELECT ".$retrieve_list." FROM ".$table_name." ".$where_list." ".$order_by_sql." ".$sql_limits;
				break;
				case "Update":
					$sql="UPDATE ".$table_name." SET ".$values_list." WHERE  ".$specific_list;
				break;
				case "Delete":
					if($specific_list!=""){
						$where_list=" WHERE ".$specific_list;
					}else{
						$where_list="";
					}
					$sql="DELETE FROM ".$table_name." ".$where_list;
				break;
			}
            
            //print $sql;
            $return_array=array();
            $rslt=$this->rawQuery($sql);
			
			if($rslt){
				$this->Set_Result($rslt);
			}
            //$this->rslt=$this->Database_Raw_Query($sql);
			if($array_type=="Assoc"){
				while($myrow=$this->Fetch_Assoc($rslt)){
					$return_array[]=$myrow;
				}
			}else{
				while($myrow=$this->Fetch_Array($rslt)){
					$return_array[]=$myrow;
				}
			}
            
            //print_r($return_array);
            //print_r("ggg=> \n");
            return $return_array;
          }

    }