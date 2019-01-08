<div class="users form">
<?php echo $this->Form->create('User'); ?>
<?php if($this->request->pass[0] !== 'password') { ?>
    <fieldset>
        <legend><?php echo __('Edit Profile'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('email');
    ?>
    </fieldset>
<?php } else { ?>
    <fieldset>
        <legend><?php echo __('Edit Password'); ?></legend>
        <?php echo $this->Form->input('current_password',array('type' => 'password')); ?>
        <?php echo $this->Form->input('password'); ?>
        <?php echo $this->Form->input('confirm_password',array('type' => 'password')); ?>
    </fieldset>
<?php } ?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php if($this->request->pass[0] !== 'password') { ?>
<div>
<img class="imageReponsive" src=<?php echo $user_profile['User']['picture_url']; ?> alt="CakePHP" />
</div>
<?php } ?>
