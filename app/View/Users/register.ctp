<?php $this->assign('title', 'ユーザー登録'); ?>
<h1>ついったーに参加しましょう</h1>
もうついったーに登録していますか？<?php echo $this->Html->link(
	'ログイン',
	'/users/login'
); ?>
<?php echo $this->Form->create('User'); ?>
<p><?php echo $this->Form->input('name', array(
	'label' => '名前',
	'required' => false
)); ?></p>
<p><?php echo $this->Form->input('username', array(
		'label' => 'ユーザー名',
		'required' => false
)); ?></p>
<p><?php echo $this->Form->input('password', array(
		'label' => 'パスワード',
		'required' => false
)); ?></p>
<p><?php echo $this->Form->input('email', array(
		'label' => 'メールアドレス',
		'required' => false
)); ?></p>
<p><?php echo $this->Form->input('private', array(
		'type' => 'checkbox',
		'label' => 'つぶやきを非公開にする'
)); ?></p>
<p><?php echo $this->Form->end('アカウントを作成する');?></p>
