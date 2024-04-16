<?php
    class clsServerDetails{
        private $Base_Directory="";

        public $log;

        private $r;

        private $sess;

        private $server_types=array();

        private $current_server_type="";

        function __construct(){
            $linux=new clsLinuxServer();
            $windows=new clsWindowsServer();
            $this->server_types['linux']=$linux;
            $this->server_types['windows']=$windows;
            $this->current_server_type='linux';
            //$this->current_server_type=$this->getServerOSType();
        }

        public function Set_Log($log){
            $this->log=clsClassFactory::$all_vars['log'];
            //print_r($this->log);
            //$this->log->general('Boot Success: ',9,array());
                    
        }

        public function set_database($r=null)
        {
            $this->r=&clsClassFactory::$all_vars['r'];
            
        }

        private function getServerOSType() {
            return php_uname('s');
        }

        public function Run_Diagnostics(){
            $os_details=$this->server_types[$this->current_server_type]->run_tests();
            return var_export($os_details,true);
        }

        public function getOSDetails(){
            $os_details=$this->getServerOSType();
            return var_export($os_details,true);
        }
    }
