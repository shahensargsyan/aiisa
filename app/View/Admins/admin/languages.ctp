<div class="titleBox">
    <?php
    echo $this->Html->link('Add Language', array(
        'controller' => 'admins',
        'action' => 'add_language'
            ), array('class' => 'btn pull-right'));
    ?>
</div>
<div class="container">
    <h3 class="text-center"></h3>
    <?php if(!empty($data)){ ?>
        <table class="top50 table table-bordered table-striped">
            <tr>
                <th>Language</th>                
                <th>Language code</th>                              
                <th>Modified</th>
                <th>Created</th>
                <th>Status</th>
                <th>Activate/Deactivate</th>
                <th>Delete</th>
            </tr>
            <?php foreach($data as $value){ ?>
                <tr>
                    <td><?php echo $value['Language']['name']; ?></td>
                    <td><?php echo $value['Language']['lang_code']; ?></td>
                    <td><?php echo $value['Language']['created']; ?></td>
                    <td><?php echo $value['Language']['modified']; ?></td>
                    <td>
                        <?php
                        if($value['Language']['active'] == 1){
                            echo '<img src="/img/tick.png" />';
                        }else
                            echo '<img src="/img/cross.png" />';
                        ?>
                    </td>
                    <td>
                        <?php
                        if(!$value['Language']['active']):
                            echo $this->Html->link(
                                    'Activate', array(
                                'action' => 'activateLanguage',
                                $value['Language']['id'],
                                    ),
                                array('class' => 'btn btn-success'),
                                array('Are you sure you want to activate this language?')
                            );
                        else:
                            echo $this->Html->link(
                                    'Deactivate', array(
                                'action' => 'deactivateLanguage',
                                $value['Language']['id']
                                    ), 
                                    array('class' => 'btn btn-danger'),
                                    array('Are you sure you want to deactivate this language?')
                            );                                
                        endif;
                        ?>
                        <?php // echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'edit_language', $value['Language']['id']), array('class' => 'btn btn-primary')); ?>
                    </td>
                    <td><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'delete', $value['Language']['id'],'Language'), array('class' => 'btn btn-danger'),array('Are you sure you want to delete this language?')); ?></td>
                </tr>

            <?php } ?>
        </table>
        <?php
    }else{
        echo'There is no Language';
    }
    ?>

    <?php echo $this->Paginator->numbers(array('first' => 1, 'last' => 1)); ?>

    <?php ?>     
</div>
