<?php 
require('../dbconnect.php');
if (!empty($_POST)) {
	if ($_POST['email'] !='' && $_POST['password'] !='') {
		$sql = sprintf('SELECT * FROM `members` WHERE email="%s" AND password="%s"',
			mysqli_escape_string($db,$_POST['email']),
			mysqli_escape_string($db,sha1($_POST['password']))
			);
		$record = mysqli_query($db,$sql) or die(mysqli_error($db));
		if ($table=mysqli_fetch_assoc($record)) {
			$_SESSION['id']=$table['id'];
			
			header('Location:../home.php');
			exit();
		}else{
			$error['login'] = 'failed';
		}
	}
}

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
	<title>login</title>
</head>
<body>
	<h2>初めまして！</h2>
	<form action="" method="post">
		<label>メールアドレスを入力してください</label>
			<?php if (isset($_POST['email'])): ?>
			<input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
		<?php else: ?>
			<input type="email" name="email" value="">

		<?php endif; ?>
			<?php if (isset($error['login']) && $error['login']=='blank'): ?>
				<p>メールアドレスとパスワードを入力してください</p>			

		<?php endif; ?>
			<?php if (isset($error['login']) && $error['login']=='failed'):?>
				<p>ログインに失敗しました。正しくご入力してください.</p>

		<?php endif; ?>
		<br>

		<label>パスワードを入力してください</label>
			<?php if(isset($_POST['password'])): ?>
				<input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>">
			<?php else: ?>
				<input type="password" name="password" value="">
			<?php endif; ?>
			
			<br>

		<input type="submit" value="ログイン">

	</form>	

</body>
</html>