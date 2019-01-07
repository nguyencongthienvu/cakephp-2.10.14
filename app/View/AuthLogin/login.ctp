<div class="users form">
<?php echo $this->Session->flash("authlogin"); ?>
<?php echo $this->Form->create('AuthLogin'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<div>
<?php
$config = Configure::read('Facebook_Login');
$fb = new Facebook\Facebook([
  'app_id' => $config['app-id'],
  'app_secret' => $config['secrect'],
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl($config['default-link'], $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    ?>