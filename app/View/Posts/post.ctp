<?php $this->assign('title', 'つぶやき'); ?>

<h1><?php echo $posts[0]['User']['username']; ?>のつぶやき</h1>
<hr>

<p><?php //print_r($posts); ?></p>

<?php if(isset($posts[0]['User']['id'])): ?>
	<?php foreach($posts as $post): ?>
		<?php echo $this->Text->autoLink(nl2br(h($post['Post']['tweet'])), array(
			'target' => '_blank',
			'escape' => false
		)); ?>
		<?php echo "<br/>" . h($post["Post"]["created"]); ?>
		<hr>
	<?php endforeach; ?>
	<?php unset($posts); ?>
<?php else: ?>
	<p>つぶやきはありません。</p>
<?php endif; ?>

<p><?php
  echo $this->Paginator->first('<< 前へ');
  echo $this->Paginator->last('次へ >>');
?></p>
