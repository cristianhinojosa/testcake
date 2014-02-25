<!-- app/View/Users/add.ctp -->
<div class="users form">

<?php $role = "usuario"; ?>

<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
       /* echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));*/

		echo $this->Form->hidden('role', array('value' => $role));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
