<?php

class outputhtml {
	//書き込みするHTMLは固定した名前に指定する。
	function OutPutFixFilename($url = null) {
		//HTML出力するURLを指定

		//URLをファイルとして開く
		$buff = file_get_contents($url);

		//ファイルネームを固定したものに指定
		$fname = SERVER_ROOT_PATH . "userfiles/resulthtml/outputtest.html";
		//ファイルをオープンして書き込みする
		$fhandle = fopen( $fname, "w");
		fwrite( $fhandle, $buff);
		//開いたファイルを閉じる
		fclose( $fhandle );

		if($fhandle){
			$returnvalue = "ファイル書き込みに成功しました。";
		}else{
			$returnvalue = "ファイル書き込みに失敗しました。";
		}
		return $returnvalue;
	}

	//書き込みするHTMLは現在の時刻の名前を指定する。
	function OutPutNowTimeFilename($url = null) {
	    //HTML出力するURLを指定
	    //$url ="http://10.38.0.222/ntl_test/packages/sales/pers_list_html.php?sid=&fo=buy&fod=DESC";
	 	
	 	//URLをファイルとして開く
	    $buff = file_get_contents($url);
	
		//ファイルネームを年、月、日付、現時刻+.htmlに指定
	    $fname = SERVER_ROOT_PATH . "userfiles/resulthtml/log/" . date("Ymdgi").".html";
		//ファイルをオープンして書き込みする
	    $fhandle = fopen( $fname, "w");
	    fwrite( $fhandle, $buff);
	    //開いたファイルを閉じる
	    fclose( $fhandle );
	 	if($fname){
	 		$returnvalue = "ファイル書き込みに成功しました。";
	 	}else{
	 		$returnvalue = "ファイル書き込みに失敗しました。";
	 	}
		return $returnvalue; 
	}

	//書き込みするファイル名も指定する。
	function OutPutDesignationFilename($url = null , $file_name = null) {
	    //HTML出力するURLを指定
	    //$url ="http://10.38.0.222/ntl_test/packages/sales/pers_list_html.php?sid=&fo=buy&fod=DESC";
		if(!$file_name){
			//ファイル名の入力が無かったらデフォルトの形にする。
			$this->OutPutFixFilename($url);
		}
	 	//URLをファイルとして開く
	    $buff = file_get_contents($url);
	
		//ファイルネームを年、月、日付、現時刻+.htmlに指定
	    $fname = $file_name.".html";
		//ファイルをオープンして書き込みする
	    $fhandle = fopen( $fname, "w");
	    fwrite( $fhandle, $buff);
	    //開いたファイルを閉じる
	    fclose( $fhandle );
	 	if($fname){
	 		$returnvalue = "ファイル書き込みに成功しました。";
	 	}else{
	 		$returnvalue = "ファイル書き込みに失敗しました。";
	 	}
		return $returnvalue; 
	}
}
?>
