<?php 
	session_start();
	require('../dbconnect.php');

	$error = array();

	if (!empty($_POST)) {
		//エラー項目の確認
		if ($_POST['name'] == '') {
		  $error['name'] = 'blank';
		  // echo'名前フォームが空だった時';
		}
		if ($_POST['email'] == '') {
		 $error['email'] = 'blank';
		 // echo'メールフォームが空だった時';
		}
		if (strlen($_POST['password']) < 4) {
		  $error['password'] = 'length';

		}
		if ($_POST['password'] == '') {
		  $error['password'] = 'blank';
		  // echo'パスワードフォームが空だった時';
		}

		// 選択された画像の名前を取得
		$fileName = $_FILES['picture']['name'];
		// echo $fileName;
		if (!empty($fileName)) {
		  $ext = substr($fileName, -3);
		  if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
		    $error['picture'] = 'type';
		  }
		}

		if (empty($error)) {
		 $sql = sprintf('SELECT COUNT(*) AS cnt FROM members WHERE email="%s"',
		   mysqli_real_escape_string($db,$_POST['email'])
		   );
		 $record = mysqli_query($db,$sql) or die(mysqli_error($db));
		 $table = mysqli_fetch_assoc($record);
		 // var_dump($table);
		 if($table['cnt'] > 0){
		   $error['email'] = 'duplicate';
		 }

		}

		if (empty($error)) {
		 $image = date('YmdHis') . $_FILES['picture']['name'];
		 move_uploaded_file($_FILES['picture']['tmp_name'], '../member_picture/' . $image);


		 $_SESSION['join'] = $_POST;
		 $_SESSION['join']['picture'] = $image;
		   header('Location: check.php');
		   exit();
		}

	}
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
	<title>登録</title>
</head>
<body>
	<h2>以下をお書きください</h2>
	<form method="post" action="" enctype="multipart/form-data">
		<label>ニックネーム</label>
			<input type="text" name="name">
			<?php if (isset($error['name'])): ?>
			<?php if ($error['name'] == 'blank') : ?>
			  <p class="error"><small>ニックネームを入力してください。</small></p>
			<?php endif; ?>
			<?php endif; ?>
			<br>

		<label>メアド</label>
			<input type="text" name="email">
			<?php if (isset($error['email'])): ?>
			<?php if ($error['email'] == 'blank') : ?>
			  <p><small>メールアドレスを入力してください。</small></p>
			<?php endif; ?>
			<?php endif; ?>
			<br>

		<label>パスワード</label>
			<input type="password" name="password">
			<?php if (isset($error['password'])): ?>
			<?php if ($error['password'] == 'blank') : ?>
			  <p><small>パスワードを入力してください。</small></p>
			<?php endif; ?>
			<?php endif; ?>
			<br>

		<label>プロフィール写真</label>      
            <input type="file" name="picture">
              <?php if (isset($error['picture']) && $error['picture'] == 'type'): ?>
              <p><small>写真などは『.gif』または『.jpg』または『.png』の画像を指定してください</small></p>
            <?php endif; ?>
            <?php if(!empty($error)): ?>
              <p><small>恐れいりますが、画像を改めて指定してください</small></p>
              <?php endif; ?>
              <br>

        <input type="submit" value="確認画面へ">
	</form>
</body>
</html>