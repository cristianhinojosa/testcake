<?php
echo $this->Form->create('Post', array(
    'url' => array_merge(array('action' => 'find'), $this->params['pass'])
));
echo $this->Form->input('title', array('div' => false));
#echo $this->Form->input('blog_id', array('div' => false, 'options' => $blogs));
#echo $this->Form->input('status', array('div' => false, 'multiple' => 'checkbox', 'options' => array('open', 'closed')));
#echo $this->Form->input('username', array('div' => false));
echo $this->Form->submit(__('Search'), array('div' => false));
echo $this->Form->end();
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
