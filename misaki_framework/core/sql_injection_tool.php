<?php

//バリデーションクラス

class sql_injection_tool{

	function checkValidation( $value , $type = null ){
		if($value){
			switch ($type) {
				case 'int':
					$returnValue = intval($value);
					break;
				default:
					$value = preg_replace(array('/[~;\'\"]/','/--/','/where/i','/select/i','/from/i','/=/i'),'',$value);
					$returnValue = addslashes($value);
			}
			return $returnValue;
		}
	}
}
?>