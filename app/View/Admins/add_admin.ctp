<h1>Add Admin</h1>
<?php
echo $this->Form->create('Admin');
echo $this->Form->input('first_name');
echo $this->Form->input('last_name');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Save Admin');
?>