<?php

    class clsSystem{
                
        private $sess;
        

        private $e;
        
       // public static $vars;

        private $bc;

        private $membersID;
        private $template_code="";

        private $content_output_html="";
        public $factory;

        public $project_type="full_install";

        public $output_code="";

        public $all_vars=array();
        public $var=array();
        public $cls=array();
        function __construct(){
            
            //$this->all_vars=&clsClassFactory::$vrs;
            $this->cls=&clsClassFactory::$cls;
            
            $this->Run_Init_Functions();
            
            $this->Output_HTML();
            
		}
        

        private function Run_Init_Functions() {
            $this->project_type=clsClassFactory::$project_type;
            //$this->Run_Init_Functions_Full_Server();
            
            switch($this->project_type){
                case "full_install":
                    $this->Run_Init_Functions_Full_Server();
                break;
                case "remote_install":
                    $this->Run_Init_Functions_Remote_Server();
                break;
                case "new_install":
                    $this->Run_Init_Functions_Install_Server();
                break;
                
            }
            
            
            
            
        }

        private function Run_Init_Functions_Remote_Server() {
            /*
            if (isset($this->cls->clsDCMS)) {
                $this->output_code=$this->cls->clsDCMS->export_data();
            }else{
                echo "666";
                $this->output_code=$this->cls->export_data();
            }
            */
            if(!isset(clsClassFactory::$cls->clsDCMS)){
                clsClassFactory::Add_Class("clsDCMS");
            }
            //$this->output_code=$this->cls->export_data();
            $this->output_code=$this->cls->clsDCMS->Return_Output($_SERVER['REQUEST_URI']);
            
        }
        private function Run_Init_Functions_Full_Server() {

            

            $this->cls->clsAssortedFunctions->Find_Current_Directory();
            $this->cls->clsAssortedFunctions->Set_Asset_Servers();
            $this->cls->clsAssortedFunctions->Set_Base_Constants();
            $this->Set_Session();

            $this->Set_Memebers();
            
            $this->cls->clsDomain->Domain_Init();
            //$this->cls->export_data();
            
            $this->cls->clsContent->Content_Init();
            
            
            
            
            $this->content_output_html=$this->cls->clsContent->Display();
            
            $this->cls->clsLanguage->Language_Init();
            
            $this->cls->clsTemplate->Template_Init();
            
            $this->cls->clsModules->Find_Module_View();
            
            $this->template_code=$this->cls->clsTemplate->Run_Template();
            $this->cls->clsSession->session_set_globals();
            print $this->All_Outputs();
            //exit("ii");
            //$this->output_code=
        }

        private function Set_Session() {
            /*
            $handler = new clsSessionHandler();
            session_set_save_handler($handler, true);
            //session_save_path("bcms/sessions/"); // Set the path where session files will be stored
            session_start();
            */
            //$guid=$this->cls->clsAssortedFunctions->make_guid();
            //print($guid);
            //$this->cls->clsSession->set_new_guid($guid);
            
            $this->cls->clsSession->session_start();

            //$_SESSION['username'] = 'john_doe';
            //print_r($_SESSION);
        }

        
        private function Run_Init_Functions_Install_Server() {
            
           
            
        }
        
        
        private function Set_Memebers(){
            
            if(isset($_SESSION['membersID'])){
                $this->membersID=$_SESSION['membersID'];
            }else{
                
                $this->membersID=0;
            }
        }

        private function All_Outputs(){
            //"full_install","remote_install"
            
            switch($this->project_type){
                case "full_install";
                    $html=$this->Output_HTML();
                break;
                case "remote_install";
                    $html=$this->Remote_Output_HTML();
                break;
                case "install_system";
                    $html=$this->Remote_Output_HTML();
                break;
            }
            
            
            return $html;
        }

        private function Remote_Output_HTML(){
            return $this->output_code;
        }
        
        private function Output_HTML(){
            //echo"--888---------------------------------------------------------------------------\n";
            
            //$this->Start_App_Vars();
            //$time_data=$this->cls->clsStatistics->retrieve_time_samples();
            
            //$this->cls->clsLog->general("Time Statistics",8,$time_data);

            //print("GGGXX11");
            //print_r(clsClassFactory::$all_vars);
            $this->all_vars=clsClassFactory::$all_vars;
            //exit("fserve");

            $output_code="";
            $keywords=array();
            if(isset($this->all_vars)){
                //print_r($this->all_vars);
                if(is_array($this->all_vars)){
                    $output_code=base64_decode($this->all_vars['template']['db']['filedata']);
                    $keywords=$this->all_vars['content']["db"];
                }else{
                    $output_code="";
                    $keywords=array();
                }
                

            }else{
                $output_code="";
            }
            
            //$output_code=$this->template_code;
            //echo"--73gggaaa-------------------------|-".$output_code."-|------------------------------------------------\n";
            //if(isset($this->all_vars['content']["db"]))
            
            if(!count($keywords)>0){
                $keywords['title']="";
                $keywords['meta_title']="";
                $keywords['meta_description']="";
                $keywords['meta_keywords']="";
                $keywords['meta_title']="";
                $keywords['title']="";
            }
            if(is_array($this->all_vars)){
                if(!isset($this->all_vars['app']['current_asset_server'])){
                    $this->all_vars['app']['current_asset_server']="";
                }
            }
            //exit("fff");
            if(is_array($this->all_vars)){
                $main_menu=$this->cls->clsMenu->Horizontal_Rounded();
                //echo"--73gggaaa-------------------------|-".$output_code."-|------------------------------------------------\n";
                //print_r($main_menu);
                
                $main_content=$this->content_output_html;
                $side_bar=$this->cls->clsMenu->Vertical_Sub_Page();
                $tag_match_array=array("asset-sever"=>$this->all_vars['app']['current_asset_server'],"html-title"=>$keywords['title'],"dc-title"=>$keywords['meta_title'],
                "meta_description"=>$keywords['meta_description'],"meta_keywords"=>$keywords['meta_keywords'],"main-menu"=>$main_menu,"meta-title"=>$keywords['meta_title'],
                "main-title"=>$keywords['title'],"main-content"=>$main_content,"side-bar"=>$side_bar);

                
                $output_arrays=$this->cls->clsAssortedFunctions->modify_tags($output_code,$tag_match_array);
                if(!isset($output_arrays)){
                    $output_arrays=array();
                }else{
                    $output_code=$this->cls->clsAssortedFunctions->swap_tags($output_code,$output_arrays[0],$output_arrays[1],$output_arrays[2]);
                }
            }else{
                $output_code="";
            }
            //print_r($output_arrays);
            
            //$this->a->modify_tags($this->template_code,$tag_match_array);
            //$this->Update_App_Vars();
            //print $output_code;
            $this->output_code=$output_code;
            return $output_code;
            //print_r(base64_decode($this->all_vars['template']["db"]['filedata']));
        }
        
        
        
        
    }
