 <div>
     <?php
        echo $this->Form->create('Publication', array(
            'url' => array_merge(array('action' => 'index'), $this->params['pass'])
            ));
        echo $this->Form->input('name', array('div' => false, 'empty' => true)); // empty creates blank option.
                echo $this->Form->input('pr_status', array('label' => 'Status'));
        echo $this->Form->submit(__('Search', true), array('div' => false));
        echo $this->Form->end();
    ?>
</div>