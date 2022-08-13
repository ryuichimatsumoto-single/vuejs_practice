<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

  // エラーメッセージを出力する関数
  function failed_error_message($message){
    $data["status"] = 500;
    $data["message"] = $message;
    echo json_encode($data);
  }

  // 成功時のメッセージを出力する関数
  function success_message($message){
    $data["status"] = 200;
    $data["message"] = $message;
    echo json_encode($data);
  }

  $dbh = new PDO("mysql:host=localhost; dbname=xxx; charset=utf8", 'xxx', 'xxx');


  // バリデーション
  //　空欄の時
  if(empty($_POST['prms'])){
    failed_error_message("空欄です");
    return ;
  }

  if(!preg_match("/^[0-9a-zA-Z]+$/", $_POST['prms'])){
    failed_error_message("半角英数字で入力してください。");
    return ;
  }

  $sql = 'INSERT INTO test (prms) VALUES (?)';
  $stmt = $dbh->prepare($sql);
  $flag = $stmt->execute(array($_POST['prms']));

  if($flag == false) {
    failed_error_message("DBのデータ登録に失敗しました");
    return ;
  }
  success_message("DBのデータ登録に成功しました。");
?>
