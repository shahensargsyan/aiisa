<?php
$custom = (isset($customCount)&&$customCount) ? $customCount : 10;

if ($this->action == 'topicView')    {
    $custom = 20;
}
?>
<div class="item-list-pager">
    <ul class="pager">
         
        <?php if($this->Paginator->counter(array('format' => '%count% ')) > $custom){ ?>
        <li class="last">
            <?php echo $this->Paginator->prev(__('Prev'), array(), null, array('class' => 'prev unactivePrev')); ?>
        </li>
        <?php echo $this->Paginator->numbers(array('class' => '', 'separator' => '', 'tag' => 'li',)); ?>
        <li class="next">
            <?php echo $this->Paginator->next(__('Next'), array(), null, array('class' => 'next unactiveNext')); ?>
        </li>
        <?php } ?>
    </ul>
</div>