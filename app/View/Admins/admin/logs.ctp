<?php if(!empty($data)){
    if(!isset($order_type) )
        $order_type = 'ASC';
    else{
        if($order_type == 'ASC'){
            $order_type = 'DESC';
        }else {
            $order_type = 'ASC';
        }
    }
    ?>
<div class="titleBox">
    <h3 class="pull-left right5">Logs</h3>
    <div class="pull-right">
    <?php 
        echo $this->Form->create('export',array(
            'url' => array('controller' => 'admins','action' =>'export_file' )
        ));
        echo $this->Form->input('model',array('type'=>'hidden','name'=>'Log','value'=>'logs'));//name = Model value action
        echo $this->Html->link('All',array('controller'=>'admins','action'=>'logs','ip',$order_type,'all'),array('class' => 'btn btn-success right5 pull-left'));
        echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success right5 pull-left'));
        echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger pull-left'));
    ?>
    </div>
</div>


 <table class="table table-bordered table-striped allContractsTbl logsTbl">
     <thead>
    <tr>
        <th><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
        <th style="width: 30%;"><?php echo $this->Html->link('Email',array('controller'=>'admins','action'=>'logs','email',$order_type,$all));?></th>                
        <th style="width: 30%;"><?php echo $this->Html->link('IP Address',array('controller'=>'admins','action'=>'logs','ip',$order_type,$all));?></th>
        <th style="width: 20%;"><?php echo $this->Html->link('Status',array('controller'=>'admins','action'=>'logs','status',$order_type,$all));?></th>
        <th style="width: 20%;"><?php echo $this->Html->link('Created',array('controller'=>'admins','action'=>'logs','created',$order_type,$all));?></th>
   </tr>
   </thead>
   <tbody>
   <?php foreach ($data as $user_data){ ?>
   <tr>
        <td>
            <?php
                echo $this->Form->input('id', array('type' => 'checkbox','name' => $user_data['Log']['id'],'value'=>$user_data['Log']['id'],'label' => false,'class'=>'chekbox'));
            ?>
        </td>                  
        <td><?php echo $user_data['Log']['email'];?></td>
        <td><?php 
            if($user_data['Log']['user_ip'] == true){
                echo $user_data['Log']['user_ip'];
            }
            else{
                echo 'This user added admin';
            }
            ?>
        </td>
        <td class="text-center">
            <?php  echo $user_data['Log']['type'];?>&nbsp;
            <?php //  echo ($user_data['Log']['subscription_type'])?$user_data['Log']['subscription_type']: $user_data['Log']['step'] ;?>
        </td>
        <td class="text-center"><?php echo $user_data['Log']['created'];?></td>
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
    <p class="text-center">Logs empty</p>
<?php } ?>
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
    })   
</script>