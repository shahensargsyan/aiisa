<h3 class="text-center">
    <?php echo $this->Html->link('Add FAQ Category', 
            array(
                'controller' => 'admins',
                'action' => 'add_faq_category'
            ), 
            array('class' => 'btn')); 
    ?>
</h3>
<?php if(!empty($data)){?>
 <table class="allContractsTbl table table-bordered table-striped">
     <thead>
    <tr>
        <th style="width: 20%">Category</th>                
        <th style="width: 10%"></th>
        <th style="width: 10%"></th>
   </tr>
   </thead>
   <tbody>
   <?php foreach ($data as $faq_category){ ?>
   <tr>
        <td><?php echo $faq_category['FaqCategorie']['category'];?></td>
        <td class="text-center"><?php echo $this->Html->link('Edit',array('controller'=>'admins','action'=>'edit_faq_category',$faq_category['FaqCategorie']['id']),array('class'=>'btn btn-success'));?></td>
        <td class="text-center"><?php echo $this->Html->link('Delete',array('controller'=>'admins','action'=>'delete_faq_category',$faq_category['FaqCategorie']['id']),array('class'=>'btn btn-danger'),array('Are you sure you want to delete this review?'));?></td>
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
    <p class="text-center">There is no FAQ Category</p>
<?php } ?>


     