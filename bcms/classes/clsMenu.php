<?php

    class clsMenu{
        

        private $data=array();
        public $all_vars=array();
        //public $var=array();
        public $cls=array();
        function __construct(){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
               
            
		}

                              

        public function Pre_Menu(){
			
		}

        public function Menu_Base(){
            //echo"\n ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            
            
            if(isset($this->all_vars['domain_user'])){
                if(count($this->all_vars['domain_user'])==0){
                    if(isset($this->all_vars['domain']["original_db"])){
                        $domain_name=$this->all_vars['domain']["original_db"]['Name'];
                        $SEOFriendly=$this->all_vars['domain']["original_db"]['SEOFriendlyLT'];
                    }else{
                        $domain_name=$this->all_vars['domain']["db"]['Name'];
                        $SEOFriendly=$this->all_vars['domain']["db"]['SEOFriendlyLT'];
                    }
                    
                    if(!isset($_SESSION['administratorsID'])) $_SESSION['administratorsID']=0;
                    if(!isset($_SESSION['membersID'])) $_SESSION['membersID']=0;
                    //print_r($_SESSION);
                    if($_SESSION['membersID']>0){
                        $member_type=37;
                        $exposure="(ExposureLT='".$member_type."' OR ExposureLT=38)";
                    }else{
                        $member_type=36;
                        $exposure="(ExposureLT='".$member_type."' OR ExposureLT=38)";
                    }
            
                    $menu_hide_sql=" Menu_HideLT=13 AND ";
                    $side_menu_sql=" AND content_pages.parentID=0";
                    if($this->all_vars['content']['db']['domainsID']==0){
                        $admin_menu_sql=" AND domainsID=0";
                        
                    }else{
                        $admin_menu_sql=" AND domainsID=".$this->all_vars['domain']["db"]['id'];
                    }
                    
                    
                    $sql="SELECT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE ".$menu_hide_sql." ";
                        $sql.=$exposure." AND languagesID=".$this->all_vars['app']['LANGUAGESID']." ".$admin_menu_sql." ".$side_menu_sql." ORDER BY Sort_Order";
                    //print $sql;	
                    $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $first=true;
                    $this->all_vars['menu']['spacers']="|";
                    if($this->cls->clsDatabaseInterface->NumRows($rslt)>0){
                        
                    
                        while($data=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt)){
                            // show spacers in menu
                            if($this->all_vars['menu']['spacers']){
                                if($first){
                                    $first=false;
                                    $data['first']=true;
                                }else{
                                    $data['first']=false;
                                }
                            }else{
                                // no show spacers in menu
                                $data['first']=true;
                            }
                            if($domain_name=='install.me'){
                                $base_address='/';
                            }else{
                                $base_address='http://'.$domain_name;
                            }
                            
                            if($SEOFriendly=="No"){
                                $data['link_address']=$base_address.$this->all_vars['app']['ROOTDIR'].'index.php?guid=1&cpid='.$data["content_pagesid"];
                            }else{
                                if(!isset($data["uri"])) $data["uri"]="";
                                $data['link_address']=$base_address.$data["uri"];
                            }
                            $this->all_vars['menu']["db"][]=$data;
                        }
                    }
                }else{
                    
                    $data=array();
                    $data['first']=true;
                    $data['link_address']='http://'.$this->all_vars['domain']["db"]['Name'];
                    $data["menutitle"]="Directory Home";
                    $this->all_vars['menu']["db"][]=$data;
                    
                }
            }
            
            return $this->all_vars['menu'];
        }

        public function Vertical_Menu_Base(){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            $this->all_vars=$this->all_vars;
            if(isset($this->all_vars['domain_user'])){
                if(count($this->all_vars['domain_user'])==0){
                    if(isset($this->all_vars['domain']["original_db"])){
                        $domain_name=$this->all_vars['domain']["original_db"]['Name'];
                        if(isset($this->all_vars['domain']["original_db"]['SEOFriendly'])){
                            $SEOFriendly=$this->all_vars['domain']["original_db"]['SEOFriendlyLT'];
                        }else{
                            $SEOFriendly="";
                        }
                    }else{
                        $domain_name=$this->all_vars['domain']["db"]['Name'];
                        if(isset($this->all_vars['domain']["db"]['SEOFriendly'])){
                            $SEOFriendly=$this->all_vars['domain']["db"]['SEOFriendlyLT'];
                        }else{
                            $SEOFriendly="";
                        }
                    }
                    $side_menu_sql="";
                    $menu_hide_sql=" Menu_HideLT=13 AND ";
                    $group_by="GROUP BY URI";
                    if(!isset($_SESSION['membersID'])) $_SESSION['membersID']=0;
                    
                    if($_SESSION['membersID']>0){
                        $member_type=37;
                        $exposure="(ExposureLT='".$member_type."' OR ExposureLT=38)";
                    }else{
                        $member_type=36;
                        $exposure="(ExposureLT='".$member_type."' OR ExposureLT=38)";
                    }
                    if($this->all_vars['content']['db']['domainsID']==0){
                        $admin_menu_sql="AND domainsID=0";
                    }else{
                        $admin_menu_sql="AND domainsID=".$this->all_vars['domain']["db"]['id']." ";
                    }
                    
                    $sql="SELECT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE Menu_HideLT=13 AND ".$exposure." ".$side_menu_sql." ".$admin_menu_sql." ORDER BY Sort_Order;";
                    
                    //$rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                    $first=true;
                    //$row_count=$this->cls->clsDatabaseInterface->NumRows($rslt);
                    
                    $this->all_vars['menu']['spacers']='<br>';
                    //print "\n ZZZ=>".$sql." | ".$this->all_vars['content']['db']['id']." \n | XX3-> |  \n";
                    $sub_menu_source=$this->RecursiveMenuUp($this->all_vars['content']['db']['id'],$member_type);
                    $pages=$this->RecursiveMenuDown($sub_menu_source,$member_type);
                    //print "\n  ||XX->".$sub_menu_source." | ".var_export($pages,true)." \n";
                    foreach($pages as $key=>$val){
                        if(is_array($val)){
                            $data["menutitle"]=$val['menutitle']." ".$this->all_vars['menu']['spacers'];
                            $data['link_address']=$val['uri'];
                            $this->all_vars['menu']["vb"][]=$data;
                        }
                        
                    }
                    
                }else{
                    
                    $data=array();
                    $data['first']=true;
                    $data['link_address']='http://'.$this->all_vars['domain']["db"]['Name'];
                    $data["menutitle"]="Directory Home";
                    $this->all_vars['menu']["vb"][]=$data;
                    
                }
            }
        
            
            return $this->all_vars['menu'];
        }

        public function RecursiveMenuUp($current_pageID,$member_type=37){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            //$member_type="Public";
            $exposure="(ExposureLT='".$member_type."' OR ExposureLT='38')";
            //$sql="SELECT id AS content_pagesID,parentID FROM content_pages WHERE Menu_Hide='No' AND ".$exposure." AND id='".$current_pageID."' ORDER BY Sort_Order;";
            $sql="SELECT id AS content_pagesID,parentID FROM content_pages WHERE  ".$exposure." AND id='".$current_pageID."' ORDER BY Sort_Order;";
            //print $sql;
            //print "\n KKK00=>".$sql."-- \n";
            $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
            $row_count=$this->cls->clsDatabaseInterface->NumRows($rslt);
            $origin_pageID=0;
            //if($row_count>0){
                //print "\n KKK00000=>".$origin_pageID."--".$row_count." \n";
                while($data=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt)){
                    if($data['parentID']==0){
                        $origin_pageID=$data['content_pagesID'];
                        //print "\n KKK1=>".$origin_pageID."-- \n";
                    }else{
                        $origin_pageID=$this->RecursiveMenuUp($data['parentID'],$member_type);
                        //print_r($data);
                        //print "\n KKK2=>".$origin_pageID."-- \n";
                    }            
                }
            //}
            
                
            return $origin_pageID;
        }

        public function RecursiveMenuDown($current_pageID,$member_type=37){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            //print "\n 66778=>".$current_pageID." | ".$member_type."\n";
            //$member_type="Public";
            $exposure="(ExposureLT='".$member_type."' OR ExposureLT=38)";
            $sql="SELECT URI AS uri,MenuTitle AS menutitle,id AS content_pagesID,parentID FROM content_pages WHERE Menu_HideLT=13 AND ".$exposure." AND parentID='".$current_pageID."' ORDER BY Sort_Order;";
            
            $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
            $row_count=$this->cls->clsDatabaseInterface->NumRows($rslt);
            
            $pages=array();
            $sub_array=array();
            $data=$this->cls->clsDatabaseInterface->Fetch_Multi_Assoc($rslt);
            foreach($data as $key=>$val){
                $pages[] =$val;
                $sub_array=$this->RecursiveMenuDown($val['content_pagesID'],$member_type);
                foreach($sub_array as $key2=>$val2){
                    $pages[] = $val2;//array_merge($sub_array, $data);
                }
            }
            
            
            return $pages;
            
        }

        public function Vertical_Menu_Base_New(){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            $this->all_vars=$this->all_vars;
            /*
            $this->all_vars['menu']=array();
            
            
            //$this->all_vars['domain_user']=$this->all_vars['domain_user'];
            $this->all_vars['domain']=$this->vrs->domain_data;
            $this->all_vars['content']=$this->vrs->content_data;
            $this->all_vars['app']=$this->vrs->content_data;
            */
            //$this->all_vars['domain_user']=$this->data['domain_user_data'];
            //$this->all_vars['domain']=$this->vrs->domain_data;
            //$this->all_vars['content']=$this->data['content_data'];
            //$this->all_vars['app']=$this->vrs->content_data;

            if(count($this->all_vars['domain_user'])==0){
                if(isset($this->all_vars['domain']["original_db"])){
                    $domain_name=$this->all_vars['domain']["original_db"]['Name'];
                    $SEOFriendly=$this->all_vars['domain']["original_db"]['SEOFriendlyLT'];
                }else{
                    $domain_name=$this->all_vars['domain']["db"]['Name'];
                    $SEOFriendly=$this->all_vars['domain']["db"]['SEOFriendlyLT'];
                }
                $side_menu_sql="";
                $menu_hide_sql=" Menu_HideLT=13 AND ";
                $group_by="GROUP BY URI";
                
                if(!isset($_SESSION['administratorsID'])) $_SESSION['administratorsID']=0;
                if(!isset($_SESSION['membersID'])) $_SESSION['membersID']=0;
                
                if($_SESSION['membersID']>0){
                    $member_type=36;
                    $exposure="(ExposureLT='".$member_type."' OR ExposureLT=38)";
                }elseif($_SESSION['administratorsID']>0){
                    $member_type="Admin";
                    $exposure="ExposureLT='".$member_type."'";
                }else{
                    $member_type=37;
                    $exposure="(ExposureLT='".$member_type."' OR ExposureLT=38)";
                }
                
                if($this->all_vars['content']['db']['domainsID']==0){
                    $admin_menu_sql="AND domainsID=0";
                }
                $sql="SELECT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE Menu_HideLT=13 AND ".$exposure." ".$side_menu_sql." ".$admin_menu_sql." ORDER BY Sort_Order;";
                $rslt=$this->cls->clsDatabaseInterface->RawQuery($sql);
                $first=true;
                $row_count=$this->cls->clsDatabaseInterface->NumRows($rslt);
                
                $this->all_vars['menu']['spacers']="<br>";
                while($data=$this->cls->clsDatabaseInterface->Fetch_Assoc($rslt)){
                    // show spacers in menu
                    if($this->all_vars['menu']['spacers']){
                        if($first){
                            $first=false;
                            $data['first']=true;
                        }else{
                            $data['first']=false;
                        }
                    }else{
                        // no show spacers in menu
                        $data['first']=true;
                    }
                    
                    if($SEOFriendly=="No"){
                        $data['link_address']='http://'.$domain_name.$this->all_vars['app']['ROOTDIR'].'index.php?guid=1&cpid='.$data["content_pagesid"];
                    }else{
                        $data['link_address']='http://'.$domain_name.$data["uri"];
                    }
                    $this->all_vars['menu']["vb"][]=$data;
                }
            }else{
                $data=array();
                $data['first']=true;
                $data['link_address']='http://'.$this->all_vars['domain']["db"]['Name'];
                $data["menutitle"]="Directory Home";
                $this->all_vars['menu']["vb"][]=$data;
            }
            
            return $this->all_vars['menu'];
        }

        public function Horizontal_Install(){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            //include($this->all_vars['app']['MODULEBASEDIR']."menu/menu_base.php");
            $this->all_vars['menu']=$this->Menu_Base();
            //print_r($this->all_vars['menu']);
            $output_data="";
            foreach($this->all_vars['menu']["db"] as $key=>$val){
                if($this->all_vars['menu']['spacers']){
                    if($val['first']==false){
                        $output_data.=' | ';
                    }
                }
                $output_data.='<a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'"><span>'.$val["menutitle"].'</span></a>';
            }
            
            return $output_data;
        }

        public function Horizontal_Rounded_Install(){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            //include($this->all_vars['app']['MODULEBASEDIR']."menu/menu_base.php");
            $this->all_vars['menu']=$this->Menu_Base();
            //print_r($this->all_vars['menu']);
            $output_data="";
            if(isset($this->all_vars['menu']["db"])){
                foreach($this->all_vars['menu']["db"] as $key=>$val){
                    if($this->all_vars['menu']['spacers']){
                        if($val['first']==false){
                            $output_data.=' | ';
                        }
                    }
                    $output_data.='<a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'"><span>'.$val["menutitle"].'</span></a>';
                }
            }
            
            return $output_data;
        }
        

        public function Horizontal_Rounded(){
            
            //echo"\n -FFF2---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            $output_data="";
            
            //include($this->all_vars['app']['MODULEBASEDIR']."menu/menu_base.php");
            $this->all_vars['menu']=$this->Menu_Base();
            //print_r($this->all_vars['menu']);
            $output_data="";
            $this->all_vars['menu']['spacers']="|";
            if(isset($this->all_vars['menu']["db"])){
                foreach($this->all_vars['menu']["db"] as $key=>$val){
                    if($this->all_vars['menu']['spacers']){
                        if($val['first']==false){
                            $output_data.=' | ';
                        }
                    }
                    if(!isset($val["menutitle"])) $val["menutitle"]="";
                    $output_data.='<a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'"><span>'.$val["menutitle"].'</span></a>';
                }
            }
            
            return $output_data;
        }

        public function Horizontal(){

        }

        public function LI_Menu(){
            echo"\n ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            //include($this->all_vars['app']['MODULEBASEDIR']."menu/menu_base.php");
            $this->all_vars['menu']=$this->Menu_Base();
            //print_r($this->all_vars['menu']["db"]);
            $output_data="";
            foreach($this->all_vars['menu']["db"] as $key=>$val){
                if($val['first']==false){
                    $output_data.=' | ';
                }
                $output_data.='<li><a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'"><span>'.$val["menutitle"].'</span></a></li>';
            }
            
            return $output_data;
        }
        public function LI_Rounded(){

        }
        public function LI(){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            //include($this->all_vars['app']['MODULEBASEDIR']."menu/menu_base.php");
            $this->all_vars['menu']=$this->Menu_Base();
            //print_r($this->all_vars['menu']);
            $output_data="";
            foreach($this->all_vars['menu']["db"] as $key=>$val){
                if($this->all_vars['menu']['spacers']){
                    if($val['first']==false){
                        $output_data.=' | ';
                    }
                }
                $output_data.='<li><a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'">'.$val["menutitle"].'</a></li>';
            }
            
            return $output_data;
        }

        public function Vertical_Sub_Page(){
            //echo"\n -QQ---Class=>".__CLASS__."--Method=>".__METHOD__."---------------------------------------------------------------------\n";
            $show_side_menu=true;
            //include($this->all_vars['app']['MODULEBASEDIR']."menu/vertical_menu_base.php");
            $this->all_vars['menu']=$this->Vertical_Menu_Base();
            //print_r($this->all_vars['menu']);
            //print $sql;
            $output_data="";
            if(isset($this->all_vars['menu']["vb"])){
                foreach($this->all_vars['menu']["vb"] as $key=>$val){
                    if($this->all_vars['menu']['spacers']){
                        if(isset($val['first'])){
                            if($val['first']==false){
                                $output_data.='<br>';
                            }
                        }
                        
                    }
                    $output_data.='<a id="link-item-id" class="link-item-cl" href="'.$val['link_address'].'"><span class="link-item-cl">'.$val["menutitle"].'</span></a>';
                }
                //print $output_data;
            }
            
            return $output_data;
        }

    }