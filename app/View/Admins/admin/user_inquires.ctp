<div class="titleBox">
    <h3>User Inquires</h3>
</div>
<div class="titleBox">
    <h3 class="pull-left right5">Logs</h3>
    <div class="pull-right">
    <?php 
        echo $this->Form->create('export',array(
            'url' => array('controller' => 'admins','action' =>'export_file' )
        ));
        echo $this->Form->input('model',array('type'=>'hidden','name'=>'Contact','value'=>'Contact'));//name = Model value action
        echo $this->Html->link('All',array('controller'=>'admins','action'=>'user_inquires','all'),array('class' => 'btn btn-danger pull-left'));
        echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success right5 pull-left'));
        echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger pull-left'));
    ?>
    </div>
</div>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
                <th style="width: 20%">name</th> 
                <th style="width: 20%">Email</th>
                <th style="width: 25%">Subject</th> 
                <th style="width: 25%">Text</th>
                <th style="width: 10%">Delete</th>
            </tr> 
        </thead>
        <tbody>
        <?php
        foreach($data as $user){
            ?>
            <tr>
                <td>
                    <?php
                        echo $this->Form->input('id', array('type' => 'checkbox','name' => $user['Contact']['id'],'value'=> $user['Contact']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
                </td>  
                <td><?php echo $user['Contact']['first_name'];?></td>
                <td><?php echo $user['Contact']['email'];?></td>
                <td><?php echo $user['Contact']['subject'];?></td>
                <td><?php echo $user['Contact']['text'];?></td>
                <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'delete', $user['Contact']['id'],'Contact'), array('class' => 'btn btn-danger'),array('Are you sure you want to delete this contract')); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
   <p class="text-center">No Contact</p>
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