<?php
App::uses('AppModel', 'Model');

class Post extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);

	//入力チェック機能
	public $validate = array(
		'tweet' => array(
			array(
				'rule' => 'notBlank',	//必須
				'message' => 'つぶやきを入力してください。'
			),
			array(
				'rule' => array('between', 0, 140),	//文字数
				'message' => '140文字以内で入力してください。※半角、全角問わず'
			)
		)
	);
}
?>
