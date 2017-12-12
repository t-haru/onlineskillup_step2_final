<?php
App::uses('AppController', 'Controller');

class FollowsController extends AppController {

	public function follows() {

//		$this->Session->write('userid', '1');
		$userid = $this->Session->read('Auth.User.id');

		$this->_countFollowUsers($userid);

		//$this->_showUsers();

		$follow_users_id = $this->_showFollowUsersId($userid);
		$this->set('follow_users_id', $follow_users_id);

		$follow_users = $this->_showFollowUsers($follow_users_id);
		$this->set('follow_users', $follow_users);

		$follows = array_column(array_column($follow_users, 'User'), 'id');
		$this->set('follows', $follows);

		$latest_post = array();
		foreach ($follows as $follow) {
			$latest_post += array($follow => $this->_showLatestPost($follow));
		}
		$this->set('latest_post', $latest_post);
	}

	public function followers() {

		$userid = $this->Session->read('Auth.User.id');

		$this->_countFollowedUsers($userid);

		$followed_users_id = $this->_showFollowedUsersId($userid);
		$this->set('followed_users_id', $followed_users_id);

		$followed_users = $this->_showFollowedUsers($followed_users_id);
		$this->set('followed_users', $followed_users);

		$followers = array_column(array_column($followed_users, 'User'), 'id');
		$this->set('followers', $followers);

		$follow_users_id = $this->_showFollowUsersId($userid);

		$follow_users = $this->_showFollowUsers($follow_users_id);

		$follows = array_column(array_column($follow_users, 'User'), 'id');
		$this->set('follows', $follows);

		$latest_post = array();
		foreach ($followers as $follower) {
			$latest_post += array($follower => $this->_showLatestPost($follower));
		}
		$this->set('latest_post', $latest_post);
	}

	public function search() {
		if($this->request->is('post')) {
				$search = $this->request->data['Follow']['search'];
				$this->redirect(array('action' => '/result', $search));
		}
	}

	public function result($search=null) {
		if($this->request->is('post')) {
			$search = $this->request->data['Follow']['search'];
			$this->redirect(array('action' => '/result', $search));
		}
		$this->set('search', $search);
		$this->loadModel('User');
		$paginate = array(
			'fields' => array(
				'User.id', 'User.name', 'User.username'
			),
			'conditions' => array(
				'User.username LIKE' => '%'.$search.'%',
				'OR' => array(
					'User.name LIKE' => '%'.$search.'%'
				)
			),
			'order' => array(
				'User.created' => 'DESC'
			),
			'limit' => '10'
		);
		$this->Paginator->settings = $paginate;
		$users = $this->Paginator->paginate('User');
		$this->set('users', $users);

		$myuserid = $this->Session->read('Auth.User.id');
		$this->set('myuserid', $myuserid);

		$latest_post = array();
		foreach ($users as $user) {
			$latest_post += array($user['User']['id'] => $this->_showLatestPost($user['User']['id']));
		}
		$this->set('latest_post', $latest_post);

		$follow_users_id = $this->_showFollowUsersId($myuserid);
		$this->set('follow_users_id', $follow_users_id);
	}

	public function _checkCount($first, $second) {
		$option = array(
			'conditions' => array('user_id' => $first, 'follower_id' => $second)
		);
		$count = $this->Follow->find('count', $option);
		return $count;
	}

	public function followUser($me, $them, $stat, $search=null) {
		$count = $this->_checkCount($me, $them);

		if($count == 0) {
			$data = array(
				'Follow' => array('user_id' => $me, 'follower_id' => $them)
			);
			$field = array('user_id', 'follower_id');
			$this->Follow->save($data, $field);
		}
		$this->_stat($stat, $search);
	}

	public function unfollowUser($me, $them, $stat, $search) {
		$count = $this->_checkCount($me, $them);

		if($count != 0) {
			$conditions = array(
				'user_id' => $me,
				'follower_id' => $them
			);
			$this->Follow->deleteAll($conditions);
		}
		$this->_stat($stat, $search);
	}

	public function _stat($stat, $search) {
		if($stat == 'follow') {
			$this->redirect(array('action' => '/follows'));
		}
		elseif($stat == 'follower') {
			$this->redirect(array('action' => '/followers'));
		}
		elseif($stat == 'result') {
			$this->redirect(array('action' => '/result', $search));
		}
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
		$paginate = array(
			'fields' => array('User.id', 'User.name', 'User.username'),
			'conditions' => array('User.id' => $follow_users_id),
			'order' => array('User.username' => 'ASC'),
			'limit' => '10'
		);
		$this->Paginator->settings = $paginate;
		$follow_users = $this->Paginator->paginate('User');
		return $follow_users;
	}

	public function _countFollowUsers($userid) {
		$option = array(
			'conditions' => array('user_id' => $userid)
		);
		$number_of_follow = $this->Follow->find('count', $option);
		$this->set('number_of_follow', $number_of_follow);
	}

	public function _countFollowedUsers($userid) {
		$option = array(
			'conditions' => array('follower_id' => $userid)
		);
		$number_of_follower = $this->Follow->find('count', $option);
		$this->set('number_of_follower', $number_of_follower);
	}

	public function _showFollowedUsersId($userid=0) {
		//フォローされているユーザーのIDを取得
		if($userid > 0) {
			$option = array(
				'fields' => array('user_id', 'follower_id'),
				'conditions' => array('follower_id' => $userid)
			);
			$followed = $this->Follow->find('all', $option);
		$followed_users_id = array_column(array_column($followed, 'Follow'), 'user_id');
			return $followed_users_id;
		} else {
			return array();
		}
	}

	public function _showFollowedUsers($followed_users_id) {
		$this->loadModel('User');
		//フォローされているユーザーを取得
		$paginate = array(
			'fields' => array('User.id', 'User.name', 'User.username'),
			'conditions' => array('User.id' => $followed_users_id),
			'order' => array('User.username' => 'ASC'),
			'limit' => '10'
		);
		$this->Paginator->settings = $paginate;
		$followed_users = $this->Paginator->paginate('User');
		return $followed_users;
	}

	public function _showLatestPost($userid) {
		$this->loadModel('Post');
		$option = array(
			'fields' => array('Post.tweet', 'Post.created'),
			'conditions' => array('Post.user_id' => $userid),
			'order' => array('Post.created' => 'DESC'),
		);
		$latest_post = $this->Post->find('first', $option);
		return $latest_post;
	}

}

?>
