<div class="titleBox">
    <h3 class="pull-left right5">Orders</h3>
    <div class="pull-right">
    <?php 
        echo $this->Form->create('export',array(
            'url' => array('controller' => 'admins','action' =>'export_file' )
        ));
        echo $this->Form->input('model',array('type'=>'hidden','name'=>'Order','value'=>'Order'));//name = Model value action
        echo $this->Html->link('All',array('controller'=>'admins','action'=>'orders','all'),array('class' => 'btn btn-success pull-left right5'));
        echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success right5 pull-left'));
        echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger pull-left'));
    ?>
    </div>
</div>
<?php if(!empty($data)){?>
<table class="table table-bordered table-striped allContractsTbl ordersList">
        <tr>
            <th><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
            <th>First name</th>                
            <th>Last name</th>                
            <th>E-mail</th>                
            <th>Contract name</th>
            <th>Paid</th>
            <th>Finished</th>
            <th></th>
        </tr>
        <?php foreach($data as $key => $value){?>
             
            <tr>
                <td class="text-center">
                    <?php
                        echo $this->Form->input('id', array('type' => 'checkbox','name' => $value['Order']['id'],'value'=>$value['Order']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
                </td> 
                <td><?php echo $value['User']['first_name']; ?> </td>                          
                <td><?php echo $value['User']['last_name']; ?></td>
                <td><?php echo $value['User']['email']; ?></td>
                <td><?php echo $value['Contract']['name']; ?></td>
                <td class="text-center">
                    <?php if($value['Order']['paid']==1){
                        //echo $this->Html->link('incomplete',array('controller'=>'admins','action'=>'edit_orders',$value['Order']['id']),array('class'=>'btn btn-danger'));
                    ?>
                    <img src="/img/tick.png" />
                    <?php }else{ 
                       //echo $this->Html->link('complete',array('controller'=>'admins','action'=>'edit_orders',$value['Order']['id']),array('class'=>'btn btn-primary'));
                    ?>
                    <img src="/img/cross.png"/>
                    <?php }?>    
                </td>
                <td class="text-center">
                    <?php if($value['Order']['finished']==1){
                        //echo $this->Html->link('incomplete',array('controller'=>'admins','action'=>'edit_orders',$value['Order']['id']),array('class'=>'btn btn-danger'));
                    ?>
                    <img src="/img/tick.png" />
                    <?php }else{ 
                       //echo $this->Html->link('complete',array('controller'=>'admins','action'=>'edit_orders',$value['Order']['id']),array('class'=>'btn btn-primary'));
                    ?>
                    <img src="/img/cross.png"/>
                    <?php }?>    
                </td>
                <!--<td class="text-center"><?php echo $this->Html->link('Order',array('controller'=>'admins','action'=>'get_order',$value['Order']['id']),array('class'=>'btn btn-success'));?></td>-->
                <td class="text-center"><?php echo $this->Html->link('Edit',array('controller'=>'admins','action'=>'edit_order',$value['Order']['id']),array('class'=>'btn btn-success'));?></td>
            </tr>
            <?php 
            }
            ?>
    </table>
<?php }else{ ?>
 <p class="text-center">There is no order</p>
<?php }?>

<?php // echo !isset($all)?$this->Paginator->numbers(array('first' => 1, 'last' => 1)):'';?>
<?php
$count = $this->Paginator->params();
if($count['pageCount'] > '1'){
    ?>
    <div class="pagination">
        <ul>
            <li class="disabled"><?php echo $this->Paginator->prev('Prev', null, null); ?></li>
            <li><?php echo $this->Paginator->numbers(array("separator" => false)); ?></li>
            <li><?php echo $this->Paginator->next('Next', null, null); ?></li>
        </ul>
    </div>  
<?php } ?> 
 
 <script>
    $(function(){
        $('.chekbox').on('click',function(){
            $(this).parent().parent().parent().toggleClass('blockedIPRow');
        });
        $('#select').on('click',function(){
            $('#select').toggleClass('toggle');
            if($('#select').hasClass('toggle')){
                $('.chekbox').parent().parent().parent().addClass('blockedIPRow');
                $( ".chekbox" ).prop('checked',true);
            }else{
                $('.chekbox').parent().parent().parent().removeClass('blockedIPRow');
                $( ".chekbox" ).prop('checked',false);
            }
        })
    });
</script>