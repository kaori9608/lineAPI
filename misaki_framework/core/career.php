<?php

require_once (dirname(dirname(__FILE__)) . "/settings/setting.php");

class career {

    //----------------------------------------------------------------------------------
	//各キャリアを識別
    //----------------------------------------------------------------------------------
	function getCareer(){
		//Deprecated系のエラーを隠す
		error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
		
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			if(eregi("DoCoMo",$user_agent)){
				$career="DoCoMo";
			}elseif(eregi("UP\.Browser",$user_agent)){
				$career="au";
			}elseif(eregi("J-PHONE",$user_agent)){
				$career="SoftBank";
			}elseif(eregi("Vodafone",$user_agent)){
				$career="SoftBank";
			}elseif(eregi("SoftBank",$user_agent)){
				$career="SoftBank";
			}elseif(eregi("J-EMULATOR",$user_agent)){
				$career="J-EMULATOR";
			}elseif(eregi("iPhone",$user_agent)){
				$career="iPhone";
			}elseif(eregi("Android",$user_agent)){
				$career="Android";
			}elseif(eregi("MSIE",$user_agent)){
				$career="IE";
			}elseif(eregi("chrome",$user_agent)){
				$career="Chrome";
			}elseif(eregi("Safari",$user_agent)){
				$career="Safari";
			}elseif(eregi("AdsBot-Google",$user_agent)){
				$career="Google-Bot";
			}else{
				$career="etc";
			}
		}else{
			$career="etc";
		}
		
		return $career;
		
	}

    //----------------------------------------------------------------------------------
	//個体識別情報を取得
    //----------------------------------------------------------------------------------
	function getID(){
		
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			
			if(eregi("DoCoMo",$user_agent)){
				preg_match("/^.+ser([0-9a-zA-Z]+).*$/", $user_agent, $match);
				if($match){
					$id = $match[1];
				}else{
					$id="None";
				}
			}elseif(eregi("UP\.Browser",$user_agent)){
				$id = $_SERVER['HTTP_X_UP_SUBNO'];
			}elseif(eregi("J-PHONE",$user_agent)){
				preg_match("/^.+\/SN([0-9a-zA-Z]+).*$/", $user_agent, $match);
				$id = $match[1];
			}elseif(eregi("Vodafone",$user_agent)){
				preg_match("/^.+\/SN([0-9a-zA-Z]+).*$/", $user_agent, $match);
				$id = $match[1];
			}elseif(eregi("SoftBank",$user_agent)){
				preg_match("/^.+\/SN([0-9a-zA-Z]+).*$/", $user_agent, $match);
				$id = $match[1];
			}elseif(eregi("J-EMULATOR",$user_agent)){
				preg_match("/^.+\/SN([0-9a-zA-Z]+).*$/", $user_agent, $match);
				$id = $match[1];
			}else{
				$id="None";
			}
		}else{
			$id="None";
		}
		
		return $id;
		
	}
	
	
}
?>
