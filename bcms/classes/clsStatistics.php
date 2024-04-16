<?php

    class clsStatistics{
        private $size_data=array();
        private $size_total=0;
        private $time_data=array();
        private $time_taken_data=array();

        private $time_interval_data=array();
        private $time_interval_location_sample=array();
        private $time_interval_data_count=0;
        

        function __construct(){
            $this->start_interval_timer();
		}

        function test_output(){
            echo "hello world";
        }

        function start_timer($time_tag){
            $this->time_data[$time_tag]=hrtime();
        }

        function start_interval_timer(){
            //$time_tag=0;
            //$this->time_interval_data_count=$time_tag;
            $this->time_interval_data[]=hrtime(true);
            $this->time_interval_data_count=0;
        }

        function take_time_sample($location_sample=""){
            /*
            if(!isset($this->time_interval_data[$this->time_interval_data_count])){
                $this->time_interval_data[$this->time_interval_data_count]=0;
                $this->time_interval_data[$this->time_interval_data_count]=hrtime();
            }
            */
            $time=hrtime(true);
            if(isset($this->time_interval_data[$this->time_interval_data_count])){
                $previous_timestamp=$this->time_interval_data[$this->time_interval_data_count];
                //print("\n xx1 \n".$previous_timestamp);
            }else{
                $previous_timestamp=$time;
                //print("\n xx2 \n".$previous_timestamp);
            }
            //print_r($time);
            //print("\n xx".$this->time_interval_data_count);
            
            //$this->time_interval_data_count++;
            $this->time_interval_data[$this->time_interval_data_count]=$time;
            $this->time_interval_location_sample[$this->time_interval_data_count]=$location_sample;
            $this->time_interval_data_count++;
        }

        function retrieve_time_samples(){
            $return_array=array($this->time_interval_data,$this->time_interval_location_sample,$this->size_data,$this->size_total);
            return $return_array;
        }

        function end_timer($time_tag){
            $this->time_taken_data[$time_tag]=hrtime()-$this->time_data[$time_tag];
        }

        function size_data($size_tag,$size){
            //print ("\n ".$size_tag."GG2255 Total Size->".$size." \n".$this->size_total);
            $this->size_data[][$size_tag]=$size;
            $this->size_total+=$size;
        }
/*
        function generate_size_tag(){
            $this->size_data[$size_tag]=$size;
        }
*/
        

        function variable_size_data($size_tag,$variable_array=array()){
            $serialized = serialize($variable_array);
            $size = strlen($serialized); // or mb_strlen($serialized, '8bit')
            
            $this->size_data[$size_tag]=$size;
        }
    }
