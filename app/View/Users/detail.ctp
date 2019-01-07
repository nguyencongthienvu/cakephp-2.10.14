<h1><?php echo h($user['User']['username']); ?></h1>

<p><small>Role: 
    <?php if (isset($user) && $user['User']['role'] === '1') {
            echo 'Admin';
        } else {
            echo 'Author';
        }
    ?>
    </small></p>

<p><?php echo h($user['User']['created']); ?></p>