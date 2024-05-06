<?php

    //class clsDomain extends clsFormCreator{
        class clsDomain {
        

        public $output;

        public $Message;
        
        public $var=array();
        public $cls=array();
        function __construct(){
            $this->var=&clsClassFactory::$vrs;
            $this->cls=&clsClassFactory::$cls;

        
            
            //$className="\n Class=>".__CLASS__."  => \n";
			//print $className;

           
		}

        
        /*
        public function __call($method, $arguments)
        {
            try {
                
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
        
        
        public function __call($method, $arguments)
        {
            try {
                echo"--666-------------------------".$method."--------------------------------------------------\n";
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
        */
        /*
        public function __call($method, $arguments)
        {
            try {
                echo"--666------Call Function--------------Method=>-----".$method."-------vls=>--".__CLASS__."-----------------------------------------\n";
                $return_variable=null;
                if(method_exists($this,$method)){
                    
                    //$this->Start_App_Vars();
                    //exit("bboo".var_export($this,true));
                    $return_variable=call_user_func_array([$this, $method], $arguments);
                    
                    //$this->Update_App_Vars();
                }
                return $return_variable;
            } catch (Exception $e) {
                throw $e;
            }
            
        }
        */
        public function Domain_Init(){
            //$this->Start_App_Vars();
            //$this->cls->clsLog->general("-Domain Module Loading-",1);
            
            //$current_domain=eregi_replace("www\.","",$_SERVER['HTTP_HOST']);
            $current_domain= str_replace('www.', "",$_SERVER['HTTP_HOST']);
            
            //$current_domain=$_SERVER['HTTP_HOST'];
            //$this->cls->clsLog->general("-Domain Loading-".$current_domain."|",1);
            //define('DOMAINNAME',$current_domain);
            
            if(isset($_GET['dcmshost'])){
                $TargetHost=urldecode($_GET['dcmshost']);
            }else{
                $TargetHost=$current_domain;
            }
            
            if(isset($_GET['ajax'])){
                $this->var['domain']["db"]['templatesID']=35;
                $this->var['content']["db"]['templatesID']=35;
            }
            
            //echo"--73----------------------------".var_export($this->var['content'],true)."-----------------------------------------------\n";
            
            $this->var['content']["TargetHost"]=$TargetHost;
            $this->var['content']["original_domain"]=$current_domain;
            
            $TotalDomainName=str_replace("www\.", "", $TargetHost);
            $this->var['content']["TOTALDOMAINNAME"]=$TotalDomainName;
            //define('TOTALDOMAINNAME',$TotalDomainName);
            $this->cls->clsLog->general("\n-",1);
            $this->cls->clsLog->general("-Domain Total Loading 2-".$TargetHost,1);
            
            $DomainVariableArray=array();
            $this->var['domain_user']=array();
            $csearch=true;
            $totalcount=0;
            $num_rows=0;
            $this->var['domain']["db"]=array();
            $this->var['domain']["dcmshost"]="";
            if(isset($_GET['dcmshost'])){
                $this->var['domain']["dcmshost"]=$_GET['dcmshost'];
            }
            
            $this->cls->clsLog->general("1 In Domain Counting Down->".$csearch."->".$TotalDomainName,3);
            //echo"--4411108-------------------------".$csearch."--------------------------------------------------\n";
            while($csearch){
                if($totalcount>10){
                    $csearch=false;
                }	
                if(strlen($TotalDomainName)==0){
                    $csearch=false;
                }
                $totalcount++;
                if($TotalDomainName!=""){
                    
                    //echo"\n\n--22222-------------------------".$csearch."--------------------------------------------------\n";
                    
                    //$sql="SELECT DISTINCT * FROM domains WHERE Name='".$TotalDomainName."' LIMIT 0,1";
                    $sql="SELECT DISTINCT * FROM domains WHERE Name='".$TotalDomainName."'";
                    //$sql="SELECT DISTINCT * FROM clients";
                    //$sql="SELECT COUNT(*) AS total FROM content_pages";
                    
                    //$csearch=false;
                    //echo"\n\n--22222-------------------------".$sql."--------------------------------------------------\n";
                    
                    $this->cls->clsLog->general("1 In Domain Counting Down->".$sql,3);
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    if($num_rows>0){
                        $row = $this->cls->clsDatabaseInterface->Fetch_Assoc();
                        /*
                        $this->cls->clsContent->Content_Init_Page_Details();
                        $sql="SELECT domainsID FROM content_pages WHERE  URI='".$this->var['content']["URI"]."'  LIMIT 0,1";
                        
                        $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                        $content_row = $this->cls->clsDatabaseInterface->Fetch_Assoc();
                        if($row['id']!=$content_row['domainsID']){
                            //$sql="SELECT DISTINCT * FROM domains WHERE id='".$content_row['domainsID']."'";
                            //echo"\n\n--22222-------------------------".$sql."--------------------------------------------------\n";
                            //$rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                            //$num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                            //$row = $this->cls->clsDatabaseInterface->Fetch_Assoc();

                            $row['id']=0;
                        }
                        */
                        $this->var['domain']["db"]=$row;
                        $csearch=false;
                    }else{
                        //echo"\n\n--22222-------------------------".$num_rows."--------------------------------------------------\n";
                    }
                    
                                        
                    
                    //echo"\n\n778xxx-nr->".$num_rows;
                    $this->cls->clsLog->general("Domain Counting Down->".$sql,3);
                    //echo"--4432-------------------------".$csearch."--------------------------------------------------\n";
                }else{
                    $sql="SELECT DISTINCT * FROM domains WHERE Name='ajax.install.me'";
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    if($num_rows>0){
                        $row = $this->cls->clsDatabaseInterface->Fetch_Assoc();
                        $this->var['domain']["db"]=$row;
                    }
                    //echo"\n\n--22222112-------------------------".$csearch."--------------------------------------------------\n";
                    $num_rows=0;
                    $csearch=false;
                }
                //echo"--4412345-------------------------".$csearch."--------------------------------------------------\n";
                //if($rslt){
                //print_r($this->var['domain']);
                if($num_rows>0){
                    //$this->var['domain']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc();//reset to mirror site details
                    
                    //print_r($this->var['domain']);
                    //echo"--44321-------------------------".$csearch."--------------------------------------------------\n";
                    //$num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    //echo"11nr->".$num_rows;
                    $this->cls->clsLog->general("Domain Found->".$num_rows,3);
                    //if($num_rows>0){
                    //$this->var['domain']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc();//reset to mirror site details
                    $csearch=false;
                    $this->cls->clsLog->general("Domain cr->".$num_rows,3);
                    //if(!defined(DOMAINNAME)) define('DOMAINNAME',$TotalDomainName);
                    $this->cls->clsLog->general("Domain ar->".$num_rows,3);
                    //$this->var['domain']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc();
                    //print_r($this->var['domain']);
                    $this->cls->clsLog->general("Domain xr->".var_export($this->var['domain'],true),3);
                    //echo"--44666-------------------------".$csearch."--------------------------------------------------\n";
                    if(isset($this->var['domain']["db"]['mirrorID'])){
                        // if domain is mirrored reset domain_data to domain referenced
                        if($this->var['domain']["db"]['mirrorID']>0){
                            $this->cls->clsLog->general("Domain Mirror->",3);
                            $sql="SELECT * FROM domains WHERE id=".$this->var['domain']["db"]['mirrorID'];
                            $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                            $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                            if($num_rows>0){
                                $this->var['domain']["original_db"]=$this->var['domain']["db"];
                                $this->var['domain']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc();//reset to mirror site details
                                $this->cls->clsLog->general("Domain zr->".var_export($this->var['domain'],true),3);
                            }
                        }
                    }
                    //print_r($this->var['domain']);
                    $this->cls->clsLog->general("Domain br->".var_export($this->var['domain'],true),3);
                        
                        //if(!defined(DOMAINSID)) define('DOMAINSID',$this->var['domain']['id']);
                    //}	
                }else{
                    $TArr=explode('.',$TotalDomainName);
                    //print_r($TArr);
                    if(!isset($this->var['domain']["dcmshost"])){
                        if(count($TArr)>2){
                            for($x=0;$x<(count($TArr)-2);$x++){
                                $this->var['domain_user']["sub_domain_items"][$x]=$TArr[$x];
                                //$this->var['domain_user']["sub_domain_total"].=($x==0 : '.' ? '').$TArr[$x];
                            }
                        }
                    }
                    
                    
                    $TotalDomainName="";
                    for($x=1;$x<count($TArr);$x++){
                        $tmp=($x!=1 ? '.':""); 
                        $TotalDomainName.=$tmp.$TArr[$x];
                    }
                    //echo"--".$TotalDomainName;
                    //if($TotalDomainName!="localhost"){
                    $count=strpos($TotalDomainName,".");
                    //print_r($matches);
                    if($count==0){
                        $this->var['domain']["original_db"]['domain_type']="install.me";
                        //$TotalDomainName="install.me";
                    //if(strpos($TotalDomainName,"\.")==false){
                        //if(!pre($TotalDomainName)){
                        //exit($count."Invalid Domain Name->".$TotalDomainName);
                        $this->cls->clsLog->general("Invalid Domain Count DownName->".$sql." ".$TotalDomainName."|",3);
                    }
                    //	}
                };
            }
                //}else{
        //		$this->cls->clsLog->general("Invalid Domain Name None Found->".$sql."  ".$TotalDomainName,3);
            //}
            
            $this->var['domain']["TotalDomainName"]=$TotalDomainName;
            $this->var['domain']["DomainVariableArray"]=$DomainVariableArray;
            //print_r($this->var['domain']);
            //echo"--744------------------------------";//.var_export($DomainVariableArray,true)."---------------------------------------------\n";
            $this->cls->clsLog->general("Domain Ending->",3);
            $this->cls->clsLog->general("Sub Domain Check->".var_export($DomainVariableArray,true),3);
            
            
            if(count($DomainVariableArray)>0){
                //echo $sql."--405---------------------------------------------------------------------------\n";
                //$DName=$DomainVariableArray[0];
                $DName=$this->var['domain_user']["sub_domain_total"];
                $sql="SELECT * FROM users WHERE subdomain='".$DName."' LIMIT 0,1";

                $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                $domain_count=$this->cls->clsDatabaseInterface->NumRows($rslt);
                //echo $domain_count."--405---------------------------------------------------------------------------\n";
                if($domain_count>0){
                    $continue=true;
                    //while($myrow=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt)){
                    $myrow=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                    $sql="SELECT domainsID FROM mod_business_categories WHERE id='".$myrow['mod_business_categoriesID']."'";
                    $rslt2=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $data=$this->cls->clsDatabaseInterface->Fetch_Array($rslt2);
                    //print_r($myrow);
                    //flush();
                    if($data[0]==$this->var['domain']["db"]['id']){
                        $this->var['domain_user']["db"]=$myrow;
                    }
                    //}
                }else{
                    // show 404 error
                    
                    $sql="SELECT * FROM content_pages WHERE  module_viewsID='801'";
                    //echo "--414----------".$sql."--------------------------------454---------------------------------\n";
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $this->var['content_domain']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                    //echo "--404----------".$sql."-----------------".var_export($this->var['content_domain'],true)."---------------414---------------------------------\n";
                }
                //echo $sql."--405---------------------------------------------------------------------------\n";
            }else{
                //echo $sql."--2222---------------------------------------------------------------------------\n";
            }
            //echo "--888---------------------------------".var_export($this->var['content_domain'],true)."------------------------------------------\n";
            ////echo"-333-".$TotalDomainName."--".var_export($this->var['content'],true)."-123-".var_export($this->var['domain'],true)."--".var_export($this->var['content_domain'],true);
            //echo"-222-".var_export($this->var['domain'],true)."--22--";
            $this->cls->clsLog->general("Domain Complete->",3);
            $this->cls->clsLog->general("\n",3);
            //echo "--8887654321---------------------------------".var_export($this->var['content_domain'],true)."------------------------------------------\n";
            if(isset($_GET['ajax'])){
                $this->var['domain']["db"]['templatesID']=35;
                $this->var['content']["db"]['templatesID']=35;
            }
            //echo"\n\n--22222XXXY-------------------------".$sql."--------------------------------------------------\n";
            //print_r($this->var['domain']);
            //$this->Update_App_Vars();
            
        }

        public function Pre_Modify_Domain(){
            $this->output="Pre Out";
            return $this->output;
        }
        
        public function Domain_List(){
            $this->output=__METHOD__;
            return $this->output;
        }

        public function Admin_Add_Domain(){
            echo"hh";
            $this->output=__METHOD__;
            return $this->output;
        }

    }