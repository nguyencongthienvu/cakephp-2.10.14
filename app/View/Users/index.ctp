<h1>Trang User</h1>
<h1 class="menuPage"><?php echo $this->Html->link("Them User", array('controller' => 'Users', 'action' => 'themuser')) ?>
<?php echo $this->Html->link("Back", array('controller' => 'Users', 'action' => 'Back')) ?>
</h1>
<table>
    <tr>
        <th>STT</th>
        <th>Username</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Modified At</th>
        <th>Other</th>
    </tr>

    <?php 
    $i = 1;
    foreach ($users as $user): ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['username'],
array('controller' => 'users', 'action' => 'detail', $user['User']['id'])); ?>
        </td>
        <td><?php echo $user['User']['role']; ?></td>
        <td><?php echo $user['User']['created']; ?></td>
        <td><?php echo $user['User']['modified']; ?></td>
        <td><?php
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $user['User']['id'])
                );
            ?>
            <?php
             if ($this->Session->read('Auth.User.role') != "0" && $user['User']['role'] === '0') {
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete',$user['User']['username'],$user['User']['id']),
                    array('confirm' => 'Are you sure?')
                );
            }
            ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>
<?php
$paginator = $this->Paginator;
 echo "<div class='paging'>";
 
 // the 'first' page button
 echo $paginator->first("First");
  
 // 'prev' page button, 
 // we can check using the paginator hasPrev() method if there's a previous page
 // save with the 'next' page button
 if($paginator->hasPrev()){
     echo $paginator->prev("Prev");
 }
  
 // the 'number' page buttons
 echo $paginator->numbers(array('modulus' => 2));
  
 // for the 'next' button
 if($paginator->hasNext()){
     echo $paginator->next("Next");
 }
  
 // the 'last' page button
 echo $paginator->last("Last");

echo "</div>";
?>