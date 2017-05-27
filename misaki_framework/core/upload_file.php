<?php
	include (dirname(dirname(dirname(__FILE__))) . "/config/setting.php");

class upload_file {

	//------------------------------------------------------------------------------
	//コンストラクタ
	//------------------------------------------------------------------------------
	function upload_file() {
	}

	//------------------------------------------------------------------------------
	// ファイルをアップロードする処理
	//------------------------------------------------------------------------------
	function execute($upload_file_name) {
		if($upload_file_name){
			$uploaddir = UPLOAD_DIRECTORY . "csv/";

			$uploadfile = $uploaddir . $_FILES[$upload_file_name]["name"];
			$myfile_type = $_FILES[$upload_file_name]['type'];

			//CSV以外のアップロードを制限する
			if(strpos($_FILES[$upload_file_name]["name"],'.csv') !== false || strpos($_FILES[$upload_file_name]["name"],'.CSV') !== false){
				if (is_uploaded_file($_FILES[$upload_file_name]["tmp_name"])) {
					if (move_uploaded_file($_FILES[$upload_file_name]["tmp_name"],$uploadfile)) {
						chmod($uploadfile, 0644);
						$execute_result ="<span style='margin-left:5px;color:#FFF;'>アップロードOK</span>";
					} else {
						echo "<span style='margin-left:5px;color:#F00; font-weight:bold;'>ファイルをアップロードできません。</span>";exit;
					}
				} else {
					echo"<span style='margin-left:5px;color:#F00; font-weight:bold;'>ファイルが選択されていません。</span>";exit;
				}				
			 }else{
				echo"<span style='margin-left:5px;color:#F00; font-weight:bold;'>CSVをアップロードしてください</span>";exit;
			}
		}else{
			echo "<span style='margin-left:5px;color:#F00; font-weight:bold;'>ファイルをアップロードできません。</span>";exit;
		}

		return $execute_result;
	}

	//------------------------------------------------------------------------------
	// ファイルをアップロードする処理
	//------------------------------------------------------------------------------
	function execute_images($upload_file_name,$me_staff_detail_id) {
		if($upload_file_name){
			$uploaddir = UPLOAD_DIRECTORY . "meiboo/" . $me_staff_detail_id . "/";

			$uploadfile = $uploaddir . $_FILES[$upload_file_name]["name"];
			$myfile_type = $_FILES[$upload_file_name]['type'];
			
				if (is_uploaded_file($_FILES[$upload_file_name]["tmp_name"])) {
					if (move_uploaded_file($_FILES[$upload_file_name]["tmp_name"],$uploadfile)) {
						chmod($uploadfile, 0644);
						$execute_result ="<span style='margin-left:5px;color:#000;'>アップロードOK</span>";
					} else {
						$execute_result = "<span style='margin-left:5px;color:#F00; font-weight:bold;'>ファイルをアップロードできません。</span>";
					}
				} else {
					$execute_result ="<span style='margin-left:5px;color:#F00; font-weight:bold;'>ファイルが選択されていません。</span>";
				}				
			}else{
				$execute_result = "<span style='margin-left:5px;color:#F00; font-weight:bold;'>ファイルをアップロードできません。</span>";
			}
		return $execute_result;
	}
	
}
?>
