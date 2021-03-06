<div class="span7 margauto">
    <div class="titleBox">
        <h3 class="pull-left">Subscribed Emails</h3>
        <div class="pull-right">
            <?php
                /*echo $this->Form->create('export',array(
                    'url' => array('controller' => 'admins','action' =>'export_file' )
                ));*/
                //echo $this->Form->input('model',array('type'=>'hidden','name'=>'EmailSubscription','value'=>'subscription_email'));//name = model value = action
                //echo $this->Html->link('View all', array( 'all'), array('class' => 'btn btn-success right5'));
                //echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success pull-left right5'));
                //echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger'));
            ?>
        </div>
    </div>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 10%;"><input id="select" type="checkbox" style="width:20px;height:20px;"></th>           
                <th style="width: 70%">Email</th>  
                <th style="width: 20%"></th>
            </tr> 
        </thead>
        <tbody>
        <?php
        foreach($data as $email){
            ?>
            <tr>
                <td class="text-center selectAll">
                    <?php
                       echo $this->Form->input('id', array('type' => 'checkbox','name' => $email['EmailSubscription']['id'],'value'=>$email['EmailSubscription']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
                </td> 
                <td><?php echo $email['EmailSubscription']['email'];?></td>
                <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'delete', $email['EmailSubscription']['id'],'EmailSubscription'), array('class' => 'btn btn-danger'),array('Are you sure you want to delete this contract')); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
  <p class="text-center">No Email</p>
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
<?php } ?>
</div>
<script type="text/javascript">
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
</script>  
