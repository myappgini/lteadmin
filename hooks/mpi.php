<?php

// 
// Author: Alejandro Landini
// Mpi.php 5/6/18
//      manage profile image
// toDo: 
// revision:
// 

class Mpi {
    public $user;
    public $image;
    public $thumb;
    public $menssage;
    private $path;
    private $filename = 'mpi.json';
    private $json;
    private $data;
    Private $noImage = 'no_image.png';

    public function __construct($user, $path, $newImage='',$thumb='') {
        $this->user = $user;
        $this->path = $path;
        $this->data = $this->jsonGetFile();
        if (empty($this->userImage())){
            $this->image = $this->jsonAdduser();
        }
        if (empty($newImage)){
            $this->image = $this->userImage();
            $this->thumb = $this->getThumb();
        }else{
            $this->image = $newImage;
            $this->thumb = $thumb;
            $this->jsonAdduser();
        }
    }
    
    public function setImage($newImage) {
        if (!empty($newImage)){
            $this->image = $newImage;
            $this->jsonAdduser();
            $this->menssage = 'image saved';
        } else {
            $this->menssage = 'image not saved';
        }
        
    }

        private function jsonCreteFile(){
            //set the filename
            if (!$this->existFile()){
                $handle = fopen($this->path.$this->filename,'w+');
                fwrite($handle, $this->json);
                fclose($handle);
                $this->menssage= 'Data successfully saved in new file';
            }else{
                if(file_put_contents($this->path.$this->filename, $this->json)) {
                    $this->menssage= 'Data successfully saved';
                }else{ 
                    $this->menssage= "error";
                }
            }
            return;
        }
        
        private function existFile(){
            return file_exists($this->path.$this->filename);
        }

        private function jsonGetFile(){
            if ($this->existFile()){
                return json_decode(file_get_contents($this->path.$this->filename),true);
            }else{
                return '';
            }
        }
        
        private Function userImage(){
            $ret ='';
            if (!empty($this->data)){
                foreach ($this->data as $k=>$v){
                    if ($this->data[$k]['user']== $this->user) {
                        $ret = $this->data[$k]['image'];
                        if (empty($ret)){
                            $ret = $this->noImage;
                        }
                        break;
                    }
                }
            }
            return $ret;
        }
        
        private Function getThumb(){
            $ret ='';
            if (!empty($this->data)){
                foreach ($this->data as $k=>$v){
                    if ($this->data[$k]['user']== $this->user) {
                        $ret = $this->data[$k]['thumb'];
                        if (empty($ret)){
                            $ret = $this->noImage;
                        }
                        break;
                    }
                }
            }
            return $ret;
        }
        
        private function jsonAdduser(){ //or change image
            $i = $this->userImage();
            if (empty($i)){
                //add user
                $d[]= array(
                        'user'=> $this->user,
                        'image'=> empty($this->image) ? $this->noImage : $this->image, 
                        'thumb'=> empty($this->thumb) ? $this->noImage : $this->thumb 
                    );
                if (empty($this->data)){
                    $this->data=$d;
                }else{
                    array_push($this->data, $d);
                }
            }else{
                //update image
                foreach ($this->data as $k=>$v){
                if ($this->data[$k]['user'] === $this->user) {
                    $this->data[$k]['image'] = $this->image;
                    $this->data[$k]['thumb'] = $this->thumb;
                    break;
                    }
                 }
            }
            $this->json=json_encode($this->data);
            $this->jsonCreteFile();
            return;   
        }
}
//test
//$a = new Mpi('alea',$hooks_dir.'/../images/');
//echo $a->user;
//echo '<br>';
//echo $a->image;
//echo '<br>';
//echo $a->menssage;
//echo '<br>';
//$a->setImage('mijpg.jpg');
//echo $a->image;
