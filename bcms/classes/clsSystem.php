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

               
        public $var=array();
        public $cls=array();
        function __construct(){
            $this->registerAutoloader();
            $this->factory=new clsClassFactory();

            $this->var=&clsClassFactory::$vrs;
            $this->cls=&clsClassFactory::$cls;
            
                        
            $this->Set_Session();
            
            $this->Set_Exception_Handler();
            $this->Set_System_bindings();
            $this->Set_Headers();
            //$this->Find_Current_Directory();
            
            //$this->Set_Base_Constants();
            //$this->Set_Asset_Servers();
            $this->Set_Memebers();
            $this->Run_Init_Functions();
            $this->Output_HTML();
            
		}
        
        private function Run_Init_Functions() {
            //clsClassFactory::$cls->clsLanguage->Language_Definitions();
            $this->cls->clsDomain->Domain_Init();
            $this->cls->clsContent->Content_Init();
            $this->content_output_html=$this->cls->clsContent->Display();
            clsClassFactory::$cls->clsLanguage->Language_Init();
            $this->cls->clsTemplate->Template_Init();
            clsClassFactory::$cls->clsModules->Find_Module_View();
            $this->template_code=$this->cls->clsTemplate->Run_Template();
        }
        
        private function Set_Session() {
            
            $clsSession = new clsSessionHandler();
            //
            
            session_set_save_handler($clsSession, true);
            session_start();

            $this->cls->clsSessionHandler->set_object($clsSession);

            $this->cls->clsSession->set_new_guid($this->cls->clsAssortedFunctions->make_guid());
            $this->cls->clsSession->session_start();
            $this->cls->clsSession->session_save_path();
            $this->cls->clsSession->set_ip_address($_SERVER['REMOTE_ADDR']);
            $this->cls->clsSession->session_set_globals();
            
        }
        
        private function myAutoloader($className) {
            //print $className;
            if(strlen($className)>0){
                // Define your autoloading logic here
                // For example, if your classes follow PSR-4 naming conventions:
                $file = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
                if (file_exists($file)) {
                    include_once $file;
                }
            }
            
        }
        
        private function registerAutoloader() {
            // Register the autoloader method
            spl_autoload_register([$this, 'myAutoloader']);
        }
        
        private function Set_Headers(){
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                $http_origin = $_SERVER['HTTP_ORIGIN'];
                header("Access-Control-Allow-Origin: $http_origin");
            }
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        }
        
        
        
        private function Set_System_bindings(){
            //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            //$this->Set_Error_Handler();
        }

        private function Set_Exception_Handler(){
            //set_exception_handler([$this->cls->clsExceptionHandler, 'handle']);
            //print clsClassFactory::$cls->export();
            if(isset($this->cls->clsExceptionHandler)){
                set_exception_handler([$this->cls->clsExceptionHandler, 'handle']);
            }
            
		}
        
        
        

        private function myErrorHandler($errno, $errstr, $errfile, $errline)
        {
            $this->e->myErrorHandler($errno, $errstr, $errfile, $errline);
        }
        
        
       

        
        

        private function Set_Memebers(){
            
            if(isset($_SESSION['membersID'])){
                $this->membersID=$_SESSION['membersID'];
            }else{
                
                $this->membersID=0;
            }
        }
        
       //private function Set_Language_Definitions(){
            //$this->Start_App_Vars();
            //clsClassFactory::$cls->clsLanguage->Language_Definitions();

            //$this->Update_App_Vars();
       // }
        

        
        
        private function Output_HTML(){
            //echo"--73ggg---------------------------------------------------------------------------\n";
            //$this->Start_App_Vars();
            $time_data=$this->cls->clsStatistics->retrieve_time_samples();
            //print_r($this->var['content']);
            $this->cls->clsLog->general("Time Statistics",8,$time_data);
            
            $output_code=base64_decode($this->var['template']['db']['filedata']);
            //$output_code=$this->template_code;
            //echo"--73gggaaa-------------------------|-".$output_code."-|------------------------------------------------\n";
            $keywords=$this->var['content']["db"];
            $main_menu=$this->cls->clsMenu->Horizontal_Rounded();
            $main_content=$this->content_output_html;
            $side_bar=$this->cls->clsMenu->Vertical_Sub_Page();
            $tag_match_array=array("asset-sever"=>$this->var['app']['current_asset_server'],"html-title"=>$keywords['title'],"dc-title"=>$keywords['meta_title'],
            "meta_description"=>$keywords['meta_description'],"meta_keywords"=>$keywords['meta_keywords'],"main-menu"=>$main_menu,"meta-title"=>$keywords['meta_title'],
            "main-title"=>$keywords['title'],"main-content"=>$main_content,"side-bar"=>$side_bar);

            
            $output_arrays=$this->cls->clsAssortedFunctions->modify_tags($output_code,$tag_match_array);
            //print_r($output_arrays);
            $output_code=$this->cls->clsAssortedFunctions->swap_tags($output_code,$output_arrays[0],$output_arrays[1],$output_arrays[2]);
            //$this->a->modify_tags($this->template_code,$tag_match_array);
            //$this->Update_App_Vars();
            print $output_code;
            //print_r(base64_decode($this->var['template']["db"]['filedata']));
        }
        
        
        
        
    }
