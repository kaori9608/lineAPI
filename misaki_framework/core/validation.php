<?php

//バリデーションクラス

class validation{

	function loadValidation($chkArray){
		$v_errMsg = array();
	
		foreach ($chkArray as $key => $value){
			
			switch ($value[1]){
				case "_v_num":
					if(!$this->_v_num($value[0])){
						$v_errMsg[] = $value[2] . "は半角数字で入力してください。"; 	
					}
					break;
				case "_v_null":
					if(!$this->_v_null($value[0])){
						$v_errMsg[] = $value[2] . "は必須入力項目です。";
					}
					break;
                case "v_select":
                    if(!$this->_v_num($value[0])){
                        $v_errMsg[] = $value[2] . "を選択してください。";
                    }
                    break;
				case "_v_mb_str_length":
					if(!$this->_v_mb_str_length($value[0], $value[3])){
						$v_errMsg[] = $value[2] . "は" . $value[3] . "文字以上入力できません。";
					}
					break;
                case "_v_comparison":
                    if(!$this->_v_comparsion($value[0], $value[1])){
                        $v_errMsg["comparison"] = $value[2] . "と" . $value[3] . "は必ず入力してください";
                    }
                    break;
                case "_v_num":
                    if(!$this->_v_num($value[0])){
                        $v_errMsg[] = $value[2] . "は半角数字で入力してください。";
                    }
                    break;
                case "_v_num_length":
                    if(!$this->_v_num_length($value[0], $value[3])){
                        $v_errMsg[] = $value[2] . "は" . $value[3] . "桁までで入力してください。";
                    }
                    break;
				case "_v_mail":
                    if(!$this->_v_mail($value[0])){
                        $v_errMsg[] = $value[2] . ":正確なメールアドレスを入力して下さい。";
                    }
                    break;
				case "_v_phone":
                    if(!$this->_v_phone($value[0])){
                        $v_errMsg[] = $value[2] . "を、正しく入力してください。";
                    }
                    break;
				case "_v_post_num":
                    if(!$this->_v_post_num($value[0])){
                        $v_errMsg[] = $value[2] . "を、もう一度、ご確認してください。";
                    }
                    break;
				case "_v_date":
					if(!$this->_v_date($value[0])){
                        $v_errMsg[] = $value[2] . "を、もう一度、ご確認してください。";
                    }
                    break;
				case "_v_sql_date":
					if(!$this->_v_sql_date($value[0])){
                        $v_errMsg[] = $value[2] . "を、もう一度、ご確認してください。";
                    }
                    break;
			}
		
		}
		
		//入力Errorがあれば
		if(!empty($v_errMsg)){
			return $v_errMsg;	
		}
		
		
	}

	// phone validation
	function _v_sql_date( $post_date )
	{
		if(!preg_match("/^\d{4}\-\d{2}\-\d{2}$/",$post_date)){
			return false ;
		}else{
    		return true ;
		}
	}
	
	// date validation
	function _v_date( $post_date )
	{
		if($post_date){
			//エラー返しを非表示に
			error_reporting(E_ALL & ~E_NOTICE);
			error_reporting(0);
			list($year,$month,$day) = explode("-",$post_date);
			
			if(checkdate($month,$day,$year)) {
				return true ;
			} else {
				return false ;
			}
		}
	}
	
	// phone validation
	function _v_phone( $post_num )
	{
		if(!preg_match("/^0\d{1,5}-\d{0,4}-?\d{4}$/",$post_num) || !preg_match("/^.{11,13}$/",$post_num)){
			return false ;
		}else{
    		return true ;
		}
	}
	
	// mail address validation
	function _v_mail( $usr_mail )
	{
		$chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i" ;
		if( strstr( $usr_mail, "@" ) && strstr( $usr_mail, "." ) ) {
			if( preg_match( $chars, $usr_mail ) ) {
				return true ;
			} else {
				return false ;
			}
		} else {
			return false ;
		}
	}

	// not is_null validatoin
	function _v_null( $str )
	{
		if( is_null( $str )  || empty( $str )) {
			return false ;
		} else {
			return true ;
		}
	}


	//number validation
	function _v_num($num)
	{
		if(is_numeric($num)) {
			return true ;
		} else {
			return false ;
		}
	}
    
    //number validation
    function _v_num_length($num, $length)
    {
        if(strlen($num) > $length){
            return false;
        }else{
            return true;
        } 

    }
    
    
    //value comparsion
    function _v_comparsion($valueArray=array()){
        
        if($valueArray[0] && empty($valueArray[1])){
            return false;
        }elseif(empty($valueArray[0]) && $valueArray[1]){
            return false;
        }else{
            return true;   
        }
        
    }

	// post number validation
	function _v_post_num( $post_num )
	{
		if( preg_match( "/^[0-9]{3}\-[0-9]{4}$/", $post_num ) ) {
			return true ;
		} else {
			return false ;
		}
	}
	
	
	
	// 1byte stringth validation
	function _v_sb_str_length( $str, $length = 30 )
	{
		if( is_null( $str ) ) { return false ; }
		$str_length = strlen( $str ) ;

		if ( $str_length <= $length ) {
			return true ;
		} else {
			return false ;
		}
	}


	// multi byte string length validation.
	function _v_mb_str_length( $str, $length)
	{
		if( is_null( $str ) ) { return false ; }
        $str_length = mb_strlen( $str, 'UTF-8');
        
		if ( $str_length <= $length ) {
			return true ;
		} else {
			return false ;
		}
	}


	function _v_birthday( $year, $month, $day, $age = 20  )
	{
		$now_y = date("Y");
		$now_m = date("m");
		$now_d = date("d");

		$age = $now_y - $year;
		if($now_m * 100 + $now_d < $now_m * 100 + $day) $age--;

		return $age;
	}
}





?>
