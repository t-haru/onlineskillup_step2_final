<?php $this->assign('title', '検索結果'); ?>

<h2><b><?php echo $search; ?></b>の検索結果</h2>

<p><?php //print_r($users); ?></p>

<p><?php echo $this->Form->create('Follow'); ?>
<?php echo $this->Form->input('search' ,array(
	'label' => '',
	'default' => $search
)); ?>
<?php echo $this->Form->end('検索'); ?>
ユーザー名や名前で検索</p><hr>

<?php if (count($users)): ?>
	<?php foreach ($users as $user): ?>
		<?php $userid = $user['User']['id']; ?>
		<?php echo "<a href='/cakephp/posts/post/$userid'> " . h($user['User']['username']) . "</a>" . " " . $user['User']['name']; ?>
		<?php if($userid == $myuserid): ?>
		<?php elseif(in_array($userid, $follow_users_id)): ?>
		<?php else: ?>
			<?php echo $this->Form->postlink(
				'フォローに追加',
				array(
					'action' => 'followUser',
					$myuserid, $userid, 'result', $search
				),
				array(
					'confirm' => 'フォローに追加しますか？'
				)
			); ?>
		<?php endif;?>
		<br/>
		<?php if(isset($latest_post[$userid]['Post']['tweet'])): ?>
			<?php  echo $this->Text->autoLink(nl2br(h($latest_post[$userid]['Post']['tweet'])), array(
			'target' => '_blank',
			'escape' => false
		)); ?>
			<br>
			<?php echo h($latest_post[$userid]['Post']['created']); ?>
		<?php endif; ?>
		<hr>
	<?php endforeach; ?>
	<?php unset($users); ?>
<?php else: ?>
	<p><font color="RED">対象のユーザーはみつかりません。</font></p>
<?php endif; ?>

<p><?php
  echo $this->Paginator->first('<< 前へ');
  echo $this->Paginator->last('次へ >>');
?></p>
