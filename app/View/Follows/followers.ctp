<?php $this->assign('title', '被フォロー者一覧'); ?>

<h1><?php echo $user['username'] . "：" .  $number_of_follower ?>人からフォローされています。</h1>

<p><?php //print_r($followed_users_id); ?></p>
<p><?php //print_r($followers); ?></p>
<p><?php //print_r($followed_users); ?></p>
<p><?php //echo $this->element('sql_dump'); ?></p>

<?php if(count($followed_users)): ?>
	<?php foreach($followed_users as $followed_user): ?>
		<?php
		$followed_user_id = $followed_user['User']['id']; $my_user_id = $user['id'];
		?>
		<?php echo $followed_user['User']['username'] . " " . $followed_user['User']['name']; ?>
		<?php if(in_array($followed_user_id, $follows)): ?>
			<?php echo $this->Form->postLink(
				'フォローを解除',
				array(
					'action' => 'unfollowUser',
					$my_user_id, $followed_user_id, 'follower', 'search'
				),
				array(
					'confirm' => 'フォローを解除しますか？ 取り消しはできません！'
				)
			); ?>
		<?php else: ?>
			<?php echo $this->Form->postlink(
				'フォローに追加',
				array(
					'action' => 'followUser',
					$my_user_id, $followed_user_id, 'follower', 'search'
				),
				array(
					'confirm' => 'フォローに追加しますか？'
				)
			); ?>
		<?php endif;?>
		<br>
		<?php if(isset($latest_post[$followed_user_id]['Post']['tweet'])): ?>
			<?php echo $latest_post[$followed_user_id]['Post']['tweet']; ?>
			<br>
			<?php echo $latest_post[$followed_user_id]['Post']['created']; ?>
		<?php endif; ?>
		<hr>
	<?php endforeach; ?>
	<?php unset($followed_user); ?>
<?php else: ?>
	<p>誰からもフォローされていません。</p>
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
