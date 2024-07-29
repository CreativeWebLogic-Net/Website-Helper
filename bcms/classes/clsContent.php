<?php

    class clsContent{

        
        private $input_data=array();

        private $target=array();

        private $target_class="";

        
        

        public $Message="";

        public $output="";
        public $all_vars=array();
        public $var=array();
        public $cls=array();
        function __construct(){
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
                $this->all_vars['content']['cpid']=$this->input_data['cpid'];
            }
            $original_page=$this->input_data['REQUEST_URI'];
            $this->all_vars['content']["original_uri"]=$original_page;
            //$original_page=$this->input_data['REQUEST_URI'];
            //$this->all_vars['content']["original_uri"]=$original_page;
            $this->all_vars['content']['cpid']=0;
            if(!isset($this->input_data['membersID'])) $this->input_data['membersID']=0;
            //$this->vrs->do=$this->all_vars;
            
		}
        
        public function Content_Init_Page_Details(){
            
            if(isset($this->all_vars['content_domain']["db"])){
                if(count($this->all_vars['content_domain']["db"])>0){
                    $this->all_vars['content']["db"]=$this->all_vars['content_domain']["db"];
                }
            }
            
            //$this->cls->clsLog->general("-Content init Start->",1);
            if(!isset($this->input_data['membersID'])) $this->input_data['membersID']=0;
            $original_page=$this->input_data['REQUEST_URI'];
            $this->all_vars['content']["original_uri"]=$original_page;
            $this->all_vars['content']['cpid']=0;
            
            
            if($this->input_data['dcmsuri']>0){
                $this->all_vars['content']["URI"]=$this->input_data['dcmsuri'];
                if($this->input_data['dcmsuri']>0){
                    $PArr=preg_split("/\//",$this->input_data['dcmsuri']);
                    
                }else{
                    $PArr=preg_split("/\//",$original_page);
                }
                $this->all_vars['content']["proxy_uri"]=$this->all_vars['content']["URI"];
            }else{
                $this->all_vars['content']["URI"]="";
                $PArr = preg_split("/\//",$original_page);
                $this->all_vars['content']["PArr"]=$PArr;
                if($PArr[1]==""){
                    $this->all_vars['content']["URI"]='/';
                }else{
                    $this->all_vars['content']["URI"]='/'.$PArr[1].'/';
                }
                
            }
            //$this->vrs->do=$this->all_vars;

            
        }
        

        public function Content_Init(){
            
            //print_r($this->all_vars);
            
            //echo"\n\n--D22222XXX---------------------------------------------------------------------------\n";
            //print_r($this->all_vars['domain']);
            /*
            if(isset($this->all_vars['content_domain']["db"])){
                if(count($this->all_vars['content_domain']["db"])>0){
                    $this->all_vars['content']["db"]=$this->all_vars['content_domain']["db"];
                }
            }
            $this->cls->clsLog->general("-Content init Start->",1);
            */
            
            //if($this->input_data['cpid']>0){
            //    $this->all_vars['content']['cpid']=$this->input_data['cpid'];
           // }
           
            $this->Content_Init_Page_Details();

            $original_page=$this->input_data['REQUEST_URI'];
            $PArr=$this->all_vars['content']["PArr"];
            //print_r($this->all_vars['content']);
            
            if($this->input_data['dcmsuri']>0){
                $this->all_vars['content']["URI"]=$this->input_data['dcmsuri'];
                if($this->input_data['dcmsuri']>0){
                    $PArr=preg_split("/\//",$this->input_data['dcmsuri']);
                    
                }else{
                    $PArr=preg_split("/\//",$original_page);
                }
                $this->all_vars['content']["proxy_uri"]=$this->all_vars['content']["URI"];
            }else{
                $this->all_vars['content']["URI"]="";
                $PArr = preg_split("/\//",$original_page);
                if($PArr[1]==""){
                    $this->all_vars['content']["URI"]='/';
                }else{
                    $this->all_vars['content']["URI"]='/'.$PArr[1].'/';
                }
                
            }
            
            
            $content_data_uri=array();
            $this->all_vars['content']["dcmsuri"]=$this->input_data['dcmsuri'];
            if($this->input_data['change']>0){
                $this->all_vars['content']["change_datetime"]=urldecode($this->input_data['change']);
                $change_sql=" ,TIMESTAMPDIFF(HOUR,Changed,'".$this->all_vars['content']["change_datetime"]."') AS cache_count";
            }else{
                $change_sql="";
            }

            //print_r($this->all_vars);
            
            //if(isset($_GET['cpid'])){
                
            if(isset($this->all_vars['content']['cpid'])){
                if($this->all_vars['content']['cpid']>0){
                    
                    //$this->all_vars['content']["content_pagesID"]=$_GET['cpid'
                    $this->all_vars['content']["content_pagesID"]=$this->all_vars['content']['cpid'];
                    if($this->input_data['change']>0){
                        $sql='SELECT DISTINCT URI'.$change_sql.' FROM content_pages WHERE id='.$this->all_vars['content']["content_pagesID"].' LIMIT 0,1';
                    }else{
                        $sql='SELECT DISTINCT URI,Changed AS cache_count FROM content_pages WHERE id='.$this->all_vars['content']["content_pagesID"].' LIMIT 0,1';
                    }
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $num_rows=0;
                    $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    if($num_rows>0){
                        if(isset($this->all_vars['content']["change_datetime"])){
                            exit("Use Cached File");
                        }else{
                        }
                        $content_data_uri=$this->cls->clsDatabaseInterface->Fetch_Assoc();
                    }
                    if(isset($content_data_uri['URI'])){
                        $this->all_vars['content']["URI"]=$content_data_uri['URI'];
                        $this->all_vars['content']["uri"]=$this->all_vars['content']["URI"];
                    }
                }else{
                    $this->all_vars['content']["content_pagesID"]=0;
                    $this->all_vars['content']["uri"]=$this->all_vars['content']["URI"];
                }
                
            }else{
                $this->all_vars['content']["content_pagesID"]=0;
                $this->all_vars['content']["uri"]=$this->all_vars['content']["URI"];
            }
                
            $this->all_vars['content']["uri_split_array"]=$PArr;
            $current_page="/";
            $get_variables=array();
            foreach($this->all_vars['content']["uri_split_array"] as $key=>$val){
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
            $this->all_vars['content']['get_variables']=$get_variables;
            //print_r($this->all_vars['content']['get_variables']);
            if(!isset($this->all_vars['content']["TOTALPAGENAME"])){
                $this->all_vars['content']['RESET']=true;
                $TotalPageName=$current_page;
                $this->all_vars['content']["TOTALPAGENAME"]=$TotalPageName;
            }
            $OriginalPageName=$TotalPageName;
            if(substr($TotalPageName,strlen($TotalPageName)-1)!="/"){
                $TotalPageName.="/";
                $this->all_vars['content']["TOTALPAGENAME"]=$TotalPageName;
            }
            $VariableArray=array();
            $csearch=true;
            $notfound=true;
            $csearch=true;
            $segment=0;// times we go around
            $this->cls->clsLog->general("-Content Biz Cats-",1);
            
            //======================================================================== If user home page
            if(isset($this->all_vars['domain_user'])>0){
                if(count($this->all_vars['domain_user'])>0){
                    if(isset($this->all_vars['domain']["db"]['id'])){
                        $sql="SELECT * FROM content_pages WHERE module_viewsID='25' AND domainsID=".$this->all_vars['domain']["db"]['id']." AND languagesID=".$this->input_data['LanguagesID']." LIMIT 0,1";
                        $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                        if($this->cls->clsDatabaseInterface->NumRows($rslt)>0){
                            $csearch=false;
                            $notfound=false;
                            //if(!defined("PAGENAME")){
                                //define('PAGENAME',$TotalPageName);
                                $this->all_vars['content']["PAGENAME"]=$TotalPageName;
                            //}
                            $this->all_vars['content']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);	
                            if(isset($this->all_vars['domain_user']['mod_business_categoriesID'])){
                                $sql="SELECT * FROM mod_business_categories WHERE id=".$this->all_vars['domain_user']['mod_business_categoriesID'];
                        
                                $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                                $this->all_vars['bizcat']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);	
                                
                                $this->all_vars['content']["db"]['Meta_Title']=$this->all_vars['domain_user']['name']." - ".$this->all_vars['bizcat']['CategoryTitle']." - ".$this->all_vars['content']["db"]['Meta_Title'];
                            }
                            
                        }
                    }
                    
                }
            }
            //======================================================================== If page updated for cache
            $sql="";
            if(isset($this->all_vars['content']["change_datetime"])){
                $change_sql=" ,TIMESTAMPDIFF(HOUR,Changed,'".$this->all_vars['content']["change_datetime"]."') AS cache_count";
                $change_sql_where=" AND cache_count<1";
            }else{
                $change_sql_where="";
                $change_sql="";
            }
            //print_r($this->all_vars['content']);
            //======================================================================== If site is search engine friendly
            if(isset($this->all_vars['domain']["db"]["SEOFriendlyLT"])){
                if($this->all_vars['domain']["db"]["SEOFriendlyLT"]==13){
                    if($this->all_vars['content']["content_pagesID"]>0){
                        $sql="SELECT * FROM content_pages WHERE id='".$this->all_vars['content']["content_pagesID"]."'  LIMIT 0,1";

                        $sql="SELECT *".$change_sql." FROM content_pages WHERE id='".$this->all_vars['content']["content_pagesID"]."'   LIMIT 0,1";
                    }else{
                        $sql="SELECT *".$change_sql." FROM content_pages WHERE  URI='".$this->all_vars['content']["URI"]."'  AND domainsID=".$this->all_vars['domain']['db']['id']."  LIMIT 0,1";
                    }
                }elseif($this->all_vars['domain']["db"]["SEOFriendlyLT"]==12){
                    //print_r($this->all_vars['domain']);
                    $sql="SELECT DISTINCT *".$change_sql." FROM content_pages WHERE URI='".$this->all_vars['content']["URI"]."'   AND domainsID=".$this->all_vars['domain']['db']['id']."";
                    //print $sql;
                    //print_r($this->all_vars['domain']);
                }
            }elseif($this->all_vars['content']["content_pagesID"]>0){
                $sql="SELECT *".$change_sql." FROM content_pages WHERE id='".$this->all_vars['content']["content_pagesID"]."'  LIMIT 0,1";
            }else{
                $sql="SELECT *".$change_sql." FROM content_pages WHERE HomePageLT=12   LIMIT 0,1";
            }
            //print " \n DB=>".$sql." \n";
            $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
            $num_rows=0;
            $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
            //print_r($this->all_vars['content']);
            if($num_rows>0){
                
                
                $this->all_vars['content']['PAGENAME']=$OriginalPageName;
                $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                
                $this->all_vars['content']["content_pagesID"]=$this->all_vars['content']['db']['id'];
                $notfound=false;
                $csearch=false;
                if(isset($this->all_vars['content']['db']['cache_count'])){
                    if($this->all_vars['content']['db']['cache_count']<0){
                        exit("Use Cached File");
                    }
                }
                //print_r($this->all_vars['content']['db']);
                //print_r($_SESSION);
                /*
                if($this->all_vars['content']['db']['ExposureLT']==37){
                    if($_SESSION['membersID']==0){
                        $TotalPageName="/";
                        $csearch=true;
                    }else{
                        $TotalPageName="/login/";
                        $csearch=true;
                    }
                    $_SESSION['PAGENAME']=$this->all_vars['content']['PAGENAME'];
                }
                
                if(($_SESSION['membersID']==0)&&($this->all_vars['content']['db']['Exposure']=="Member")){
                    $TotalPageName="/login/";
                    //define('PAGENAME',$TotalPageName);
                    $csearch=true;
                    //echo"Member Page";
                    //exit();
                    header("Location: /");
                    $_SESSION['PAGENAME']=$this->all_vars['content']['PAGENAME'];
                    print_r($_SESSION);
                }else{
                    //define('PAGENAME',$OriginalPageName);
                }
                */
            }else{
            }
            //print"\n XX \n";
            //print_r($this->all_vars['domain']);
            $this->cls->clsLog->general("-Content Search-",1);
            if(isset($this->all_vars['domain']['db']['id'])){
                $domain_search=$this->all_vars['domain']['db']['id'];
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
                    $this->all_vars['content']['PAGENAME']=$OriginalPageName;
                    $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);	
                    //print_r($this->all_vars);
                    if(!isset($_SESSION['membersID'])&&($this->all_vars['content']['db']['ExposureLT']==37)){
                        //echo"Member Page";
                        //exit("Member Page");
                        //header("Location: /");
                    }
                    //print_r($this->all_vars);
                    if($this->all_vars['content']["db"]['domainsID']==0){
                        // what group is the page in => management
                    
                        if($_SESSION['membersID']>0){
                            // member logged in
                            if($this->all_vars['content']["db"]['ExposureLT']>36){
                                // page either member or both
                                //echo"Member Page 1";
                            }else{
                                header("Location: /login-management/");
                            }
                        }
                    }else{
                        // what group is the page in => public
                        //echo"Public Page 1";
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
                            $this->all_vars['content']['PAGENAME']=$OriginalPageName;
                            //define('PAGENAME',TOTALPAGENAME);
                        }
                        
                    }else{
                        $csearch=true;
                    }
                    //print $TotalPageName;
                };
                
                //print "--".$sql."==";
            };
            //print_r($this->all_vars['content']);
            
            if($notfound){
                $sql="SELECT * FROM content_pages WHERE URI='".$this->all_vars['content']['PAGENAME']."' AND domainsID=".$this->all_vars['domain']["db"]['id']."";
                $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                if($this->cls->clsDatabaseInterface->NumRows($rslt)==0){// cant find page so load homepage for language/site
                    $sql="SELECT * FROM content_pages WHERE URI='".$this->all_vars['content']['PAGENAME']."' AND domainsID=0";
                    //print $sql;
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    if($num_rows>0){
                        $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                    }else{
                        if($this->all_vars['content']["original_uri"]=="/"){
                            // on homepage
                            $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Execute_Database_Query("Retrieve","content_pages",
                            array("HomePage_item-groups-Boolean-ModalID"=>12,"languagesID"=>$_SESSION['LanguagesID'],"domainsID"=>$this->all_vars['domain']["db"]['id']));
                            //$sql="SELECT * FROM content_pages WHERE HomePage='Yes' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=".$this->all_vars['domain']["db"]['id'];
                        }elseif($this->all_vars['content']["original_uri"]!="/"){
                            // on homepage
                            $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Execute_Database_Query("Retrieve","content_pages",
                            array("URI"=>$this->all_vars['content']['PAGENAME'],"languagesID"=>$_SESSION['LanguagesID'],"domainsID"=>0));
                            //$sql="SELECT * FROM content_pages WHERE URI='".$this->all_vars['content']['PAGENAME']."' AND languagesID=".$_SESSION['LanguagesID']." AND domainsID=0";
                        }else{
                            $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Execute_Database_Query("Retrieve","content_pages",
                            array("module_viewsID"=>801));
                            // when no page has been created - 404 error page
                            //$sql="SELECT * FROM content_pages WHERE module_viewsID='801'";
                        }
                        
                        //$rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                        //$num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                        if($num_rows>0){
                            //http_response_code(404);
                            $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                        }
                        //print $this->all_vars['content']['PAGENAME'];
                        if($this->all_vars['content']['PAGENAME']!="/404.shtml"){
                            
                            //http_response_code(404);
                            //header("Location: /404.shtml");
                        }
                        
                    }
                }else{
                    $this->all_vars['content']['db']=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                    $_SESSION['LanguagesID']=$this->all_vars['content']['languagesID'];
                };
                
            };
            //print_r($this->all_vars);
            $this->all_vars['content']["db"] = $this->cls->clsAssortedFunctions->strip_capitals($this->all_vars['content']["db"]);
            //print_r($this->all_vars['content']);
            if(isset($this->all_vars['content']['db']['module_viewsid'])){
                $content_id=$this->all_vars['content']['db']['module_viewsid'];
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
                
                //clsSystem::$vars->content_data=$this->all_vars['content'];
                //echo"321012345555-----------------------------------------------------------------------------\n";
                $this->all_vars['module']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                //echo"2234321012345555-----------------------------------------------------------------------------\n";
                $this->all_vars['module']["db"] = $this->cls->clsAssortedFunctions->strip_capitals($this->all_vars['module']["db"]);
                //echo"112234321012345555-----------------------------------------------------------------------------\n";
                
                $this->target_class=$this->all_vars['module']["db"]['class'];
                $target_class=$this->target_class;
                //echo $target_class."-00001112234321012345555-----------------------------------------------------------------------------\n";
                //$this->target=new $target_class();
                clsClassFactory::Add_Class($this->target_class);
                //Add_Class($this->target);
                //echo"1112234321012345555-----------------------------------------------------------------------------\n";
                //print_r($this->all_vars['module']);
                //if($this->all_vars['module']["db"]['Pre_FileName']!=""){
                $pre_method=$this->all_vars['module']["db"]['Pre_Method'];
                //echo"54321012345555-----------------------------------------------------------------------------\n";
                if($pre_method!=""){
                    //$this->target->$pre_method();
                    //$this->cls->$this->target_class->$pre_method();
                    //$this->cls->__call($this->target_class,$pre_method);
                    clsClassFactory::$cls->$target_class->$pre_method();
                    /*
                    $lfile=$this->cls->clsAssortedFunctionspp_data['MODULEBASEDIR'].$this->all_vars['module']["db"]['Dir']."/".$pre_file;
                    //print $lfile;
                    if (file_exists($lfile)) {
                        include($lfile);
                    }else{
                        $this->cls->clsLog->general("AA error->",1);
                        //echo"AA error";
                    }
                    */
                }

                //print_r($_SESSION);
                    if($this->all_vars['content']["db"]['domainsID']==0){
                        // what group is the page in => management
                    
                        if($_SESSION['membersID']>0){
                            // member logged in
                            if($this->all_vars['content']["db"]['ExposureLT']>36){
                                // page either member or both
                                //echo"Member Page 1";
                            }else{
                                // if member logged in to management on public page=>redirect
                                header("Location: /login-management/");
                            }
                        }
                    }else{
                        if(isset($_SESSION['membersID'])){
                            if($_SESSION['membersID']==0){
                                // what group is the page in => public
                                //echo"Public Page 1";
                            }else{
                                if($this->all_vars['content']["db"]['ExposureLT']==36){
                                    // if member logged in on public page=>redirect
                                    header("Location: /members-home/");
                                    
                                }else{
    
                                }
                            }
                        }
                        
                    }

                
                /*
                if(!isset($_SESSION['membersID'])&&($this->all_vars['content']["db"]['ExposureLT']==37)){
                    //echo"Member Page";
                    $this->cls->clsLog->general("Member Page->",1);
                    //header("Location: /");
                }
                */
            }
            if(isset($this->all_vars['content']["content_pagesID"])){
                $this->all_vars['content']["content_pagesid"]=$this->all_vars['content']["content_pagesID"];
            }
            
            $this->cls->clsLog->general("-End Content init->",1);
            if(isset($_GET['ajax'])){
                $this->all_vars['domain']["db"]['templatesID']=35;
                $this->all_vars['content']["db"]['templatesID']=35;
            }
            //echo"\n\n--22222GGG-------------------------".$sql."--------------------------------------------------\n";
            //print_r($this->all_vars['content']);
            
            //$this->vrs->do=$this->all_vars;
            
        }


        public function Display(){
            
            $this->cls->clsLog->general("-ab Text Display->",3);
            $return_html="";
            //$target=new $this->all_vars['module']["db"]['class']();
            //print_r($this->all_vars['module']);
            if(isset($this->all_vars['module']["db"]['Method'])){
                $method=$this->all_vars['module']["db"]['Method'];
            }else{
                $method="";
            }
            
            if($method!=""){
                //$return_html=$this->cls->$this->target_class->$method();
                $target_class=$this->target_class;
                $return_html=clsClassFactory::$cls->$target_class->$method();
                //$return_html=$this->target->$method();
            }
            //$this->vrs->do=$this->all_vars;
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