<h1 style="text-align:center">Hot Item</h1>

<div class="item-content">
<div class="card">
<?php foreach ($posts_home as $post): ?>
  <div class="card-child">
    <img src="app/webroot/img/default.png" alt="Denim Jeans" style="width:100%">
    <h1><?php echo $post['sanphampage']['title']; ?></h1>
    <p class="price"><?php echo $post['sanphampage']['price']; ?> VND</p>
    <p style="min-height:70px;"><?php echo substr($post['sanphampage']['body'],0,233); ?></p>
    <p><?php
            echo $this->Html->link($this->Form->button('Detail'), array('controller' => 'sanphampage','action'=> 'detail',$post['sanphampage']['id']), array('escape'=>false,'title' => "Click to view somethin"))
    ?></p>
  </div>
  <?php endforeach; ?>
  <?php unset($post); ?>
</div>
</div>