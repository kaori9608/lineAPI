<?php

     require_once(dirname(dirname(dirname(__FILE__))) . "/misaki_framework/core/db_connection.php");
     
     class appmodel extends db_connection{
          
          var $sql = null;
          
          function dbConnect(){
               return parent::connect();
          }
          
          //値を返すクエリ
          function ExecuteReturnQuery($entity=false){
               
               //DBへ接続
               $dbcon = $this->dbConnect();
               
               //クエリの実行
               $result = mysql_query( $this->sql, $dbcon );
               
               //実行Error時
               if(!$result){
                    mysql_close($dbcon);
                    return false;
               
               }else{
                
                $objArray = array();
                    
                //配列に変換
                    while ( $array = mysql_fetch_array($result, MYSQL_ASSOC)){
                         //エンティティ作成
                         if($entity){
                              $obj = $this->createEntity($array);
                         }else{
                              $obj = $array;
                         }
                         
                         $objArray[] = $obj;
                    }
                    
                    mysql_close($dbcon);
                    return $objArray;
               }
          }
          
          //値を返さないクエリ
          function ExecuteNonQuery($lastInsertId = false){
               
               //DBへ接続
               $dbcon = $this->dbConnect();
               
               //クエリの実行
               $result = mysql_query( $this->sql, $dbcon );
               
               //insertしたIDを取得
               $inserId = mysql_insert_id();
               
               //DBを閉じる
               mysql_close($dbcon);
               
               //クエリ実行Error時
               if(!$result){
                    return false;
               }else{
                    //新規登録時はInsertIDを取得
                    if($lastInsertId){
                         return $inserId;
                    }else{
                         return true;
                    }
               }
          }
          
          //エンティティ作成
          function  createEntity($array=array()){
               
               $obj = $this->createObj();
               
               foreach($array as $key => $value){
                         
                    foreach ($obj as $obj_key => $obj_value){
                         if($key == $obj_key){
                              $obj->$key = $value;
                         }
                    }
               }
               
               return $obj;
          }
     }
?>