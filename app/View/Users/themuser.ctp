<div class="users form">
<h1 class="menuPage">
<?php echo $this->Html->link("Back", array('controller' => 'Users', 'action' => 'Back')) ?>
</h1>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('email');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('1' => 'Admin', '0' => 'Author')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>