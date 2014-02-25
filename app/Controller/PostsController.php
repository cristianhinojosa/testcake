<?php 

class PostsController extends AppController {
    	public $helpers = array('Html', 'Form', 'Session', 'Paginator');
   	public $components = array('Session', 'Paginator', 'Search.Prg');
	public $uses = array('Post');

/*

public $presetVars = array(
    'id' => true,
    'search' => true,
    'body'=> array( // overriding/extending the model defaults
        'type' => 'value',
        'encode' => true
    ),
);

*/ 
    public $presetVars = true; // using the model configuration



	public function isAuthorized($user) {
	    // All registered users can add posts
	    if ($this->action === 'add') {
		return true;
	    }

	    // The owner of a post can edit and delete it
	    if (in_array($this->action, array('edit', 'delete'))) {
		$postId = $this->request->params['pass'][0];
		if ($this->Post->isOwnedBy($postId, $user['id'])) {
		    return true;
		}
	    }

	    return parent::isAuthorized($user);
	}


	public $paginate = array(
        'limit' => 10,
 	'maxLimit' => 10,
        'order' => array(
        'Post.created' => 'desc'
        )
    );


    public function index() {
		    //    $this->set('posts', $this->Post->find('all'));
	$this->Paginator->settings = $this->paginate;

    // similar to findAll(), but fetches paged results
    $data = $this->Paginator->paginate('Post');
    $this->set('posts', $data);
	
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
/*
    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }
*/


    public function add() {
    if ($this->request->is('post')) {
        //Added this line
        $this->request->data['Post']['user_id'] = $this->Auth->user('id');
        if ($this->Post->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been saved.'));
            return $this->redirect(array('action' => 'index'));
	        }
	    }

    }	

    public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $post = $this->Post->findById($id);
    if (!$post) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('post', 'put'))) {
        //$this->Post->id = $id;
	 $this->request->data['Post']['user_id'] = $this->Auth->user('id');        
	if ($this->Post->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}



    public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Post->delete($id)) {
	$this->request->data['Post']['user_id'] = $this->Auth->user('id');
        $this->Session->setFlash(
            __('The post with id: %s has been deleted.', h($id))
        );
        return $this->redirect(array('action' => 'index'));
    }
}




  public function find() {
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Post->parseCriteria($this->Prg->parsedParams());
        $this->set('posts', $this->Paginator->paginate());
    
}





}




?>
