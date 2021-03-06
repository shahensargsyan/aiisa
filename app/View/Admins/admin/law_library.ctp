<div class="titleBox">
    <?php echo $this->Html->link('Add Library', 
            array(
                'controller' => 'admins',
                'action' => 'add_library'
            ), 
            array('class' => 'btn pull-right')); 
    ?>
</div>
<?php if(!empty($data)){?>
 <table class="allContractsTbl table table-bordered table-striped">
     <thead>
    <tr>
        <th style="width: 30%">Title</th>                
        <th style="width: 10%">File</th>
        <th style="width: 10%"></th>
        <th style="width: 10%"></th>
   </tr>
   </thead>
   <tbody>
   <?php foreach ($data as $library){ ?>
   <tr>
        <td><?php echo $library['Librarie']['title'];?></td>
        <td class="text-center"><?php echo $this->Html->link('View',array('controller'=>'/system/library/','action'=>$library['Librarie']['lib_file']),array('target' => '_blank', 'class' => 'btn'));?></td>
        <td class="text-center"><?php echo $this->Html->link('Edit',array('controller'=>'admins','action'=>'edit_library',$library['Librarie']['id']),array('class'=>'btn btn-success'));?></td>
        <td class="text-center"><?php echo $this->Html->link('Delete',array('controller'=>'admins','action'=>'delete_library',$library['Librarie']['id']),array('class'=>'btn btn-danger'),array('Are you sure you want to delete this library?'));?></td>
   </tr>
    <?php }?>
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
<?php }else{?>
    <p class="text-center">Law library not exist</p>
<?php } ?>


     