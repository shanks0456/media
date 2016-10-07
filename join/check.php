<?php
session_start();
   require('../dbconnect.php');

  if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
  }

  if (!empty($_POST)) {
    // 登録処理
    $sql = sprintf('INSERT INTO members SET name="%s",email="%s",password="%s",picture="%s"',
      mysqli_real_escape_string($db, $_SESSION['join']['name']),
      mysqli_real_escape_string($db, $_SESSION['join']['email']),
      mysqli_real_escape_string($db, sha1($_SESSION['join']['password'])),
      mysqli_real_escape_string($db, $_SESSION['join']['picture']),
      date('Y-m-d H:i:s')
      );
      mysqli_query($db, $sql) or die(mysqli_error($db));
      unset($_SESSION['join']);

      header('Location: thanks.php');
      exit();
  }

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">

    <title>SeedSNS</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/join.css">
  </head>
          <body>
            <h2>ご確認ください。</h2>
        <form method="post" action="" role="form">
          <input type="hidden" name="action" value="submit">

            <table>
              <tbody>
                <!-- 登録内容を表示 -->
                <div>
                  <div>
                    <div>ニックネーム： <?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                  </div>
                  <div>
                    <div>メールアドレス： <?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES, 'UTF-8'); ?></div>
                  </div>
                  <div>
                    <div>パスワード： ●●●●●●●●</div>
                  </div>
                  <div>
                    <div>プロフィール： <img src="../member_picture/<?php echo htmlspecialchars($_SESSION['join']['picture_path'], ENT_QUOTES, 'UTF-8'); ?>"></div>
                  </div>
                  
                  <br>

                  <a href="index.php? action=rewrite">&laquo;&nbsp;書き直す</a>
                  <input type="submit" value="会員登録" action='thanks.php'>


              </tbody>
            </table>

        </form>

  </body>
</html>
