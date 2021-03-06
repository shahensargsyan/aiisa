<div class="container">
<div class="titleBox">
    <h3 class="pull-left">All Contracts</h3>
    <?php echo $this->Html->link('Add New Contract', 
            array(
                'controller' => 'admins',
                'action' => 'add_contract'
            ), 
            array('class' => 'btn pull-right')); 
    ?>
</div>

<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 10%">Image</th>
                <th style="width: 30%">Name</th>                              
                <th style="width: 10%">Edit</th>     
                <th style="width: 10%">Delete</th>
                <th style="width: 15%">Add to Featured list</th>
                <th style="width: 10%">Edit Form</th>
            </tr> 
        </thead>
        <tbody>
        <?php
        foreach($data as $contract){
            ?>
            <tr>
                <!--<td class="text-center"><?php // echo $this->Html->image('/system/contracts/'.$contract['Contract']['contract_image'],array('width'=>'50px'))?></td>-->
                <td class="text-center"><?php echo $this->Html->image('/system/contracts/'.$contract['Contract']['file'],array('width'=>'50px'))?></td>
                <td><?php echo $contract['Contract']['name'];?></td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'edit_contract', $contract['Contract']['id']), array('class' => 'btn btn-success')); ?></td>
                <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'delete_contract', $contract['Contract']['id']), array('class' => 'btn btn-danger'),array('Are you sure you want to delete this contract')); ?></td>
                <td class="text-center"><?php 
                    if($count < 5){
                        $url = true;
                    }
                    else{
                        $url = false;
                    }
                        $i = 0; $chek = true;
                        while(isset($contracts[$i]['Contract'])){
                            if($contract['Contract']['id']==$contracts[$i]['Contract']['id']){
                                $chek = false;
                                break;
                            }
                            $i++;
                        }
                        if($chek){
                            if(!$url){?>
                                <a href="javascript:void(0)" class="btn" DISABLED>Add</a>
                            <?php }else echo $this->Html->link('Add',array('controller'=>'admins','action'=>'add_contract_featured',$contract['Contract']['id']),array('class'=>'btn btn-inverse'));
                        }else{
                            echo 'Featured';
                            
                        }
                    ?>
                </td>
                <td class="text-center">
                   <?php echo $this->Html->link('Edit',array('controller'=>'admins','action'=>'edit_contract_form',$contract['Contract']['id']),array('class'=>'btn btn-success'));?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
   No Contract
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

<div class="titleBox top40">
    <h3>Featured Contracts</h3>
</div>
<?php
if(!empty($contracts)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 15%;">Image</th>
                <th style="width: 50%;">Name</th>                                
                <th style="width: 15%;">Delete</th>
            </tr> 
        </thead>
        <tbody>
        <?php
        foreach($contracts as $contract){
            ?>
            <tr>
                
                <td class="text-center"><?php echo $this->Html->image('/system/contracts/'.$contract['Contract']['file'],array('width'=>'50px'))?></td>
                <td><?php echo $contract['Contract']['name'];?></td>
                <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'delete_featured_contract',$contract['Contract']['id']), array('class' => 'btn btn-danger'),array('Are you sure you want to delete from featured list?')); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
   No Contract
    <?php
}
?>  
</div>