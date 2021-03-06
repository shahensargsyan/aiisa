<div class="titleBox">
    <?php echo $this->Html->link('Add Review', 
            array(
                'controller' => 'admins',
                'action' => 'add_review'
            ), 
            array('class' => 'btn pull-right')); 
    ?>
</div>
<?php if(!empty($data)){?>
 <table class="allContractsTbl table table-bordered table-striped">
     <thead>
    <tr>
        <th style="width: 15%">First Name</th>                
        <th style="width: 15%">Last Name</th>
        <!--<th style="width: 15%">Email</th>-->
        <th style="width: 35%">Review</th>
        <th style="width: 25%">Contract</th>
        <th style="width: 5%"></th>
        <th style="width: 5%"></th>
   </tr>
   </thead>
   <tbody>
   <?php foreach ($data as $review){ ?>
   <tr>
        <td><?php echo __($review['Review']['first_name']);?></td>
        <td><?php echo __($review['Review']['last_name']);?></td>
        <!--<td><?php echo __($review['Review']['email']);?></td>-->
        <td><?php echo __($review['Review']['review']);?></td>
        <td><?php echo __($review['Contract']['name']);?></td>
        <td class="text-center"><?php echo $this->Html->link('Edit',array('controller'=>'admins','action'=>'edit_review',$review['Review']['id']),array('class'=>'btn btn-success'));?></td>
        <td class="text-center"><?php echo $this->Html->link('Delete',array('controller'=>'admins','action'=>'delete',$review['Review']['id'],'Review'),array('class'=>'btn btn-danger'),array('Are you sure you want to delete this review?'));?></td>
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
    <p class="text-center">There is no Review</p>
<?php } ?>


     