<div class="users form">
<?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
<?php if($this->request->pass[0] !== 'password') { ?>
    <fieldset>
        <legend><?php echo __('Edit Profile'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('email');
        echo $this->Form->input('picture_url', array('type'=>'file'));
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
    <?php if(substr($user_profile['User']['picture_url'], 0,5) !== "https") { ?>
    <img class="imageReponsive" src= '../../../<?php echo $user_profile['User']['picture_url']; ?>' alt="CakePHP" />
    <?php } else { ?>
    <img class="imageReponsive" src= <?php echo $user_profile['User']['picture_url']; ?> alt="CakePHP" />   
    <?php } ?>
</div>
<?php } ?>
