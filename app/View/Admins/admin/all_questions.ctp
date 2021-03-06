<div class="titleBox">
    <?php echo $this->Html->link('Faq Category',array('controller'=>'admins','action'=>'faq_categories'), array('class' => 'btn btn-primary pull-left'));?>
    <?php echo $this->Html->link('Add Question-Answer', 
            array(
                'controller' => 'admins',
                'action' => 'add_question'
            ), 
            array('class' => 'btn pull-right')); 
    ?>
</div>
<?php if(!empty($data)){?>
 <table class="table table-bordered table-striped allContractsTbl">
     <thead>
    <tr>
        <th style="width: 23%;">Question</th>                
        <th style="width: 23%;">Answer</th>
        <th style="width: 15%;">FAQ Category</th>
        <th style="width: 27%;">Contract</th>
        <th style="width: 6%;"></th>
        <th style="width: 6%;"></th>
   </tr>
   </thead>
   <tbody>
   <?php foreach ($data as $question){ ?>
   <tr>
       <td><?php echo strlen($question['Question']['question'])>55?mb_substr($question['Question']['question'], 0, 55).'...':$question['Question']['question'];?></td>
       <td><?php echo strlen($question['Question']['answer'])>55?mb_substr($question['Question']['answer'], 0, 55).'...':$question['Question']['answer'];?></td>
        <td class="removeLink"><?php echo $question['FaqCategorie']['category'];?></td>
        <td>
            <?php
                echo $question[0]['name'];
            ?>
        </td>
        <td class="text-center"><?php echo $this->Html->link('Edit',array('controller'=>'admins','action'=>'edit_question',$question['Question']['id']),array('class'=>'btn btn-success'));?></td>
        <td class="text-center"><?php echo $this->Html->link('Delete',array('controller'=>'admins','action'=>'delete_question',$question['Question']['id']),array('class'=>'btn btn-danger'),array('Are you sure you want to delete this question?'));?></td>
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
    <p class="text-center">Question not exist</p>
<?php } ?>


     