<?php $this->assign('title', 'ホーム'); ?>

<h1>いまなにしてる？</h1>

<p><?php echo $this->Form->create('Post'); ?>
<?php echo $this->Form->input('tweet', array(
		'type' => 'textarea',
		'rows' => '3',
		'label' => ''
)); ?>
<?php echo $this->Form->end('投稿する'); ?></p>
<p>最新のつぶやき： <?php if(isset($latest_post['Post']['tweet'])): ?>
	<?php echo $this->Text->autoLink(nl2br(h($latest_post['Post']['tweet'])), array(
	'target' => '_blank',
	'escape' => false
)); ?>
<?php echo "<br/>" . h($latest_post['Post']['created']); ?></p>
<?php endif; ?>

<h1>ホーム</h1>
<p><?php //print_r($users); ?></p>
<p><?php //print_r($my_users); ?></p>
<hr>

<?php foreach($posts as $post): ?>
	<?php /* echo $this->Form->postlink(
		h($post['User']['username']),
		array(
			'action' => 'post',
			$post['User']['id']
		)); */ ?>
	<?php $userid = $post['User']['id']; ?>
	<?php echo "<a href='post/$userid'> " . h($post['User']['username']) . "</a>"; ?>
	<?php echo $this->Text->autoLink(nl2br(h($post['Post']['tweet'])), array(
		'target' => '_blank',
		'escape' => false
	)); ?>
	<?php if($post['Post']['user_id'] == $user['id']): ?>
		<?php echo $this->Form->postLink(
			'Delete',
			array(
				'action' => 'delete',
				$post['Post']['user_id']
			),
			array(
				'confirm' => 'このツイートを削除しますか？ 取り消しはできません！'
			)
		);
		?>
	<?php endif; ?>
	<?php echo "<br/>" . h($post["Post"]["created"]); ?>
	<hr>
<?php endforeach; ?>
<?php unset($post); ?>

<p><?php
  echo $this->Paginator->first('<< 前へ');
  echo $this->Paginator->last('次へ >>');
?></p>
