<?php

echo $this->Html->script('jquery'); 
echo $this->Html->script('bootstrap.js'); 
echo $this->Html->css('bootstrap.css'); 
	?>






<h1>Blog posts</h1>
<p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?></p>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>



    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
            ?>
        </td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $post['Post']['id'])
                );
            ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>


<?php //echo  $this->Paginator->numbers(); ?>


<?php 

    if ($this->Paginator->hasPage(null, 2)) { 
    echo '<tfoot>';
    echo '<tr>';
    echo '<td colspan="7" class="text-right">';
    echo '  <ul class="pagination pagination-right">';
    echo $this->Paginator->first('<span class="glyphicon glyphicon-fast-backward"></span> First', array('escape' => false, 'tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
    echo $this->Paginator->prev('<span class="glyphicon glyphicon-step-backward"></span> Prev', array('escape' => false, 'tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
    echo $this->Paginator->numbers(array(
        'currentClass' => 'active',
        'currentTag' => 'a',
        'tag' => 'li',
        'separator' => '',
    ));
    echo $this->Paginator->next('Next <span class="glyphicon glyphicon-step-forward"></span>', array('escape' => false, 'tag' => 'li', 'currentClass' => 'disabled'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
    echo $this->Paginator->last('Last <span class="glyphicon glyphicon-fast-forward"></span>', array('escape' => false, 'tag' => 'li', 'currentClass' => 'disabled'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));

    echo '  </ul>';
    echo '<p>'.$this->Paginator->counter(array('format' => 'Page {:page} of {:pages}, showing {:current} records out of {:count} total.')).'</p>';
    echo '</td>';
    echo '</tr>';
    echo '</tfoot>';    
}

?>


<?php 
/*
echo $this->Paginator->pager(array(
	'prev' => '← Older',
	'next' => 'Newer →'
));

*/
 ?>


