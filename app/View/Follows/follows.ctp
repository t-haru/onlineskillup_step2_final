<?php $this->assign('title', 'フォロー者一覧'); ?>

<h1><?php echo h($user['username']) . "：" .  $number_of_follow ?>人をフォローしています。</h1>

<p><?php //print_r($follow_users_id); ?></p>
<p><?php //print_r($follows); ?></p>
<p><?php //print_r($follow_users); ?></p>
<p><?php //print_r($latest_post); ?></p>
<p><?php //echo $this->element('sql_dump'); ?></p>

<?php if(count($follow_users)): ?>
	<?php foreach($follow_users as $follow_user): ?>
		<?php
		$follow_user_id = $follow_user['User']['id'];
		$my_usr_id = $user['id'];
		?>
		<?php //echo $user_id; ?>
		<?php echo $follow_user['User']['username'] . " " . $follow_user['User']['name']; ?>
		<?php echo $this->Form->postLink(
			'フォローを解除',
			array(
				'action' => 'unfollowUser',
				$my_usr_id, $follow_user_id, 'follow', 'search'
			),
			array(
				'confirm' => 'フォローを解除しますか？ 取り消しはできません！'
			)
		);
		?>
		<br>
		<?php if(isset($latest_post[$follow_user_id]['Post']['tweet'])): ?>
			<?php //echo $latest_post[$follow_user_id]['Post']['tweet']; ?>
			<?php  echo $this->Text->autoLink(nl2br(h($latest_post[$follow_user_id]['Post']['tweet'])), array(
			'target' => '_blank',
			'escape' => false
		)); ?>
			<br>
			<?php echo h($latest_post[$follow_user_id]['Post']['created']); ?>
		<?php endif; ?>
		<hr>
	<?php endforeach; ?>
	<?php unset($follow_user); ?>
<?php else: ?>
	<p>誰もフォローしていません。</p>
<?php endif; ?>

<p><?php
  echo $this->Paginator->first('<< 前へ');
  echo $this->Paginator->last('次へ >>');
?></p>


<?php /*if(count($follow_users)): ?>
	<?php foreach($follow_users as $follow_user): ?>
		<?php echo $follow_user['User']['username']."<br/>"; ?>
	<?php endforeach; ?>
	<?php unset($follow_user); ?>
<?php else: ?>
	<p>誰もフォローしていません。</p>
<?php endif; */ ?>
