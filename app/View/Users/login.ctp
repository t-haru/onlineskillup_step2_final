<?php $this->assign('title', 'ログイン'); ?>
<h1>ログイン</h1>
<?php echo $this->Form->create('User'); ?>
<p><?php echo $this->Form->input('username', array(
	'label' => 'ユーザー名'
)); ?></p>
<p><?php echo $this->Form->input('password', array(
	'label' => 'パスワード'
)); ?></p>
<p><?php echo $this->Form->end('ログイン'); ?></p>
<p><?php echo $this->Flash->render(); ?></p>
