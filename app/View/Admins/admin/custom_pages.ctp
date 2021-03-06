<div class="titleBox">
    <h3 class="pull-left">Custom Pages</h3>
    <div class="pull-right">
        <?php echo $this->Html->link('Add Custom Page', array('controller' => 'admins', 'action' => 'addCustomPage'), array('class' => 'btn')); ?></h3>
    </div>
</div>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 20%">Title</th> 
                <th style="width: 20%">Active</th> 
                <th style="width: 20%">Link</th> 
                <th style="width: 25%">Edit</th>
                <th style="width: 15%">Delete</th>
            </tr> 
        </thead>
        <tbody>
        <?php
        foreach($data as $page){
            ?>
            <tr>
                <td><?php echo $page['CustomPage']['title'];?></td>
                <td><?php echo ($page['CustomPage']['active'])?'Yes':'No'; ?></td>
                <td><?php echo FULL_BASE_URL_MINE . 'contents/' . $page['CustomPage']['url']; ?></td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editCustomPage', $page['CustomPage']['id']), array('class' => 'btn btn-danger')); ?></td>
                <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'deleteCustomPage', $page['CustomPage']['id']), array('class' => 'btn btn-danger'),array('Are you sure you want to delete this page')); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
   <p class="text-center">No Custom Pages created</p>
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
