<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	//どのアクションが呼ばれてもはじめに実行される関数
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index', 'logout');
	}

	//ログイン後にリダイレクトされるアクション
	public function index() {
		$this->set('user', $this->Auth->user());
		$this->redirect('/posts/index');
	}

	public function register() {
		if($this->request->is('post') && $this->User->save($this->request->data)) {
//			$this->Auth->login();
			$username = $this->request->data['User']['username'];
			$this->redirect(array('action' => 'complete', $username));
		}
	}

	public function complete($username) {
		if($this->Auth->login()) {
			$this->redirect('/posts/index');
		} else {
			$this->set('user', $username);
		}
	}

	public function login() {
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->redirect('index');
			} else {
				$this->Flash->set('ユーザー名、パスワードの組み合わせが違うようです。');
			}
		}
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect('login');
	}
}
?>
