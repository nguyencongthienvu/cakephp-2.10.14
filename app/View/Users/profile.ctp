<h1 style="text-align:center;">User Name: <?php echo $user_profile['User']['username']; ?></h1>
<h1 style="text-align:center;">Role: <?php 
    if ($user_profile['User']['role'] === "1") {
        echo "Admin";
    }
?></h1>
<div class="contain-image">
    <img class="image" src= <?php echo $user_profile['User']['picture_url']; ?> alt="CakePHP" />
</div>
