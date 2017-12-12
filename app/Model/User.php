<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
	//入力チェック機能
	public $validate = array(
		'name' => array(
			array(
				'rule' => 'notBlank',	//必須
				'message' => '名前を入力してください。'
			)
		),
		'username' => array(
			array(
				'rule' => 'notBlank',	//必須
				'message' => 'ユーザー名を入力してください。'
			),
			array(
				'rule' => 'isUnique',	//ユーザーチェック
				'message' => '入力したユーザーはすでに存在しています。'
			),
			array(
				'rule' => '/^[0-9a-zA-Z_\-]{1,20}$/',	//文字種
				'message' => 'ユーザー名は半角英数字または「_」、「-」で入力してください。',
				'last' => false
			),
			array(
				'rule' => array('between', 4, 20),	//文字数
				'message' => 'ユーザー名は4文字以上20文字以内で入力してください。'
			)
		),
		'password' => array(
			array(
				'rule' => 'notBlank',	//必須
				'message' => 'パスワードを入力してください。'
			),
			array(
				'rule' => 'alphaNumeric',	//文字種
				'message' => 'パスワードは半角英数字で入力してください。',
				'last' => false
			),
			array(
				'rule' => array('between', 4, 8),	//文字数
				'message' => 'パスワードは4文字以上8文字以内にしてください。'
			)
		),
		'email' => array(
			array(
				'rule' => 'notBlank',	//必須
				'message' => 'メールアドレスを入力してください。'
			),
			array(
			'rule' => 'email',	//メール確認
			'message' => '入力したメールアドレスに間違いがあります。'
			)
		)
	);

	public function beforeSave($options = array()) {
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}
}
?>
