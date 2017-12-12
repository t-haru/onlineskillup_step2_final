<?php $this->assign('title', 'ユーザー検索'); ?>

<h1>友だちを見つけて、フォローしましょう！</h1>

<p>ツイッターに登録済みの友だちを検索できます。</p>

<p>誰を検索しますか？
<?php echo $this->Form->create('Follow'); ?>
<?php echo $this->Form->input('search' ,array(
	'label' => ''
)); ?>
<?php echo $this->Form->end('検索'); ?>
ユーザー名や名前で検索
</p>
