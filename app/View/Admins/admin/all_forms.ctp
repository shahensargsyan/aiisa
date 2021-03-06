<div class="span8 margauto">
<div class="titleBox">
    <?php echo $this->Html->link('Add Form input name', 
            array(
                'controller' => 'admins',
                'action' => 'add_form_id'
            ), 
            array('class' => 'btn')); 
    ?>
</div>
<?php if(!empty($data)){?>
    <div class="container">
        <table class="span8 left0 table table-bordered table-striped allContractsTbl floatNone">
            <thead>
            <tr>
                <th style="width: 40%">Form input name</th>                
                <th style="width: 20%"></th>     
                <th style="width: 20%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $form){
                ?>
                <tr>
                    <td><?php echo $form['FormId']['form_id']; ?> </td>                          
                    <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'edit_form', $form['FormId']['id']), array('class' => 'btn btn-success')); ?></td>
                    <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'delete', $form['FormId']['id'],'FormId'), array('class' => 'btn btn-danger'),array('Are you sure you want to delete?')); ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table> 
    <?php
    $count = $this->Paginator->params();
    if($count['pageCount'] > '1'){
        ?>
        <div class="pagination">
            <ul>
                <li class="disabled"><?php echo $this->Paginator->prev('Prev', null, null); ?></li>
                <li><?php echo $this->Paginator->numbers(array("separator" => false)); ?></li>
                <li ><?php echo $this->Paginator->next('Next', null, null); ?></li>
            </ul>
        </div>  
    <?php } ?>  
    </div>
<?php }else{ ?>
    <p><?php echo 'There is no Form'; ?></p>
<?php }?>
</div>

