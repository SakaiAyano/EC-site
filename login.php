<?php
require_once('data.php');
require_once('db.php');

session_start();
$mail="";
$pass="";
$err_msg=array('mail'=>'','pass'=>'','err'=>'');
//POST送信があるかないか判定
if(!empty($_POST)){
    $mail=$_POST['mail'];
    $pass=$_POST['pass'];


    //各々バリデーションチェック
    if($mail===""){
        $err_msg['mail']="メールアドレスは必須入力です";
    }

    if($pass===""){
        $err_msg['pass']="パスワードは必須入力です";
    }

    //バリデーションが空となっているか確認
    if($err_msg['mail']==='' && $err_msg['pass']==='' && $err_msg['err'] ==='' ){
        //会員情報のデータを取得[users]
        //$sql = 'SELECT id AS count FROM users WHERE mail=:mail AND pass=:pass';
        $sql = 'SELECT count(*) AS count FROM users WHERE mail="'.$mail.'" AND pass="'.$pass.'"';
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['count']>0){
          $sql = 'SELECT * FROM users WHERE mail="'.$mail.'" AND pass="'.$pass.'"';
          $stmt = $dbh->query($sql);
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          $_SESSION['id']=$result['id'];
          $_SESSION['name_f']=$result['name_f'];
          $_SESSION['name_l']=$result['name_l'];
          $err_msg['err']='OK';
          header("Location:index.php");
          exit();
        }else{
          $err_msg['err']="ログイン失敗";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ログインページ</title>
    <link rel="stylesheet" href="css/stylesheet.css">
  </head>
  <body>
      <form action="" method="POST">
      <div class="login">
          <h1>ログイン画面</h1>
          <div class="err_msg"><?php echo $err_msg['mail']; ?></div>
          <div class="err_msg"><?php echo $err_msg['pass']; ?></div>
          <div class="err_msg"><?php echo $err_msg['err']; ?></div>
          <table align="center">
              <tr>
                <th>メールアドレス</th>
                <th><input class="login-in" type="text" name="mail" value="<?php echo $mail ?>"></th>
              </tr>
              <tr>
                <th>パスワード</th>
                <th><input class="login-in" type="password" name="pass" value="<?php echo $pass ?>"></th>
              </tr>
          </table>
          <input type="submit" value="ログイン">
      </div>
      </form>
  </body>
</html>
