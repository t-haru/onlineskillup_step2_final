<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {

	public function index() {
		$userid = $this->Session->read('Auth.User.id');

		$this->layout = 'user';

//		$this->Session->write('userid', '1');
		$tweet = $this->request->data('Post.tweet');

		if($this->request->is('post') && $this->Post->save($this->request->data)) {
			$this->_addPost($userid, $tweet);
			$this->redirect('index');
		}

		$this->_showLatestPost($userid);

		$follow_user_id = $this->_showFollowUsersId($userid);
		$follow_user = $this->_showFollowUsers($follow_user_id);
		$follow_users = array_column($follow_user, 'User');
//		$this->set('users', $users);
		if(count($follow_users)) {
			$my_users = array_column($follow_users, 'id');
		} else {
			$my_users = array();
		}
		$my_users[] = $this->Session->read('Auth.User.id');
//		$this->set('my_users', $my_users);
		$posts = $this->_showPosts($my_users);
		$this->set('posts', $posts);
	}

	public function post($userid) {
		$this->layout = 'user';
		$posts = $this->_showPosts($userid);
		if($posts == array()) {
			$this->_showUserName($userid);
		} else {
			$this->set('posts', $posts);
		}
	}

	public function _addPost($userid, $tweet) {
		$data = array(
			'Post' => array('user_id' => $userid, 'tweet' => $tweet)
		);
		$field = array('user_id', 'tweet');
		$this->Post->save($data, $field);
	}

	public function _showLatestPost($userid) {
		$option = array(
			'fields' => array('tweet', 'created'),
			'conditions' => array('user_id' => $userid),
			'order' => array('created' => 'DESC'),
		);
		$this->set('latest_post', $this->Post->find('first', $option));
	}

	public function _showPosts($userid) {
		$paginate = array(
			'fields' => array('User.id', 'User.username', 'Post.user_id', 'Post.tweet', 'Post.created'),
			'conditions' => array('Post.user_id' => $userid),
			'order' => array('Post.created' => 'DESC'),
			'limit' => '10'
		);
		$this->Paginator->settings = $paginate;
		$posts = $this->Paginator->paginate('Post');
		return $posts;
	}

	public function _showUserName($userid) {
		$this->loadModel('User');
		$option = array(
			'fields' => array('User.username'),
			'conditions' => array('user.id' => $userid),
		);
		$this->set('posts', $this->User->find('all', $option));
	}

	public function delete($id) {
		if($this->Post->delete($id)) {
		}
		return $this->redirect('index');
	}

	public function _showFollowUsersId($userid=0) {
		//フォローしているユーザーのIDを取得
		if($userid > 0) {
			$this->loadModel('Follow');
			$option = array(
				'fields' => array('Follow.user_id', 'Follow.follower_id'),
				'conditions' => array('Follow.user_id' => $userid)
			);
			$follow = $this->Follow->find('all', $option);
			$follow_users_id = array_column(array_column($follow, 'Follow'), 'follower_id');
			return $follow_users_id;
		} else {
			return array();
		}
	}

	public function _showFollowUsers($follow_users_id) {
		$this->loadModel('User');
		//フォローしているユーザーを取得
		$option = array(
			'fields' => array('User.id', 'User.name', 'User.username'),
			'conditions' => array('User.id' => $follow_users_id),
			'order' => array('User.username' => 'ASC'),
		);
		$follow_users = $this->User->find('all', $option);
		return $follow_users;
	}

}
?>
