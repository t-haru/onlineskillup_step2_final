<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo $this->fetch('title'); ?></title>
		<?php echo $this->Html->css('user'); ?>
	</head>
	<body>
		<div id="header_fixed">
			<div id="header_bk">
				<div id="header">
					<?php
						if(isset($user)):
							echo $this->Html->link('ホーム', '/users/index');
							echo $this->Html->link('友だちを検索', '/follows/search');
							echo $this->Html->link('ログアウト', '/users/logout');
						else:
							echo $this->Html->link('ホーム', '/users/index');
							echo $this->Html->link('ユーザー登録', '/users/register');
							echo $this->Html->link('ログイン', '/users/login');
						endif;
					?>
				</div>
				<div id="header_logo">
					<h1><?php echo $this->Html->link('ついったー', '/posts/index') ?></h1>
				</div>
			</div>
		</div>
		<div id="footer_fixed">
			<div id="footer_bk">
				<div id="footer">
					<?php echo $user['username']; ?>
					<br>
					<?php $userid = $user['id']; ?>
					<?php
					echo $this->Html->link('フォローしている', '/follows/follows');
					echo $this->Html->link('フォローされている', '/follows/followers');
					echo "<a href='post/$userid'> " . "投稿数" . "</a>";
					?>
				</div>
			</div>
		</div>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
	</body>
</html>
