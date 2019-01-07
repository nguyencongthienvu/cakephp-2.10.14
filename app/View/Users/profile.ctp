<h1 style="text-align:center;">User Name: <?php echo $user_profile['User']['username']; ?></h1>
<h1 style="text-align:center;">Role: <?php 
    if ($user_profile['User']['role'] === "1") {
        echo "Admin";
    }
?></h1>
<div class="contain-image">
    <img class="image" src= <?php echo $user_profile['User']['picture_url']; ?> alt="CakePHP" />
</div>
<input class="resizeButton" type="button" title="Click to Deactivate" value="Edit Profile" onClick="javascipt:window.location.href='<?php echo $this->Html->url(array('controller'=>'users','action'=>'myfunc')) ?>'" >
