<div class="container">
<?php
if(!empty($data)){
    ?>
    <table border="1px">
        <tr>
            <th>Image</th>
            <th>Name</th>                
            <th>Price</th>                
        </tr> 
        <?php
        foreach($data as $contract){
            ?>
            <tr>
                <th><?php echo $this->Html->image('/contracts/'.$contract['Contract']['file'],array('width'=>'100px'))?></th>
                <th><?php echo $this->Html->link($contract['Contract']['name'],array('controller'=>'users','action'=>'view_contract',$contract['Contract']['id']));?></th>
                <th><?php echo $contract['Contract']['price'];?></th>
            </tr>
            <?php
        }
        ?>
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
</div>