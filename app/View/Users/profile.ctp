<h1 style="text-align:center;">User Name: <?php echo $user_profile['User']['username']; ?></h1>
<h1 style="text-align:center;">Role: <?php 
    if ($user_profile['User']['role'] === "1") {
        echo "Admin";
    }
?></h1>
<div class="contain-image">
    <?php if(substr($user_profile['User']['picture_url'], 0,5) !== "https") { ?>
    <img class="image" src= '../<?php echo $user_profile['User']['picture_url']; ?>' alt="CakePHP" />
    <?php } else { ?>
    <img class="image" src= <?php echo $user_profile['User']['picture_url']; ?> alt="CakePHP" />   
    <?php } ?>
</div>
<?php if (!isset($user_profile['User']['facebook_id'])) { ?>
    <input class="resizeButton" type="button" title="Click to Deactivate" value="Edit Password" onClick="javascipt:window.location.href='<?php echo $this->Html->url(array('controller'=>'users','action'=>'profile_edit','password',$user_profile['User']['id'])) ?>'" >
<?php } ?>
    <input class="resizeButton" type="button" title="Click to Deactivate" value="Edit Profile" onClick="javascipt:window.location.href='<?php echo $this->Html->url(array('controller'=>'users','action'=>'profile_edit','profile',$user_profile['User']['id'])) ?>'" >
