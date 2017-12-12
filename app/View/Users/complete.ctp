<?php $this->assign('title', 'ユーザー登録完了'); ?>
<h1>ついったーに参加しました</h1>
<p><?php echo h($user); ?>さんはついったーに参加されました。<p/>
<p>ログインをクリックしてつぶやいてください。</p>

<button onclick="location.href='<?php echo $this->html->url('/users/login');?>';">ついったーにログイン</button>
