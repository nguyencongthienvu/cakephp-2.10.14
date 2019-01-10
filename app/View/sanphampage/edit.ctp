<h1>Edit Post</h1>
<?php
echo $this->Form->create('sanphampage');
echo $this->Form->input('title');
echo $this->Form->input('price');
echo $this->Form->input('body', array('rows' => '3','maxlength'=>'233'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>