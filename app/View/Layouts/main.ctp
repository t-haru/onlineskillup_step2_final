<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo $this->fetch('title'); ?></title>
		<?php echo $this->Html->css('main'); ?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="header_menu">
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
				<div id="content">
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
	</body>
</html>
