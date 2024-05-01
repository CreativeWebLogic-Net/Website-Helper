<?php

    class clsText{
        
        private $content_pagesID=0;

        public $var=array();
        public $cls=array();
        function __construct(){
            $this->var=&clsClassFactory::$vrs;
            $this->cls=&clsClassFactory::$cls;
        }

        public function __call($method, $arguments)
        {
            try {
                //echo"--666-------------------------".$method."--------------------------------------------------\n";
                $return_variable=null;
                if(method_exists($this,$method)){
                    $this->Start_App_Vars();
                    $return_variable=call_user_func_array([$this, $method], $arguments);
                    $this->Update_App_Vars();
                }
                return $return_variable;
            } catch (Exception $e) {
                throw $e;
            }
            
        }


        function Pre_Display(){
            $this->Start_App_Vars();
            //echo"\n\n--D2222III---------------------------------------------------------------------------\n";
            //print_r($this->var['content']);
            //$sql="SELECT content_text FROM mod_text WHERE content_pagesID=".PAGESID;
            //$sql="SELECT content_text FROM mod_text WHERE content_pagesID=".$content_data["db"]['id'];
            //echo"700666-----------------------------------------------------------------------------\n";
            //print_r($this->var['content']);
            $content_pagesID=$this->var['content']['db']['id'];

            $sql="SELECT * FROM mod_text WHERE content_pagesID=".$content_pagesID;
            //print "\n".$sql."\n";
            $this->cls->clsLog->general("-yyy Text Display->".$sql,3);
            $rows=array();
            $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
            //print_r($rslt);
            //$num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
            //echo"\n -".$num_rows."-0001-----------------------------------------------------------------------------\n";
            $rows=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
            //print_r($rows);
            //echo"\n 10001-----------------------------------------------------------------------------\n";
            if(count($rows)>0){
                $this->var['text']["db"]=$rows;
            }else{
                $this->var['text']["db"]=array();
            }
            //return $this->var['text'];
            //print_r($text_data);
            //$this->cls->clsLog->general("-yx Text Display->".var_export($this->var['text']["db"],true),3);
            //print_r($this->var['text']);
            $this->Update_App_Vars();
        }
        /*
        function Display_Text(){
            $this->cls->clsLog->general("-yxz Text Display->",3);
            //print "-x-";
            if(isset($this->var['text']["db"]['content_text'])){
                
                $cur_str=ltrim($this->var['text']["db"]['content_text'],"\n\r\t\v\x00");
            }else{
                $cur_str="";
            }

            
            print $cur_str;
        }
        */
        /*
        function Pre_Display(){
            $this->cls->clsLog->general("-yxz Text Display->",3);
            //print "-x-";
            if(isset($this->var['text']["db"]['content_text'])){
                
                $cur_str=ltrim($this->var['text']["db"]['content_text'],"\n\r\t\v\x00");
            }else{
                $cur_str="";
            }

            
            print $cur_str;
        }
        */
        function Main_Display(){
            $this->Start_App_Vars();
            //print_r($this->var['text']);
            $ret_value="";
            if(isset( $this->var['text']["db"]['content_text'])){
                $ret_value=$this->var['text']["db"]['content_text'];
            }
            $this->Update_App_Vars();    
            return $ret_value;
        }
	
    }