<?php
class upload_ftp{
	function FTPupload($ftp_server = null , $ftp_user = null , $ftp_pass = null , $remote_put_file = null  , $remote_dir = null , $ftp_target_dir = null){
    //サーバー上のディレクトリに移動する。
    if(!$ftp_target_dir){
        $ftp_target_dir = "/";
    }

    //アップロードするローカルファイルをチェックする
    if(!$remote_dir){
        $remote_dir = "";
    }
    if(!$remote_put_file){
        $remote_put_file = "test.txt";
    }
 
    $connect_id = ftp_connect( $ftp_server );
 	
 	$uploadresult = "";
    if( ftp_login( $connect_id , $ftp_user , $ftp_pass ) ) {
        echo "FTPログイン成功";
    }
    else {
        echo "FTPログイン失敗";
        ftp_close( $connect_id );
        exit;
    }
 
    if( ftp_chdir( $connect_id , $ftp_target_dir ) ) {
        echo "ディレクトリ遷移成功 >>> " . ftp_pwd( $connect_id );
 
        # No.01
        if( ftp_put( $connect_id , $remote_put_file , "{$remote_dir}{$remote_put_file}" , FTP_BINARY ) ) {
            echo "File送信成功";
        }else{
            echo "Fil送信失敗";exit;
        }
    }
    else {
        echo "ディレクトリ遷移失敗";
        ftp_close( $connect_id );
        exit;
    }

 	//FTP接続を切断する
    ftp_close( $connect_id );

	}
}
?>
