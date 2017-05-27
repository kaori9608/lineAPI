<?php
	include (dirname(dirname(dirname(__FILE__))) . "/config/setting.php");

class csv {

	//------------------------------------------------------------------------------
	//コンストラクタ
	//------------------------------------------------------------------------------
	function csv() {
	}
	
	//----------------------------------------------------------------------------------
	//CSVファイルのディレクトリパスを与えると、件数を取得する。
    //----------------------------------------------------------------------------------
	function count_all($csv_file_name){
		if($csv_file_name){
			$uploaddir = UPLOAD_DIRECTORY;
			$uploadfile = $uploaddir . $csv_file_name;
			// ファイルを読み込む
			if(!$rows=file($uploadfile)) {
				$result = "<span style='margin-left:5px;color:#F00; font-weight:bold;'>アップロードファイルが見つかりません！！</span>";
			}
			//件数
			$result = count($rows);
			
			return $result;
		}
	}

    //----------------------------------------------------------------------------------
	//CSVファイルのディレクトリパスを与えると、先頭行をキーにして配列に変換する
    //----------------------------------------------------------------------------------
	function convert_array($csv_file_name,$csv_file_max_count){
		$session = new Session();
		$progress_counter=0;
		$session->add("hoge",$progress_counter);
		$progress_counter_plus = 100 / $csv_file_max_count;
		
		$row_all=array();
		if($csv_file_name){
			$uploaddir = UPLOAD_DIRECTORY;
			$uploadfile = $uploaddir . $csv_file_name;
			
			// ファイルを読み込む
			if(!$rows=file($uploadfile)) {
				$result = "<span style='margin-left:5px;color:#F00; font-weight:bold;'>アップロードファイルが見つかりません！！</span>";
			}
			//エンコ
			mb_convert_variables("UTF-8", "SJIS-win", $rows);
			
			// ファイルを一行づつ処理
			$csv_header=0;
			$row_header = array();
			$row_value = array();
			
			foreach($rows as $row) {
				$progress_counter = $progress_counter + $progress_counter_plus;
				$session->add("hoge",$progress_counter);
				$row = preg_replace("/\r|\n/","",$row);
				$data = explode( ",", $row );		//カンマ区切りの場合
				if($csv_header==0){
					foreach ($data as $key => $value) {
						$value=trim($value,"\x22 \x27");
						$row_header[$key]=$value;
					}
					$csv_header=1;
				}else{
					foreach ($data as $key => $value) {
						$value=trim($value,"\x22 \x27");
						if($value){
							$row_value[$key] = $value;
						}
					}

					$row_all[] = array_combine($row_header, $data);
				}
					
			}
		}
		return $row_all;
	}
}

?>