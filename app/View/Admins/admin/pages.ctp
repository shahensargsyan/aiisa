<div class="titleBox">
    <?php echo $this->Html->link('Relocate Pages',array('controller'=>'admins','action'=>'change_position'), array('class' => 'btn btn-primary pull-left'));?>
    <?php echo $this->Html->link('Add New Page', 
            array(
                'controller' => 'admins',
                'action' => 'newPage'
            ), 
            array('class' => 'btn pull-right')); 
    ?>
</div>
<div class="container">
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 30%">Name</th>                               
                <th style="width: 20%">Navigation</th>
                <th style="width: 10%"></th>     
                <th style="width: 10%"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $footer){
            ?>
            <tr deleteId="<?php echo $footer['Footer']['id']; ?>">
                <td><?php echo $footer['Footer']['name']; ?> </td>
                <td><?php echo $footer['Footer']['navigation']; ?></td>
                <td class="text-center">
                    
                    <?php if($footer['Footer']['type'] == 'dynamic' or $footer['Footer']['name'] == 'Help'or $footer['Footer']['name'] == 'Contact Us'){?>
                        <?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'edit_page', $footer['Footer']['id']), array('class' => 'btn btn-success')); ?>
                    <?php }?>    
                </td>
                <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'delete', $footer['Footer']['id'],'Footer'), array('class' => 'btn btn-danger'),array('Are you sure you want to delete this page?')); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
    There is no Page
    <?php
}
?>    
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