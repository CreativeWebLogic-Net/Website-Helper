<?php

    class clsAssortedFunctions{
        private $tag_match_array;
        private $current_domain;
        private $callback_num;
        private $html_piece;
        private $total_html;
        private $combined_total_html;
        private $current_dir="";

        private $Current_Dir="";

        public $all_vars=array();
        public $var=array();
        public $cls=array();
        function __construct(){
            
            

            
		}

        

        


        public function Set_Asset_Servers(){
            //$this->Start_App_Vars();
            $this->all_vars['app']['asset_servers']=array();
            
            $this->all_vars['app']['asset_servers'][0]='https://assets.bubblecms.biz/'; // linode server
            $this->all_vars['app']['asset_servers'][1]='https://spaces.auseo.net/'; // digital ocean custom server
            $this->all_vars['app']['asset_servers'][2]='https://static-cms.nyc3.cdn.digitaloceanspaces.com/'; // digital ocean cdn server
            $this->all_vars['app']['asset_servers'][3]='https://static-cms.nyc3.digitaloceanspaces.com/'; //digital ocean standard server
            $this->all_vars['app']['asset_servers'][4]='https://assets.ownpage.club/'; //asura standard server
            $this->all_vars['app']['asset_servers'][5]='https://assets.hostingdiscount.club/'; //asura reseller server
            $this->all_vars['app']['asset_servers'][6]='https://assets.icwl.me/'; //hostgator reseller server
            $this->all_vars['app']['asset_servers'][7]='https://static-assets.w-d.biz/'; //cloud unlimited server
            $this->all_vars['app']['asset_servers'][8]='https://assets.i-n.club/'; //ionos unlimited server
            $this->all_vars['app']['asset_servers'][9]='https://assets.creativeweblogic.net/'; //ionos unlimited server
            $this->all_vars['app']['asset_servers'][10]='https://static-assets.site/'; //ionos unlimited server
            $this->all_vars['app']['asset_servers'][11]='https://f005.backblazeb2.com/file/iCWLNet-Website-Assets/';

            
            $this->all_vars['app']['current_asset_server']=$this->all_vars['app']['asset_servers'][11];

            
            //$this->all_vars=array();
            //$this->all_vars['app']['current_asset_server']='https://f005.backblazeb2.com/file/iCWLNet-Website-Assets/';
            //$this->all_vars->do=array('app'=>array('current_asset_server'=>'https://f005.backblazeb2.com/file/iCWLNet-Website-Assets/'));
            
            //clsClassFactory::$vrs->{'app'}['current_asset_server']='https://f005.backblazeb2.com/file/iCWLNet-Website-Assets/';
            //$this->all_vars['app']["include_callback"]="callback";

            //$this->Update_App_Vars();
            //----------------------------------------------------------------
            ////$this->vrs->do=$this->all_vars;
            //$this->var=$this->all_vars;
        }

        public function Set_Base_Constants(){
            //$this->Start_App_Vars();
            $root_array=explode('/',$_SERVER['PHP_SELF']);
            //clsClassFactory::$vrs = new stdClass();
            //$this->all_vars['app']="xx";
            //print_r(clsClassFactory::$vrs);

            //$this->all_vars=array();
            
            $this->all_vars['app']['APPBASEDIR']='bcms/';
            $this->all_vars['app']['ROOTDIR']='/';
            //echo"000101-----------------------------------------------------------------------------\n";
            $this->all_vars['app']['APPLICATIONSDIR']=$this->all_vars['app']['APPBASEDIR'].'apps';
            $this->all_vars['app']['MODULEBASEDIR']=$this->all_vars['app']['APPBASEDIR'].'modules/';
            $this->all_vars['app']['CLASSESBASEDIR']=$this->all_vars['app']['APPBASEDIR'].'classes/';
            $this->all_vars['app']['INCLUDESBASEDIR']=$this->all_vars['app']['APPBASEDIR'].'includes/';


            
            //$this->all_vars[]=$this->all_vars;
            //$this->all_vars->do=$this->all_vars;
            //clsClassFactory::$vrs->Message="";
            //print_r(clsClassFactory::$vrs);

            //$this->Update_App_Vars();
            //$this->vrs->do=$this->all_vars;
            //$this->var=$this->all_vars;
        }

        public function make_guid ($length=32) 
		{ 
			$key="";    
            $minlength=$length;
            $maxlength=$length;
            $charset = "abcdefghijklmnopqrstuvwxyz"; 
            $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
            $charset .= "0123456789"; 
            if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
            else                         $length = mt_rand ($minlength, $maxlength); 
            for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
            //print $key;
            return $key;
		}

        public function Get_Current_Time(){
            date_default_timezone_set('Australia/Sydney');
            $today = date("Y-m-d H:i:s"); 
            return $today;   
        }

        

        function Get_HTML_Tags(){
            $tag_array=array("a","abbr","acronym","address","applet","article","aside","audio","b","basefont","bdi","bdo","big","blockquote","body","button",
            "canvas","caption","center","cite","code","colgroup","data","datalist","dd","del","details","dfn","dialog","dir","div","dl","dt","em","fieldset",
            "figcaption","figre","font","footer","form","frame","frameset","h1","head","header","html","i","iframe","ins","kbd","label","legend","li","main","map","mark","meter",
            "nav","noframes","noscript","object","ol","optgroup","option","output","p","param","picture","pre","progress","q","rp","rt","ruby","s","samp",
            "script","section","select","small","span","strike","strong","style","sub","summary","sup","svg","table","tbody","td","template","textarea",
            "tfoot","th","thead","time","title","tr","tt","u","ul","var","video");
            $tag_void_array=array("area","base","br","col","embed","hr","img","input","link","meta","source","track","wbr","!DOCTYPE");
            return array($tag_array,$tag_void_array);
        }
        
        
        
        public function Find_Current_Directory()
        {
            if($this->Current_Dir==""){
                $this->Current_Dir=pathinfo(__DIR__);
            }
            $this->Current_Dir=$this->Current_Dir['dirname'];
            $this->all_vars['app']['Current_Dir']=$this->Current_Dir;
            //$this->vrs->do=$this->all_vars;
            //$this->var=$this->all_vars;

            
        }

        function tag_replace()
        {
            $tag_match_array=array("url"=>"localhost");
            return $tag_match_array;
            
        }
        
        
        function modify_tags($buffer,$tag_match_array)
        {
           
            $all_html_tags=$this->Get_HTML_Tags();
            $html_tags=$all_html_tags[0];
            $html_void_tags=$all_html_tags[1];
            //print_r($all_html_tags);
            //$buffer=var_export($all_html_tags,true).$buffer;
            $sub_string_total="xx";
            $match_array=array();
            $inner_array=array();
            $search=0;
            $buffer_size=strlen($buffer);
            $query="";
            $str_match="";
            $cur_match=array(); 
            $inner_match=array();
            $start_count=array();
            $end_count=array();
            //$open_char=array("{","<");
            //$close_char=array("}",">");
            $open_char=array("{");
                $close_char=array("}");
            $custom_char=array($open_char[0],$close_char[0]);
            //$html_char=array($open_char[1],$close_char[1]);
            //$tag_array=array("custom"=>$custom_char,"html"=>$html_char);
            $tag_array=array("custom"=>$custom_char);
            //$tag_array_count=array("custom"=>2,"html"=>1);
            $tag_array_count=array("custom"=>2);
            $current_tag=0;
            
            while($search<=$buffer_size){
                $sub_string = substr($buffer, $search, 1);
                foreach($tag_array as $tag_type=>$tag_val){
                    //$start_count=0;
                    //$cur_match="";
                    //$buffer="\n tv-".$start_count."-".$end_count."-".$cur_match."-".var_export($tag_val,true).$buffer."\n";
                    if($sub_string==$tag_val[0]){
                        if(!isset($start_count[$tag_type])) $start_count[$tag_type]=0;
                        if(!isset($cur_match[$tag_type])) $cur_match[$tag_type]="";
                        $start_count[$tag_type]++;
                        $cur_match[$tag_type].=$sub_string;
                        //$buffer=$buffer."\n -22".$sub_string."-".$tag_val[0]."-33- \n";
                    }elseif($sub_string==$tag_val[1]){
                        if(!isset($end_count[$tag_type])) $end_count[$tag_type]=0;
                        if(!isset($cur_match[$tag_type])) $cur_match[$tag_type]="";
                        $end_count[$tag_type]++;
                        $cur_match[$tag_type].=$sub_string;
                        //$buffer=$buffer."\n -223".$sub_string."-".$tag_val[1]."-334- \n";
                    }else{
                        if(!isset($start_count[$tag_type])){
                            $start_count[$tag_type]=0;
                        }
                        if(!isset($end_count[$tag_type])){
                            $end_count[$tag_type]=0;
                        }
                        if(!isset($inner_match[$tag_type])){
                            $inner_match[$tag_type]="";
                        }
                        if($start_count[$tag_type]>0){
                            $cur_match[$tag_type].=$sub_string;
                            $inner_match[$tag_type].=$sub_string;
                            //$buffer=$buffer."\n -224".$sub_string."-".$cur_match[$tag_type]."-35- \n";
                        }
                    }
                    //if(($start_count[$tag_type]>$tag_array_count[$tag_type])&&($end_count[$tag_type]>$tag_array_count[$tag_type])){
                    $match_count=$tag_array_count[$tag_type]-1;
                    //if(($start_count[$tag_type]>0)&&($end_count[$tag_type]>0)){
                    if((isset($start_count[$tag_type]))&&(isset($end_count[$tag_type]))){
                        if(($start_count[$tag_type]>$match_count)&&($end_count[$tag_type]>$match_count)){
                            $current_tag++;
                            $match_array[$current_tag]['html']=$cur_match[$tag_type];
                            $inner_array[$current_tag]['html']=$inner_match[$tag_type];
                            $cur_match[$tag_type]="";
                            $inner_match[$tag_type]="";
                            $start_count[$tag_type]=0;
                            $end_count[$tag_type]=0;
                            $tag_string=$match_array[$current_tag]['html'];
                            $tag_string=substr($tag_string,1,-1);
                            if(substr($tag_string,-1)=='/'){
                                $tag_string=substr($tag_string,0,-1);
                            }
                            $tag_attributes=explode(' ',$tag_string);
                            $tag_attr_list = array_slice($tag_attributes, 1);
                            foreach($tag_attr_list as $attr_key=>$attri_val){
                                $pos = strpos($attri_val, '=');
                                /*
                                if (str_contains($attri_val, '=')) {
                                    $match_array[$current_tag]['attributes'][]=$attri_val;
                                }
                                */
                                if ($pos>-1) {
                                    $match_array[$current_tag]['attributes'][]=$attri_val;
                                }
                            }
                            //$match_array[$current_tag]['attributes']=$tag_attr_list;
                            $tag_name=$tag_attributes[0];
                            $match_array[$current_tag]['tag_name']=$tag_name;
                            if(in_array($tag_name,$html_tags)){
                                $match_array[$current_tag]['tag_type']="html";
                            }elseif(in_array($tag_name,$html_void_tags)){
                                $match_array[$current_tag]['tag_type']="void";
                            }
                        }
                    }
                    
                }
                //$buffer=$buffer."\n -1".var_export($match_array,true)."-2- \n";
                $search++;
                
            }

            
            return array($match_array,$tag_match_array,$inner_array);//$buffer;
        }

        function swap_tags($template_code,$match_array,$tag_match_array,$inner_array)
        {
            $buffer=$template_code;
            
            for($x=0;$x<=count($match_array);$x++){
                if(isset($inner_array[$x]['html'])){
                    //print($inner_array[$x]['html']);
                    if(isset($tag_match_array[$inner_array[$x]['html']])){
                            //$buffer=str_replace($match_array[$x], $tag_match_array[$inner_array[$x]['html']], $buffer);
                            $buffer=str_replace($match_array[$x], $tag_match_array[$inner_array[$x]['html']], $buffer);
                        
                        //$query.="| ".$x." |\n ".$inner_array[$x]."\n--".$match_array[$x]."=>".$tag_match_array[$inner_array[$x]['html']];//var_export($tag_match_array[$inner_array[$x]],true);
                        
                    }else{
                        //$buffer=str_replace($match_array[$x], "", $buffer);
                    }
                }
                
            }
            //print_r($buffer);
            return $buffer;
        }


        

        function add_tag_array($tag_match_array)
        {
            $this->tag_match_array=$tag_match_array;
        }

        function add_current_domain()
        {
            $this->current_domain=str_replace("www.", "",$_SERVER['HTTP_HOST']);
            
        }

        function GetModulesPermissions(){
            //echo"yyy";
            //$r=new ReturnRecord();
            global $r;
            $RetArr=array();
            $sql="SELECT modulesID FROM domains_modules WHERE domainsID=$_SESSION[domainsID]";
            //print $sql;
            $rslt=$r->RawQuery($sql);
            while($myrow=$r->Fetch_Array()){
                $RetArr[]=$myrow[0];
            }	
            return $RetArr;
        }

        function convert_high_ascii($s) {
            $HighASCII = array(
                "!\xc0!" => 'A',    # A`
                "!\xe0!" => 'a',    # a`
                "!\xc1!" => 'A',    # A'
                "!\xe1!" => 'a',    # a'
                "!\xc2!" => 'A',    # A^
                "!\xe2!" => 'a',    # a^
                "!\xc4!" => 'Ae',   # A:
                "!\xe4!" => 'ae',   # a:
                "!\xc3!" => 'A',    # A~
                "!\xe3!" => 'a',    # a~
                "!\xc8!" => 'E',    # E`
                "!\xe8!" => 'e',    # e`
                "!\xc9!" => 'E',    # E'
                "!\xe9!" => 'e',    # e'
                "!\xca!" => 'E',    # E^
                "!\xea!" => 'e',    # e^
                "!\xcb!" => 'Ee',   # E:
                "!\xeb!" => 'ee',   # e:
                "!\xcc!" => 'I',    # I`
                "!\xec!" => 'i',    # i`
                "!\xcd!" => 'I',    # I'
                "!\xed!" => 'i',    # i'
                "!\xce!" => 'I',    # I^
                "!\xee!" => 'i',    # i^
                "!\xcf!" => 'Ie',   # I:
                "!\xef!" => 'ie',   # i:
                "!\xd2!" => 'O',    # O`
                "!\xf2!" => 'o',    # o`
                "!\xd3!" => 'O',    # O'
                "!\xf3!" => 'o',    # o'
                "!\xd4!" => 'O',    # O^
                "!\xf4!" => 'o',    # o^
                "!\xd6!" => 'Oe',   # O:
                "!\xf6!" => 'oe',   # o:
                "!\xd5!" => 'O',    # O~
                "!\xf5!" => 'o',    # o~
                "!\xd8!" => 'Oe',   # O/
                "!\xf8!" => 'oe',   # o/
                "!\xd9!" => 'U',    # U`
                "!\xf9!" => 'u',    # u`
                "!\xda!" => 'U',    # U'
                "!\xfa!" => 'u',    # u'
                "!\xdb!" => 'U',    # U^
                "!\xfb!" => 'u',    # u^
                "!\xdc!" => 'Ue',   # U:
                "!\xfc!" => 'ue',   # u:
                "!\xc7!" => 'C',    # ,C
                "!\xe7!" => 'c',    # ,c
                "!\xd1!" => 'N',    # N~
                "!\xf1!" => 'n',    # n~
                "!\xdf!" => 'ss'
            );
            $find = array_keys($HighASCII);
            $replace = array_values($HighASCII);
            $s = preg_replace($find,$replace,$s);
            return $s;
       }

       function dirify($text)
        {
            $text=strtolower($text);
            $code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','*','+','~','`','=');
            $code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','');
            $text = str_replace($code_entities_match, $code_entities_replace, $text);
            return $text;
        }

        function exceptions_error_handler($severity, $message, $filename, $lineno) {
            throw new ErrorException($message, 0, $severity, $filename, $lineno);
        }
        
        //set_error_handler('exceptions_error_handler');
        
        public function strip_capitals($var_array=array()){
            $output_array=array();
            foreach($var_array as $key=>$val){
                $key=strtolower($key);
                $output_array[$key]=$val;
            }
            $output_array= array_merge($output_array, $var_array);
        
            return $output_array;
        }

        function check_base64($s){
            // Check if there are valid base64 characters
            if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;
        
            // Decode the string in strict mode and check the results
            $decoded = base64_decode($s, true);
            if(false === $decoded) return false;
        
            // Encode the string again
            if(base64_encode($decoded) != $s) return false;
        
            return true;
        }

        function is_base64($str){
        
            if($str === base64_encode(base64_decode($str))){
                print "is 64 ->".base64_encode($str)."-";
                print "2 is 64 ->".base64_encode(base64_encode($str))."-";
                return true;
            }
            return false;
        }

        

        
    }


