<?php


class csvToArray {
	//------------------------------------------------------------------------------
	//コンストラクタ
	//------------------------------------------------------------------------------
	function csvToArray() {
	}
	//------------------------------------------------------------------------------
	//CSVデータを一行ずつ配列に格納
	//------------------------------------------------------------------------------
	function arrayToCsvData($file_name = null) {
		//CSVファイルの場所を定義
		$data = file_get_contents(UPLOAD_DIRECTORY . "csv/" . $file_name);

		//$data上で指定したCSVデータがあるかどうか。無いものは無いって伝える。
		if (file_exists(UPLOAD_DIRECTORY . "csv/" . $file_name)) {

			error_reporting(0);
			//CSVデータの文字コードをUTF-8に変換。
			$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
			$temp = tmpfile();
			$meta = stream_get_meta_data($temp);
			fwrite($temp, $data);
			rewind($temp);
			$file = new SplFileObject($meta['uri']);
			$file->setFlags(SplFileObject::READ_CSV);

			//返す値を定義する
			$arraycsvResult  = array();

			//回して一行ずつ配列に収納
			foreach($file as $key => $value) {
				if($value){
					$arraycsvResult[] = $value;
				}
			}

			//ファイルを閉じます。
			fclose($temp);
			$file = null;

			return $arraycsvResult;

		}else{
			return "CSVファイルが見つかりません";
		}


	}

}
?>