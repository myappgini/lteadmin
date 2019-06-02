<?php
// 
// Author: Alejandro Landini
// mpi_AJAX.php 4/6/18
// toDo: 
// revision: 
// * 5/6/18 add Mpi.php class
// 
//

	$hooks_dir = dirname(__FILE__);
        if(!function_exists('PrepareUploadedFile')){
            include("{$hooks_dir}/../lib.php");
        } 
        include ("{$hooks_dir}/mpi.php");
        
	$user_data = getMemberInfo();
        $mpiFolder = $hooks_dir."/../images/";
        
        $filename = $mpiFolder.'mpi.json';
        
        $name = PrepareUploadedFile('mpi', 4198400,'jpg|jpeg|gif|png', false, $mpiFolder);
        
        if ($name){
            $specs['width']=80;
            $specs['height']=80;
            $specs['identifier']='_mpi';
            $thumb = createThumbnail($mpiFolder.'/'.$name, $specs);
            preg_match('/\.[a-zA-Z]{3,4}$/U', $name, $matches);
            $ext=strtolower($matches[0]);
            $t=substr($name, 0, -5).str_replace($ext,  $specs['identifier'].$ext, substr($name, -5));
        }
        $mpi = new Mpi($user_data['username'],$mpiFolder,$name,$t);
        echo '{"image":"'.$mpi->image. '", "thumb":"'.$mpi->thumb.'"}';
        
        