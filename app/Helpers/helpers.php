<?php 

if(!function_exists('debug')){	
	function debug($args, $stop=true){
       echo "<pre>";
         print_r($args);
       echo "</pre>";
       if($stop){
       	  exit();
       }
	}
}

if(!function_exists('fileUploads')){  
  function fileUploads($file, $path){
       $ext  = $file->extension();
       $filename = uniqid(time()).".".$ext;
       if($file->move($path, $filename)){
          return $filename; 
       }else{
          return false;
       }       
  }
}

if(!function_exists('fileDelete')){  
  function fileDelete($filename, $path){
      $file = $path.$filename;
      if(file_exists($file)){
         unlink($file);
      }
  }
}

?>