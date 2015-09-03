<?php
/**
 *	AJAX with JS Script
 **/
echo $this->fetch('script');
echo $this->Html->script(array('jquery.min'));
/*echo $this->Html->script('jplayer/jquery.jplayer.min');
echo $this->Html->script('jquery.countdown');
echo $this->Html->script('custom');
echo $this->Html->script(array('timer/jquery.timer'));*/
echo $this->Html->script(array('jquery-jvectormap-1', 'jquery-jvectormap-world-mill-en'));
echo $this->Html->css(array('jquery-jvectormap-1'));

echo $this->fetch('content'); 
?>
