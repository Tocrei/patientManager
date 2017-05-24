<?php
 
	function __($str, $lang = null){
 
		if ( $lang != null ){
 
			if ( file_exists('lang//language_'.$lang.'.php') ){
 
				include('lang//language_'.$lang.'.php');
				if ( isset($texts[$str]) ){
					$str = $texts[$str];
				}
			}
		}
 
		return $str;
	}
 
?>