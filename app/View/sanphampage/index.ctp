<h1>Blog posts</h1>
<h1><?php echo $this->Html->link("Them san pham",array('controller' => 'sanphampage','action'=>'themsanpham'))?></h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Other</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php 
    $i = 1;
    foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td>
            <?php echo $this->Html->link($post['sanphampage']['title'],
array('controller' => 'sanphampage', 'action' => 'detail', $post['sanphampage']['id'])); ?>
        </td>
        <td><?php echo $post['sanphampage']['price']; ?></td>
        <td><?php echo $post['sanphampage']['image']; ?></td>
        <td><?php echo $post['sanphampage']['created']; ?></td>
        <td><?php echo $post['sanphampage']['modified']; ?></td>
        <td><?php
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $post['sanphampage']['id'])
                );
            ?>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete',$post['sanphampage']['title'],$post['sanphampage']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>