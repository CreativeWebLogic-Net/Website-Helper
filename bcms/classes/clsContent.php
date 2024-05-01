<?php

    class clsContent{

        
        private $input_data=array();

        private $target=array();

        
        

        public $Message="";

        public $output="";

        public $var=array();
        public $cls=array();
        function __construct(){
            $this->var=&clsClassFactory::$vrs;
            $this->cls=&clsClassFactory::$cls;
            //echo"--555-------------------------aaa--------------------------------------------------\n";
            
            $this->Set_Input_Variables();
            
		}
        
        
        

        public function Set_Input_Variables(){
            if(isset($_SESSION['membersID'])){
                $this->input_data['membersID']=$_SESSION['membersID'];
            }else{
                $this->input_data['membersID']=0;
            }
            if(isset($_SESSION['LanguagesID'])){
                $this->input_data['LanguagesID']=$_SESSION['LanguagesID'];
            }else{
                $this->input_data['LanguagesID']=1;
            }
            if(isset($_GET['cpid'])){
                $this->input_data['cpid']=$_GET['cpid'];
            }else{
                if(isset($_POST['cpid'])){
                    $this->input_data['cpid']=$_POST['cpid'];
                }else{
                    $this->input_data['cpid']=0;
                }
            }
            if(isset($_GET['dcmsuri'])){
                $this->input_data['dcmsuri']=$_GET['dcmsuri'];
            }else{
                $this->input_data['dcmsuri']=0;
            }
            if(isset($_GET['change'])){
                $this->input_data['change']=$_GET['change'];
            }else{
                $this->input_data['change']=0;
            }           
            $this->input_data['REQUEST_URI']=$_SERVER['REQUEST_URI'];

            if($this->input_data['cpid']>0){
                $this->var['content']['cpid']=$this->input_data['cpid'];
            }
            $original_page=$this->input_data['REQUEST_URI'];
            $this->var['content']["original_uri"]=$original_page;
            //$original_page=$this->input_data['REQUEST_URI'];
            //$this->var['content']["original_uri"]=$original_page;
            $this->var['content']['cpid']=0;
            if(!isset($this->input_data['membersID'])) $this->input_data['membersID']=0;
		}
        
        public function Content_Init_Page_Details(){
            
            if(isset($this->var['content_domain']["db"])){
                if(count($this->var['content_domain']["db"])>0){
                    $this->var['content']["db"]=$this->var['content_domain']["db"];
                }
            }
            $this->cls->clsLog->general("-Content init Start->",1);
            if(!isset($this->input_data['membersID'])) $this->input_data['membersID']=0;
            $original_page=$this->input_data['REQUEST_URI'];
            $this->var['content']["original_uri"]=$original_page;
            $this->var['content']['cpid']=0;
            

            if($this->input_data['dcmsuri']>0){
                $this->var['content']["URI"]=$this->input_data['dcmsuri'];
                if($this->input_data['dcmsuri']>0){
                    $PArr=preg_split("/\//",$this->input_data['dcmsuri']);
                    
                }else{
                    $PArr=preg_split("/\//",$original_page);
                }
                $this->var['content']["proxy_uri"]=$this->var['content']["URI"];
            }else{
                $this->var['content']["URI"]="";
                $PArr = preg_split("/\//",$original_page);
                $this->var['content']["PArr"]=$PArr;
                if($PArr[1]==""){
                    $this->var['content']["URI"]='/';
                }else{
                    $this->var['content']["URI"]='/'.$PArr[1].'/';
                }
                
            }
        }
        

        public function Content_Init(){
            
            //echo"\n\n--D22222XXX---------------------------------------------------------------------------\n";
            //print_r($this->var['domain']);
            /*
            if(isset($this->var['content_domain']["db"])){
                if(count($this->var['content_domain']["db"])>0){
                    $this->var['content']["db"]=$this->var['content_domain']["db"];
                }
            }
            $this->cls->clsLog->general("-Content init Start->",1);
            */
            
            //if($this->input_data['cpid']>0){
            //    $this->var['content']['cpid']=$this->input_data['cpid'];
           // }
            $this->Content_Init_Page_Details();
            $PArr=$this->var['content']["PArr"];
            //print_r($this->var['content']);
            /*
            if($this->input_data['dcmsuri']>0){
                $this->var['content']["URI"]=$this->input_data['dcmsuri'];
                if($this->input_data['dcmsuri']>0){
                    $PArr=preg_split("/\//",$this->input_data['dcmsuri']);
                    
                }else{
                    $PArr=preg_split("/\//",$original_page);
                }
                $this->var['content']["proxy_uri"]=$this->var['content']["URI"];
            }else{
                $this->var['content']["URI"]="";
                $PArr = preg_split("/\//",$original_page);
                if($PArr[1]==""){
                    $this->var['content']["URI"]='/';
                }else{
                    $this->var['content']["URI"]='/'.$PArr[1].'/';
                }
                
            }
            */
            $content_data_uri=array();
            $this->var['content']["dcmsuri"]=$this->input_data['dcmsuri'];
            if($this->input_data['change']>0){
                $this->var['content']["change_datetime"]=urldecode($this->input_data['change']);
                $change_sql=" ,TIMESTAMPDIFF(HOUR,Changed,'".$this->var['content']["change_datetime"]."') AS cache_count";
            }else{
                $change_sql="";
            }
            //if(isset($_GET['cpid'])){
            //    print_r($this->var['content']);
            if(isset($this->var['content']['cpid'])){
                if($this->var['content']['cpid']>0){
                    //$this->var['content']["content_pagesID"]=$_GET['cpid'
                    $this->var['content']["content_pagesID"]=$this->var['content']['cpid'];
                    if($this->input_data['change']>0){
                        $sql='SELECT DISTINCT URI'.$change_sql.' FROM content_pages WHERE id='.$this->var['content']["content_pagesID"].' LIMIT 0,1';
                    }else{
                        $sql='SELECT DISTINCT URI,Changed AS cache_count FROM content_pages WHERE id='.$this->var['content']["content_pagesID"].' LIMIT 0,1';
                    }
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $num_rows=0;
                    $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    if($num_rows>0){
                        if(isset($this->var['content']["change_datetime"])){
                            exit("Use Cached File");
                        }else{
                        }
                        $content_data_uri=$this->cls->clsDatabaseInterface->Fetch_Assoc();
                    }
                    if(isset($content_data_uri['URI'])){
                        $this->var['content']["URI"]=$content_data_uri['URI'];
                        $this->var['content']["uri"]=$this->var['content']["URI"];
                    }
                }else{
                    $this->var['content']["content_pagesID"]=0;
                    $this->var['content']["uri"]=$this->var['content']["URI"];
                }
                
            }else{
                $this->var['content']["content_pagesID"]=0;
                $this->var['content']["uri"]=$this->var['content']["URI"];
            }
                //print_r($PArr);
            $this->var['content']["uri_split_array"]=$PArr;
            $current_page="/";
            $get_variables=array();
            foreach($this->var['content']["uri_split_array"] as $key=>$val){
                $pos = strpos($val, '=');
                if($pos){
                    $parts = explode('=', $val);
                    $get_variables[$parts[0]]=$parts[1];
                }else{
                    if(strlen($val)>0){
                        $current_page.=$val."/";
                    }
                }
            }
            $this->var['content']['get_variables']=$get_variables;
            
            if(!isset($this->var['content']["TOTALPAGENAME"])){
                $this->var['content']['RESET']=true;
                $TotalPageName=$current_page;
                $this->var['content']["TOTALPAGENAME"]=$TotalPageName;
            }
            $OriginalPageName=$TotalPageName;
            if(substr($TotalPageName,strlen($TotalPageName)-1)!="/"){
                $TotalPageName.="/";
                $this->var['content']["TOTALPAGENAME"]=$TotalPageName;
            }
            $VariableArray=array();
            $csearch=true;
            $notfound=true;
            $csearch=true;
            $segment=0;// times we go around
            $this->cls->clsLog->general("-Content Biz Cats-",1);
            
            //======================================================================== If user home page
            if(isset($this->var['domain_user'])>0){
                if(count($this->var['domain_user'])>0){
                    if(isset($this->var['domain']["db"]['id'])){
                        $sql="SELECT * FROM content_pages WHERE module_viewsID='25' AND domainsID=".$this->var['domain']["db"]['id']." AND languagesID=".$this->input_data['LanguagesID']." LIMIT 0,1";
                        $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                        if($this->cls->clsDatabaseInterface->NumRows($rslt)>0){
                            $csearch=false;
                            $notfound=false;
                            //if(!defined("PAGENAME")){
                                //define('PAGENAME',$TotalPageName);
                                $this->var['content']["PAGENAME"]=$TotalPageName;
                            //}
                            $this->var['content']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);	
                            if(isset($this->var['domain_user']['mod_business_categoriesID'])){
                                $sql="SELECT * FROM mod_business_categories WHERE id=".$this->var['domain_user']['mod_business_categoriesID'];
                        
                                $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                                $this->var['bizcat']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);	
                                
                                $this->var['content']["db"]['Meta_Title']=$this->var['domain_user']['name']." - ".$this->var['bizcat']['CategoryTitle']." - ".$this->var['content']["db"]['Meta_Title'];
                            }
                            
                        }
                    }
                    
                }
            }
            //======================================================================== If page updated for cache
            $sql="";
            if(isset($this->var['content']["change_datetime"])){
                $change_sql=" ,TIMESTAMPDIFF(HOUR,Changed,'".$this->var['content']["change_datetime"]."') AS cache_count";
                $change_sql_where=" AND cache_count<1";
            }else{
                $change_sql_where="";
                $change_sql="";
            }
            //print_r($this->var['content']);
            //======================================================================== If site is search engine friendly
            if(isset($this->var['domain']["db"]["SEOFriendlyLT"])){
                if($this->var['domain']["db"]["SEOFriendlyLT"]==13){
                    if($this->var['content']["content_pagesID"]>0){
                        $sql="SELECT * FROM content_pages WHERE id='".$this->var['content']["content_pagesID"]."'  LIMIT 0,1";

                        $sql="SELECT *".$change_sql." FROM content_pages WHERE id='".$this->var['content']["content_pagesID"]."'   LIMIT 0,1";
                    }else{
                        $sql="SELECT *".$change_sql." FROM content_pages WHERE  URI='".$this->var['content']["URI"]."'  AND domainsID=".$this->var['domain']['db']['id']."  LIMIT 0,1";
                    }
                }elseif($this->var['domain']["db"]["SEOFriendlyLT"]==12){
                    //print_r($this->var['domain']);
                    $sql="SELECT DISTINCT *".$change_sql." FROM content_pages WHERE URI='".$this->var['content']["URI"]."'   AND domainsID=".$this->var['domain']['db']['id']."";
                    //print $sql;
                    //print_r($this->var['domain']);
                }
            }elseif($this->var['content']["content_pagesID"]>0){
                $sql="SELECT *".$change_sql." FROM content_pages WHERE id='".$this->var['content']["content_pagesID"]."'  LIMIT 0,1";
            }else{
                $sql="SELECT *".$change_sql." FROM content_pages WHERE HomePageLT=12   LIMIT 0,1";
            }
            //print " \n DB=>".$sql." \n";
            $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
            $num_rows=0;
            $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
            //print_r($this->var['content']);
            if($num_rows>0){
                //exit();
                
                $this->var['content']['PAGENAME']=$OriginalPageName;
                $this->var['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                $this->var['content']["content_pagesID"]=$this->var['content']['db']['id'];
                $notfound=false;
                $csearch=false;
                if(isset($this->var['content']['db']['cache_count'])){
                    if($this->var['content']['db']['cache_count']<0){
                        exit("Use Cached File");
                    }
                }
                //print_r($this->var['content']['db']);
                //print_r($_SESSION);
                /*
                if($this->var['content']['db']['ExposureLT']==37){
                    if($_SESSION['membersID']==0){
                        $TotalPageName="/";
                        $csearch=true;
                    }else{
                        $TotalPageName="/login/";
                        $csearch=true;
                    }
                    $_SESSION['PAGENAME']=$this->var['content']['PAGENAME'];
                }
                
                if(($_SESSION['membersID']==0)&&($this->var['content']['db']['Exposure']=="Member")){
                    $TotalPageName="/login/";
                    //define('PAGENAME',$TotalPageName);
                    $csearch=true;
                    //echo"Member Page";
                    //exit();
                    header("Location: /");
                    $_SESSION['PAGENAME']=$this->var['content']['PAGENAME'];
                    print_r($_SESSION);
                }else{
                    //define('PAGENAME',$OriginalPageName);
                }
                */
            }else{
            }
            //print"\n XX \n";
            //print_r($this->var['domain']);
            $this->cls->clsLog->general("-Content Search-",1);
            if(isset($this->var['domain']['db']['id'])){
                $domain_search=$this->var['domain']['db']['id'];
            }else{
                $domain_search="";
            }
            
            $max_count=0;
            
            while(($csearch)&&($max_count<10)){
                $max_count++;
                $sql="SELECT * FROM content_pages WHERE URI='".$TotalPageName."' AND domainsID=".$domain_search." AND languagesID=".$this->input_data['LanguagesID']."";
                $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                
                if($num_rows>0){
                    $csearch=false;
                    $notfound=false;
                    //if(!isset(PAGENAME)) define('PAGENAME',$TotalPageName);
                    $this->var['content']['PAGENAME']=$OriginalPageName;
                    $this->var['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);	
                    //print_r($this->var['content']);
                    if(!isset($_SESSION['membersID'])&&($this->var['content']['db']['ExposureLT']==37)){
                        //echo"Member Page";
                        exit("Member Page");
                        //header("Location: /");
                    }
                    
                    
                    
                }else{
                    //exit("XX Find Page=>".$sql."  <=>".$TotalPageName);
                    $TArr=explode('/',$TotalPageName);
                    if(count($TArr)>2){
                        $VariableArray[]=$TArr[count($TArr)-2];
                        $TotalPageName="";
                        for($x=0;$x<(count($TArr)-2);$x++){
                            $TotalPageName.=$TArr[$x]."/";
                        }
                    }
                    
                    if($TotalPageName=="/"){
                        if($domain_search>0){
                            $domain_search=0;
                            $csearch=true;
                            $TotalPageName=$OriginalPageName;
                        }else{
                            $csearch=false;
                            $this->var['content']['PAGENAME']=$OriginalPageName;
                            //define('PAGENAME',TOTALPAGENAME);
                        }
                        
                    }else{
                        $csearch=true;
                    }
                    //print $TotalPageName;
                };
                
                //print "--".$sql."==";
            };
            //print_r($this->var['content']);
            
            if($notfound){
                $sql="SELECT * FROM content_pages WHERE URI='".$this->var['content']['PAGENAME']."' AND domainsID=".$this->var['domain']["db"]['id']."";
                $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                if($this->cls->clsDatabaseInterface->NumRows($rslt)==0){// cant find page so load homepage for language/site
                    $sql="SELECT * FROM content_pages WHERE URI='".$this->var['content']['PAGENAME']."' AND domainsID=0";
                    //print $sql;
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    if($num_rows>0){
                        $this->var['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                    }else{
                        if($this->var['content']["original_uri"]=="/"){
                            // on homepage
                            $this->var['content']['db']=$this->cls->clsDatabaseInterface->Execute_Database_Query("Retrieve","content_pages",
                            array("HomePage_item-groups-Boolean-ModalID"=>12,"languagesID"=>$_SESSION['LanguagesID'],"domainsID"=>$this->var['domain']["db"]['id']));
                            //$sql="SELECT * FROM content_pages WHERE HomePage='Yes' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=".$this->var['domain']["db"]['id'];
                        }elseif($this->var['content']["original_uri"]!="/"){
                            // on homepage
                            $this->var['content']['db']=$this->cls->clsDatabaseInterface->Execute_Database_Query("Retrieve","content_pages",
                            array("URI"=>$this->var['content']['PAGENAME'],"languagesID"=>$_SESSION['LanguagesID'],"domainsID"=>0));
                            //$sql="SELECT * FROM content_pages WHERE URI='".$this->var['content']['PAGENAME']."' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=0";
                        }else{
                            $this->var['content']['db']=$this->cls->clsDatabaseInterface->Execute_Database_Query("Retrieve","content_pages",
                            array("module_viewsID"=>801));
                            // when no page has been created - 404 error page
                            //$sql="SELECT * FROM content_pages WHERE module_viewsID='801'";
                        }
                        
                        //$rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                        //$num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                        if($num_rows>0){
                            //http_response_code(404);
                            $this->var['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                        }
                        //print $this->var['content']['PAGENAME'];
                        if($this->var['content']['PAGENAME']!="/404.shtml"){
                            
                            //http_response_code(404);
                            //header("Location: /404.shtml");
                        }
                        
                    }
                }else{
                    $this->var['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                    $_SESSION['LanguagesID']=$this->var['content']['languagesID'];
                };
            };
            
            $this->var['content']["db"] = $this->cls->clsAssortedFunctions->strip_capitals($this->var['content']["db"]);
            //print_r($this->var['content']);
            if(isset($this->var['content']['db']['module_viewsid'])){
                $content_id=$this->var['content']['db']['module_viewsid'];
            }else{
                $content_id=0;
            }
            
            $sql="SELECT * FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$content_id;
            //$sql="SELECT * FROM modules,module_views WHERE modules.id=module_views.modulesID AND module_views.id=".$module_viewsID;
            $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
            $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
            
            if($num_rows==0){
                
                //header("Location: /");
            }else{
                
                //clsSystem::$vars->content_data=$this->var['content'];
                //echo"321012345555-----------------------------------------------------------------------------\n";
                $this->var['module']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                //echo"2234321012345555-----------------------------------------------------------------------------\n";
                $this->var['module']["db"] = $this->cls->clsAssortedFunctions->strip_capitals($this->var['module']["db"]);
                //echo"112234321012345555-----------------------------------------------------------------------------\n";
                //print_r($this->var['module']);
                $target_class=$this->var['module']["db"]['class'];
                //echo $target_class."-00001112234321012345555-----------------------------------------------------------------------------\n";
                $this->target=new $target_class();
                //echo"1112234321012345555-----------------------------------------------------------------------------\n";
                //print_r($this->var['module']);
                //if($this->var['module']["db"]['Pre_FileName']!=""){
                $pre_method=$this->var['module']["db"]['Pre_Method'];
                //echo"54321012345555-----------------------------------------------------------------------------\n";
                if($pre_method!=""){
                    $this->target->$pre_method();
                    /*
                    $lfile=$this->cls->clsAssortedFunctionspp_data['MODULEBASEDIR'].$this->var['module']["db"]['Dir']."/".$pre_file;
                    //print $lfile;
                    if (file_exists($lfile)) {
                        include($lfile);
                    }else{
                        $this->cls->clsLog->general("AA error->",1);
                        //echo"AA error";
                    }
                    */
                }
                // check for member session
                if(!isset($_SESSION['membersID'])&&($this->var['content']["db"]['ExposureLT']==37)){
                    //echo"Member Page";
                    $this->cls->clsLog->general("Member Page->",1);
                    //header("Location: /");
                }
            }
            if(isset($this->var['content']["content_pagesID"])){
                $this->var['content']["content_pagesid"]=$this->var['content']["content_pagesID"];
            }
            
            $this->cls->clsLog->general("-End Content init->",1);
            if(isset($_GET['ajax'])){
                $this->var['domain']["db"]['templatesID']=35;
                $this->var['content']["db"]['templatesID']=35;
            }
            //echo"\n\n--22222GGG-------------------------".$sql."--------------------------------------------------\n";
            //print_r($this->var['content']);
            
            
        }


        public function Display(){
            
            $this->cls->clsLog->general("-ab Text Display->",3);
            $return_html="";
            //$target=new $this->var['module']["db"]['class']();
            //print_r($this->var['module']);
            if(isset($this->var['module']["db"]['Method'])){
                $method=$this->var['module']["db"]['Method'];
            }else{
                $method="";
            }
            
            if($method!=""){
                $return_html=$this->target->$method();
            }
            
            return $return_html;
            /*
            if(isset($module_data["db"]['dir'])){
                $module_template_display=$app_data['MODULEBASEDIR'].$module_data["db"]['dir']."/".$module_data["db"]['filename'];
                if(file_exists($module_template_display)){
                    //print $module_template_display;
                    $this->cls->clsLog->general("-ar Text Display->".$module_template_display."-".var_export($module_data,true),3);
                    $text_data['debug'][]=$module_template_display;
                    include($module_template_display);
                }else{
                }
            }
            */
        }


        public function Content_Pages_Add_Table(){
            return $this->output;
        }

        public function Content_Pages_Edit_Table(){
            return $this->output;
        }

        public function Content_Pages_List_Table(){

            $this->output=$this->cls->Create_Content_Pages_List_Table();
            return $this->output;
        }

        public function Pre_Modify_Page(){

        }

        public function Pre_Add_Page(){
            
        }

        public function Pre_Edit_Page(){
            
        }
    }