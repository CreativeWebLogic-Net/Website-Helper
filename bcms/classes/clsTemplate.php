<?php

    class clsTemplate{

        public $var=array();
        public $cls=array();
        function __construct(){
            $this->var=&clsClassFactory::$vrs;
            $this->cls=&clsClassFactory::$cls;
        }

        

        
        /*
        public function Run_Template_Import(){
            
            $template_code="";
            if(isset($this->var['template']["db"]['dir'])){
				$this->var['template']['My_Dir']=$this->var['app']['APPBASEDIR']."templates/".$this->var['template']["db"]['dir'];
				//$load_file=$this->var['template']['My_Dir']."/index.php";
                $load_file=$this->var['template']['My_Dir'];
				//$this->cls->clsLog->general("-End line-".$load_file,9);
				//print $load_file;
				$this->cls->clsLog->general("-ar Loading Template->",9,$this->var['template']["db"]);
				//echo"\n\n-10----".$load_file."----------------------------------------------------\n\n";
                
				if(file_exists($load_file)){
					//$this->var['app']["include_callback"]="callback_template";
					$filepath=$load_file;
		            $template_code=$this->Load_File($load_file);
                    echo"\n\n-1001----".$template_code."----------------------------------------------------\n\n";
				}else{
					throw new Exception('Template not loading.');
				}
                
			}else{
				exit("No Template File");
			}
            //$template_code = wordwrap($template_code, 50, "\n<br>");
            //echo"\n\n-1001----\n\n".base64_decode($template_code)."\n\n----------------------------------------------------\n\n";
            //echo"\n\n-1001----\n\n".$template_code."\n\n----------------------------------------------------\n\n";
            
            return $template_code;
        }
        */
        /*
        public function Run_Template(){
            echo"\n\n-1001--------------------------------------------------------\n\n";
            print_r($this->vrs);
            $template_size=strlen($this->var['template']["db"]['filedata']);
            //$this->cls->clsLog->general("-RT Loading Template->".$template_size,9,$this->var['template']["db"]);
            if($template_size>0){
                
				return base64_decode($this->var['template']["db"]['filedata']);
                //return $this->var['template']["db"]['filedata'];
				
				
			}else{
				exit("No Template File");
			}
            
        }
        */
        /*
        public function Load_File($file_wrapper){
            
            $template_code="";
            $normal=$file_wrapper."/index.php";
            $new=$file_wrapper."/index-new.php";
            $run_file="";
            if(file_exists($new)){
                $run_file=$new;
            }elseif(file_exists($normal)){
                $run_file=$normal;
            }
            
            //include($file_wrapper);
            $template_code = base64_encode(file_get_contents($run_file));

            $this->cls->clsLog->general("-FFF Loading Template->".$run_file,9,$template_code);
            
            return $template_code;
        }
        */
        public function Template_Init(){
            //
            //$this->templatesID=0;
            //$this->domains_templatesID=0;
            //set sql result non capitalized
            //echo"--73RRR---------------------------------------------------------------------------\n";
            //print_r($this->var['content']);
            //echo"--73RRRXXDomain---------------------------------------------------------------------------\n";
            //print_r($this->var['domain']);
            //echo"--73RRRXX---------------------------------------------------------------------------\n";
            if(isset($this->var['content']["db"])){
                
                if(isset($this->var['content']["db"]['templatesID'])){
                    if($this->var['content']["db"]['templatesID']==0){
                        //echo"--In Content------------------------ff-|-".$this->var['content']["db"]['templatesID']."-|------------------------------------------------\n";
                        if(isset($this->var['domain']["db"]['templatesID'])){
                            if($this->var['domain']["db"]['templatesID']>0){
                                $templatesID=$this->var['domain']["db"]['templatesID'];
                            }else{
                                $templatesID=0;
                            }				
                        }else{
                            $templatesID=0;
                        }
                    }else{
                        $templatesID=$this->var['content']["db"]['templatesID'];
                    }			
                }elseif(isset($this->var['domain']["db"]['templatesID'])){
                    if($this->var['domain']["db"]['templatesID']>0){
                        $templatesID=$this->var['domain']["db"]['templatesID'];
                    }else{
                        $templatesID=0;
                    }
                
                }else{
                    $templatesID=0;
                }
                //echo "\n\n 123QQQ---".$templatesID."----\n\n";
                //if content page has a custom template then overwrite the domain template
                if($templatesID>0){
                    $sql="SELECT * FROM templates WHERE id='".$templatesID."'";
                    //$sql="SELECT * FROM templates WHERE id='27'";
                    //$sql="SELECT * FROM templates";
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $num_rows=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    //echo "\n\n 123---".$sql."----\n\n";
                    if($num_rows>0){
                        $this->var['template']["db"]=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt);
                        //print_r($this->var['template']);
                        //print_r($sql);
                        $this->cls->clsLog->general("DDD HTML Template",9,strlen($this->var['template']["db"]['filedata']));
                        $this->var['template']["db"] = $this->cls->clsAssortedFunctions->strip_capitals($this->var['template']["db"]);
                        if(count($this->var['template']["db"])==0){
                            //exit("No Template->".$sql);
                            //$error_message="No template found=>".$sql;
                            //echo $error_message;
                            //print_r($this->var['template']["db"]);
                            
                            $this->cls->clsLog->general("No template found=>",4,$this->var['template']["db"]);
                        }
                        if(strlen($this->var['template']["db"]['filedata'])==0){
                            $this->cls->clsLog->general("No HTML Template",9,strlen($this->var['template']["db"]['filedata']));
                        }
                        //echo "\n\n 123-------\n\n";
                        //print_r($template_data);
                        $this->var['template']['TEMPLATEPATH']=$this->var['app']['APPBASEDIR']."templates/".$this->var['template']["db"]['dir'];
                        $this->var['template']['TEMPLATEDIR']=$this->var['template']['TEMPLATEPATH'];
                    }else{
                        //exit("No Template->".$sql);
                    }
                }
                
                
                
                //echo "xxx";
            }
        }
        
    }

