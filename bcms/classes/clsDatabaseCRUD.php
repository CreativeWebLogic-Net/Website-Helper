<?php
    class clsDatabaseCRUD{

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

		public function Exec_Retrieve($array_type="Assoc",$table_name,$columns_array=array(),$specific_columns=array(),$order_by="id",$max_rows=0,$page_number=1){
			$query_type="Retrieve";
			/*
			if($specific_list!=""){
				$where_list=" WHERE ".$specific_list;
			}else{
				$where_list="";
			}
			
			$sql="SELECT ".$retrieve_list." FROM ".$table_name." ".$where_list." ".$order_by_sql." ".$sql_limits;
			*/
			return $this->Execute_Database_Query($array_type,$query_type,$table_name,$columns_array,$specific_columns,$order_by,$max_rows,$page_number);
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