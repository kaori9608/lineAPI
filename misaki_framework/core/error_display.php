<?php
class error_display {

	//------------------------------------------------------------------------------
	// displayWARNING
	//------------------------------------------------------------------------------
	function error_display_Level(){
		switch (debag_level){
			//全エラー非表示
			case "1":
				//Worning系列のエラーを隠します。
				error_reporting(E_ALL ^ E_WARNING);
				break;
			case "2":
				//全エラーを隠す
				error_reporting(0);
				break;
				//全エラーを表示
			default:
				break;
		}
	}

}
?>