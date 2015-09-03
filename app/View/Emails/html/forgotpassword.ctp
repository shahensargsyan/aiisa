Hello, <?php echo $contentForEmail['User']['first_name'] . '   ' . $contentForEmail['User']['last_name']; ?>!
Did you forget your password? No worries! 
Click on this <a href="<?php
echo $this->Html->url(
        array('controller' => 'users', 'action' => 'passwordRecovery', $contentForEmail['User']['token']), true);
?>">link</a> to reset your password.