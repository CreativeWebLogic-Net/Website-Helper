<?php
class clsSessionHandler implements SessionHandlerInterface
{
    private $savePath;

    public $sess;
    public $log;

    public $r;

    
    function __construct(){

        //$this->Set_Log(clsClassFactory::$all_vars['log']);
        //$this->Set_DataBase(clsClassFactory::$all_vars['r']);
        //$this->Set_Session(clsClassFactory::$all_vars['sess']);
        
    }

    function Set_DataBase($r){
        $this->r=$r;
        
    }

    function Set_Log($log){
        $this->log=$log;
        
    }

    function Set_Session($sess){
        $this->sess=$sess;
        
        
    }

    
    public function open($savePath, $sessionName): bool
    {
        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, 0777);
        }
        //print("XX4");
        return true;
    }

    public function close(): bool
    {
        return true;
    }

    #[\ReturnTypeWillChange]
    public function read($id)
    {
        //print("XX3".$id);
        return (string)@file_get_contents("$this->savePath/sess_$id");
    }

    public function write($id, $data): bool
    {
        
        $output=file_put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
       // print("XX2-".$output."-".$data);
        return $output;
    }

    public function destroy($id): bool
    {
        $file = "$this->savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    #[\ReturnTypeWillChange]
    public function gc($maxlifetime)
    {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }

        return true;
    }
}

