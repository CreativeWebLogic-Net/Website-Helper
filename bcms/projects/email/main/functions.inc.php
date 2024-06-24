<?

function str_makerand ($minlength, $maxlength) 
	{ 
	
		$charset = "abcdefghijklmnopqrstuvwxyz"; 
		$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
		$charset .= "0123456789"; 
		if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
		else                         $length = mt_rand ($minlength, $maxlength); 
		for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
		return $key; 
	} 


?>