<?php
class Post extends AppModel {
var $actsAs = array('Search.Searchable');

public function isOwnedBy($post, $user) {
    return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
}





public $filterArgs = array(
    	'title' => array('type' => 'like'),
	 'body' => array('type' => 'like'),
#'search'=> array('type' => 'like', 'encode' => true, 'before' => false, 'after' => false, 'field' => array('ThisModel.name', 'OtherModel.name')),
    
#'name'=> array('type' => 'query', 'method' => 'searchNameCondition')
);



/*
public function searchNameCondition($data = array()) {
    $filter = $data['name'];
    echo $filter;
    $cond = array(
        'OR' => array(
            $this->alias . '.name LIKE' => '' . $this->formatLike($filter) . '',
            $this->alias . '.invoice_number LIKE' => '' . $this->formatLike($filter) . '',
    ));
    return $cond;
}


*
*/


   public function orConditions($data = array()) {
        $filter = $data['filter'];
        $cond = array(
            'OR' => array(
                $this->alias . '.title LIKE' => '%' . $filter . '%',
                $this->alias . '.body LIKE' => '%' . $filter . '%',
            ));
        return $cond;
    }
}




?>
