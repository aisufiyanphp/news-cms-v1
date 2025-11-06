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

?>